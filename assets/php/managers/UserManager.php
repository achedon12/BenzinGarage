<?php

require_once("./assets/php/class/Client.php");
require_once("./assets/php/class/Manager.php");
require_once("./assets/php/class/Vehicle.php");
require_once("./assets/php/class/Administrator.php");
require_once("./assets/php/class/Employee.php");
require_once("./assets/php/database/DatabaseManager.php");
require_once("./assets/php/class/User.php");


class UserManager{

    const ADMINISTRATEUR = "administrateur";
    const EMPLOYE = "employe";
    const MANAGER = "manager";

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }



    /**
     * Get all managers.
     * @return array
     */
    public function getAllManager(): array{
        /** @var  $array Manager[] */
        $array = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.user WHERE role = 'manager'");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $array[] = new Manager($row["id"], $row["nom"], $row["prenom"], $row["password"], $row["role"]);
        return $array;
    }

    /**
     * Get all administrators.
     * @return array
     */
    public function getAllAdministrators(): array{
        /** @var  $array Administrator[]*/
        $array = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.user WHERE role = 'administrateur'");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $array[] = new Administrator($row["id"], $row["nom"], $row["prenom"], $row["password"], $row["role"]);
        return $array;
    }

    /**
     * Get all employees.
     * @return array
     */
    public function getAllEmployees(): array{
        /** @var  $array Employee[]*/
        $array = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.user WHERE role = 'employe'");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $array[] = new Employee($row["id"], $row["nom"], $row["prenom"], $row["password"], $row["role"]);
        return $array;
    }

    /**
     * Get all users.
     * @return User[]
     */
    public function getAllUser(): array{
        /** @var User[] $array */
        $array = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.user ORDER BY nom");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $array[] = new User($row["id"], $row["nom"],$row["prenom"], $row["password"], $row["role"]);
        return $array;
    }

    /**
     * Create a user from given information.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $role
     * @return bool
     */
    public function createUser(string $name, string $hashedPassword, string $firstName, string $role): bool
    {
        $sql = $this->pdo->query("SELECT max(id) FROM sae_garage.user ");

        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.user (id,nom, prenom, password, role) VALUES (:id, :nom, :prenom, :password, :role)");
        $newID = $sql->fetch(PDO::FETCH_ASSOC)['max'] + 1;
        $stmt->execute([
            "id" => (string)$newID,
            "nom" => $name,
            "prenom" => $firstName,
            "password" => $hashedPassword,
            "role" => $role
        ]);
        return true;
    }

    /**
     * Delete a given user.
     * @param string $id
     * @return bool
     */
    public function deleteUser(string $id): bool{
        $stmt = $this->pdo->prepare("DELETE FROM sae_garage.user WHERE id = :id");
        $stmt->execute([
            "id" => $id
        ]);
        return true;
    }

    /**
     * Modify a given user.
     * @param User $administrator
     * @param string $id
     * @return bool
     */
    public function modifyUser(User $administrator,string $id): bool{
        $stmt = $this->pdo->prepare("UPDATE sae_garage.user SET nom = :nom, prenom = :prenom, password = :password WHERE id = :id");
        $stmt->execute([
            "nom" => $administrator->getName(),
            "prenom" => $administrator->getFirstName(),
            "password" => $administrator->getHashedPassword(),
            "id" => $id
        ]);
        return true;
    }
    
    /**
    * Verify with a given id, a user exist.
    * @param string $id
    * return bool
    */
    public function existUser(string $id): bool{
        if ($this->pdo->query("SELECT * FROM sae_garage.user WHERE id = '$id'")->rowCount() > 0)
            return true;
        return false;
    }

    /**
     * Get all vehicles.
     * @return array
     */
    public function getAllVehicle(): array{
        /** @var  $array Vehicle[]*/
        $array = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.vehicule");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $array[] = new Vehicle($row["noimmatriculation"], $row["noserie"], $row["datemiseencirculation"], $row["nummodele"], $row["codeclient"]);
        return $array;
    }

    public function getUser(string $id): ?User{
        $sql = "SELECT * FROM sae_garage.user WHERE id = :id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->bindParam(':id', $id, PDO::PARAM_STR);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $result = $prepare->fetchAll();
            return new User($result[0]["id"],$result[0]["nom"],$result[0]["password"],$result[0]["prenom"],$result[0]["role"]);
        }
        return null;
    }

    /**
     * Get all roles.
     * @return string[]
     */
    public function getRoles(): array{
        $roles = [];
        $sql = $this->pdo->query("SELECT role FROM sae_garage.user");
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
            if (!in_array($row['role'],$roles))
                $roles[] = $row['role'];
        }
        return $roles;
    }
}