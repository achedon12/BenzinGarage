<?php

require_once("./assets/php/class/Client.php");
require_once("./assets/php/class/Manager.php");
require_once("./assets/php/class/Vehicle.php");
require_once("./assets/php/class/Administrator.php");
require_once("./assets/php/class/Employee.php");

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
     * Get all clients.
     * @return array
     */
    public function getAllClients(): array{
        /** @var $res Client[]*/
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.client");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Client($row["codeclient"], $row["nom"], $row["prenom"], $row["adresse"], $row["codepostal"], $row["ville"], $row["tel"],$row["mail"],$row["datecreation"] );
        return $res;
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
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.user");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $array[] = new User($row["id"], $row["nom"], $row["password"],$row["prenom"], $row["role"]);
        return $array;
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

    public function existAdministrateur(string $id): bool{
        if ($this->pdo->query("SELECT * FROM sae_garage.user WHERE id = '$id' AND role = 'administrateur'")->rowCount() > 0)
            return true;
        return false;
    }

    /**
     * Create an administrator from given information.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @return bool
     */
    public function createAdministrator(string $name, string $hashedPassword, string $firstName): bool
    {
        $sql = $this->pdo->query("SELECT max(id) FROM sae_garage.user ");

        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.user (id,nom, prenom, password, role) VALUES (:id, :nom, :prenom, :password, :role)");
        $newID = $sql->fetch(PDO::FETCH_ASSOC)['max'] + 1;
        $stmt->execute([
            "id" => (string)$newID,
            "nom" => $name,
            "prenom" => $firstName,
            "password" => $hashedPassword,
            "role" => 'administrateur'
        ]);
        return true;
    }

    /**
     * Delete a given administrator.
     * @param string $id
     * @return bool
     */
    public function removeAdministrator(string $id): bool{
        if ($this->existAdministrateur($id)){
            $stmt = $this->pdo->prepare("DELETE FROM sae_garage.user WHERE id = :id and role = 'administrateur'");
            $stmt->execute([
                "id" => $id
            ]);
            return true;
        }
        return false;
    }

    /**
     * Modify a given administrator.
     * @param User $administrator
     * @param string $id
     * @return bool
     */
    public function modifyAdministrator(User $administrator,string $id): bool{
        if ($this->existAdministrateur($id)){
            $stmt = $this->pdo->prepare("UPDATE sae_garage.user SET nom = :nom, prenom = :prenom, password = :password WHERE id = :id and role = 'administrateur'");
            $stmt->execute([
                "id" => $id,
                "nom" => $administrator->getName(),
                "prenom" => $administrator->getFirstName(),
                "password" => $administrator->getHashedPassword()
            ]);
            return true;
        }
        return false;
    }

    /**
     * Create an employee from given information.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @return bool
     */
    public function createEmployee(string $name, string $hashedPassword, string $firstName): bool{

        $sql = $this->pdo->query("SELECT max(id) FROM sae_garage.user ");

        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.user (id,nom, prenom, password, role) VALUES (:id, :nom, :prenom, :password, :role)");
        $newID = $sql->fetch(PDO::FETCH_ASSOC)['max'] + 1;
        $stmt->execute([
            "id" => (string)$newID,
            "nom" => $name,
            "prenom" => $firstName,
            "password" => $hashedPassword,
            "role" => 'employe'
        ]);
        return true;
    }

    /**
     * Delete an employee.
     * @param string $id
     * @return bool
     */
    public function removeEmployee(string $id): bool{
        if ($this->existEmployee($id)){
            $stmt = $this->pdo->prepare("DELETE FROM sae_garage.user WHERE id = :id and role = 'employe'");
            $stmt->execute([
                "id" => $id
            ]);
            return true;
        }
        return false;
    }

    /**
     * Modify an employee
     * @param User $employee
     * @return bool
     */
    public function modifyEmployee(User $employee): bool{
        if ($this->existEmployee($employee->getId())){
            $stmt = $this->pdo->prepare("UPDATE sae_garage.user SET nom = :nom, prenom = :prenom, password = :password WHERE id = :id and role = 'employe'");
            $stmt->execute([
                "id" => $employee->getId(),
                "nom" => $employee->getName(),
                "prenom" => $employee->getFirstName(),
                "password" => $employee->getHashedPassword()
            ]);
            return true;
        }
        return false;
    }

    /**
     * Create a manager from given information.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @return bool
     */
    public function createManager(string $name, string $hashedPassword, string $firstName): bool{

        $sql = $this->pdo->query("SELECT max(id) FROM sae_garage.user ");

        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.user (id,nom, prenom, password, role) VALUES (:id, :nom, :prenom, :password, :role)");
        $newID = $sql->fetch(PDO::FETCH_ASSOC)['max'] + 1;
        $stmt->execute([
            "id" => (string)$newID,
            "nom" => $name,
            "prenom" => $firstName,
            "password" => $hashedPassword,
            "role" => 'manager'
        ]);
        return true;
    }

    /**
     * Delete a given manager.
     * @param string $id
     * @return bool
     */
    public function removeManager(string $id): bool{
        if ($this->existManager($id)){
            $stmt = $this->pdo->prepare("DELETE FROM sae_garage.user WHERE id = :id and role = 'manager'");
            $stmt->execute([
                "id" => $id
            ]);
            return true;
        }
        return false;
    }

    /**
     * Modify a manager.
     * @param User $manager
     * @return bool
     */
    public function modifyManager(User $manager): bool{
        if ($this->existManager($manager->getId())){
            $stmt = $this->pdo->prepare("UPDATE sae_garage.user SET nom = :nom, prenom = :prenom, password = :password WHERE id = :id and role = 'manager'");
            $stmt->execute([
                "id" => $manager->getId(),
                "nom" => $manager->getName(),
                "prenom" => $manager->getFirstName(),
                "password" => $manager->getHashedPassword()
            ]);
            return true;
        }
        return false;
    }

    /**
     * Verify if a given manager exist.
     * @param string $id
     * @return bool
     */
    public function existManager(string $id): bool{
        if ($this->pdo->query("SELECT * FROM sae_garage.user WHERE id = '$id' AND role = 'manager'")->rowCount() > 0)
            return true;
        return false;
    }

    /**
     * Verify if a given employee exist.
     * @param string $id
     * @return bool
     */
    public function existEmployee(string $id): bool{
        if ($this->pdo->query("SELECT * FROM sae_garage.user WHERE id = '$id' AND role = 'employe'")->rowCount() > 0)
            return true;
        return false;
    }

    /**
     * Get all roles.
     * @return string[]
     */
    public function getRoles(): array{
        return [self::ADMINISTRATEUR,self::EMPLOYE,self::MANAGER];
    }

}