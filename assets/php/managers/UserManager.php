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
        /** @var  $res Client[]*/
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.client");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Client($row["codeclient"], $row["nom"], $row["prenom"], $row["adresse"], $row["codepostal"], $row["ville"], $row["tel"], $row["mail"],$row["datecreation"]);
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
            $array[] = new Manager($row["id"], $row["nom"], $row["prenom"], $row["password"], $row["role"]);
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
            $array[] = new Manager($row["id"], $row["nom"], $row["prenom"], $row["password"], $row["role"]);
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
            $array[] = new Vehicle($row["noimmatriculation"], $row["noserie"], $row["nummodele"], $row["datemiseencirculation"], $row["codeclient"]);
        return $array;
    }


    public function existAdministrateur(Administrator $administrateur): bool{
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.user WHERE role = 'administrateur'");
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Create an administrator from given informations.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $role
     * @return User
     */
    public function createAdministrator(string $name, string $hashedPassword, string $firstName, string $role): User{
        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.user (nom, prenom, password, role) VALUES (:nom, :prenom, :password, :role)");
        $stmt->bindValue(":nom", $name);
        $stmt->bindValue(":prenom", $firstName);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->bindValue(":role", $role);
        $stmt->execute();
        return new Administrator($this->pdo->lastInsertId(), $name, $firstName, $hashedPassword, $role);
    }

    /**
     * Delete a given administrator.
     * @param User $administrator
     * @return bool
     */
    public function removeAdministrator(User $administrator): bool{
        if ($this->existAdministrateur($administrator)){
            $stmt = $this->pdo->prepare("DELETE FROM sae_garage.user WHERE id = :id");
            $stmt->bindValue(":id", $administrator->getId());
            $stmt->execute();
            return true;
        }
        return false;
    }

    /**
     * Modify a given administrator.
     * @param User $administrator
     * @return User
     */
    public function modifyAdministrator(User $administrator): User{

    }

    /**
     * Create an employee from given information.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $role
     * @return User
     */
    public function createEmployee(string $name, string $hashedPassword, string $firstName, string $role = self::EMPLOYE): User{
        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.user (nom, prenom, password, role) VALUES (:nom, :prenom, :password, :role)");
        $stmt->bindValue(":nom", $name);
        $stmt->bindValue(":prenom", $firstName);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->bindValue(":role", $role);
        $stmt->execute();
        return new Employee($this->pdo->lastInsertId(), $name, $firstName, $hashedPassword, $role);
    }

    /**
     * Delete an employee.
     * @param User $employee
     * @return bool
     */
    public function removeEmployee(User $employee): bool{
        if ($this->existEmployee($employee)){
            $stmt = $this->pdo->prepare("DELETE FROM sae_garage.user WHERE id = :id");
            $stmt->bindValue(":id", $employee->getId());
            $stmt->execute();
            return true;
        }
        return false;
    }

    /**
     * Modify an employee
     * @param User $employee
     * @return User
     */
    public function modifyEmployee(User $employee): User{
        
    }

    /**
     * Create a manager from given informations.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $role
     * @return User
     */
    public function createManager(string $name, string $hashedPassword, string $firstName, string $role = self::MANAGER): User{
        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.user (nom, prenom, password, role) VALUES (:nom, :prenom, :password, :role)");
        $stmt->bindValue(":nom", $name);
        $stmt->bindValue(":prenom", $firstName);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->bindValue(":role", $role);
        $stmt->execute();
        return new Manager($this->pdo->lastInsertId(), $name, $firstName, $hashedPassword, $role);
    }

    /**
     * Delete a given manager.
     * @param User $manager
     * @return bool
     */
    public function removeManager(User $manager): bool{
        if ($this->existManager($manager)){
            $stmt = $this->pdo->prepare("DELETE FROM sae_garage.user WHERE id = :id");
            $stmt->bindValue(":id", $manager->getId());
            $stmt->execute();
            return true;
        }
        return false;
    }

    /**
     * Modify a manager.
     * @param User $manager
     * @return User
     */
    public function modifyManager(User $manager): User{
        
    }

    /**
     * Verify if a given manager exist.
     * @param User $manager
     * @return bool
     */
    public function existManager(User $manager): bool{
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.user WHERE role = 'manager'");
        return $stmt->rowCount() > 0;
    }

    /**
     * Verify if a given employee exist.
     * @param User $employee
     * @return bool
     */
    public function existEmployee(User $employee): bool{
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.user WHERE role = 'employee'");
        return $stmt->rowCount() > 0;
    }


    /**
     * Get all roles.
     * @return string[]
     */
    public function getRoles(): array{
        return [self::ADMINISTRATEUR,self::EMPLOYE,self::MANAGER];
    }

}