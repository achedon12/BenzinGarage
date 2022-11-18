<?php

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
        $stmt = $this->pdo->query("SELECT * FROM client");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Client($row["id"], $row["nom"], $row["prenom"], $row["adresse"], $row["codePostal"], $row["ville"], $row["telephone"], $row["mail"],$row["vehicle"]);
        return $res;
    }

    /**
     * Get all managers.
     * @return array
     */
    public function getAllManager(): array{
        /** @var  $array Manager[] */
        $array = [];
        $stmt = $this->pdo->query("SELECT * FROM user WHERE role = 'manager'");
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
        $stmt = $this->pdo->query("SELECT * FROM user WHERE role = 'administrateur'");
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
        $stmt = $this->pdo->query("SELECT * FROM user WHERE role = 'employe'");
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
        $stmt = $this->pdo->query("SELECT * FROM user");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $array[] = new User($row["id"], $row["nom"], $row["password"],$row["prenom"], $row["role"]);
        return $array;
    }

    /**
     * Get all garager users.
     * @return User[]
     */
    public function getAllGarageUser(): array{
        /** @var User[] $array */
        $array = [];
        $stmt = $this->pdo->query("SELECT * FROM user where role ='administrateur' and role = 'employe' and role = 'manager'");
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
        $stmt = $this->pdo->query("SELECT * FROM vehicule");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $array[] = new Vehicle($row["noimmatriculation"], $row["noserie"], $row["nummodele"], $row["datemiseencirculation"], $row["codeclient"]);
        return $array;
    }


    public function existAdministrateur(Administrator $administrateur): bool{
        $stmt = $this->pdo->query("SELECT * FROM user WHERE role = 'administrateur'");
        return $stmt->rowCount() > 0;
    }

    /**
     * Create an administrator from given informations.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $role
     * @return AbstractUser
     */
    public function createAdministrator(string $name, string $hashedPassword, string $firstName, string $role): AbstractUser{
        $stmt = $this->pdo->prepare("INSERT INTO user (nom, prenom, password, role) VALUES (:nom, :prenom, :password, :role)");
        $stmt->bindValue(":nom", $name);
        $stmt->bindValue(":prenom", $firstName);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->bindValue(":role", $role);
        $stmt->execute();
        return new Administrator($this->pdo->lastInsertId(), $name, $firstName, $hashedPassword, $role);
    }

    /**
     * Delete a given admnistrator.
     * @param AbstractUser $administrator
     * @return bool
     */
    public function removeAdministrator(AbstractUser $administrator): bool{
        if ($this->existAdministrateur($administrator)){
            $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = :id");
            $stmt->bindValue(":id", $administrator->getId());
            $stmt->execute();
            return true;
        }
        return false;
    }

    /**
     * Modify a given administrator.
     * @param AbstractUser $administrator
     * @return AbstractUser
     */
    public function modifyAdministrator(AbstractUser $administrator): AbstractUser{

    }

    /**
     * Create an employee from given informations.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $role
     * @return AbstractUser
     */
    public function createEmployee(string $name, string $hashedPassword, string $firstName, string $role = self::EMPLOYE): AbstractUser{
        $stmt = $this->pdo->prepare("INSERT INTO user (nom, prenom, password, role) VALUES (:nom, :prenom, :password, :role)");
        $stmt->bindValue(":nom", $name);
        $stmt->bindValue(":prenom", $firstName);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->bindValue(":role", $role);
        $stmt->execute();
        return new Employee($this->pdo->lastInsertId(), $name, $firstName, $hashedPassword, $role);
    }

    /**
     * Delete an employee.
     * @param AbstractUser $employee
     * @return bool
     */
    public function removeEmployee(AbstractUser $employee): bool{
        if ($this->existEmployee($employee)){
            $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = :id");
            $stmt->bindValue(":id", $employee->getId());
            $stmt->execute();
            return true;
        }
        return false;
    }

    /**
     * Modify an employee
     * @param AbstractUser $employee
     * @return AbstractUser
     */
    public function modifyEmployee(AbstractUser $employee): AbstractUser{

    }

    /**
     * Create a manager from given informations.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $role
     * @return AbstractUser
     */
    public function createManager(string $name, string $hashedPassword, string $firstName, string $role = self::MANAGER): AbstractUser{
        $stmt = $this->pdo->prepare("INSERT INTO user (nom, prenom, password, role) VALUES (:nom, :prenom, :password, :role)");
        $stmt->bindValue(":nom", $name);
        $stmt->bindValue(":prenom", $firstName);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->bindValue(":role", $role);
        $stmt->execute();
        return new Manager($this->pdo->lastInsertId(), $name, $firstName, $hashedPassword, $role);
    }

    /**
     * Delete a given manager.
     * @param AbstractUser $manager
     * @return bool
     */
    public function removeManager(AbstractUser $manager): bool{
        if ($this->existManager($manager)){
            $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = :id");
            $stmt->bindValue(":id", $manager->getId());
            $stmt->execute();
            return true;
        }
        return false;
    }

    /**
     * Modify a manager.
     * @param AbstractUser $manager
     * @return AbstractUser
     */
    public function modifyManager(AbstractUser $manager): AbstractUser{

    }

    /**
     * Verify if a given manager exist.
     * @param AbstractUser $manager
     * @return bool
     */
    public function existManager(AbstractUser $manager): bool{
        $stmt = $this->pdo->query("SELECT * FROM user WHERE role = 'manager'");
        return $stmt->rowCount() > 0;
    }

    /**
     * Verify if a given employee exist.
     * @param AbstractUser $employee
     * @return bool
     */
    public function existEmployee(AbstractUser $employee): bool{
        $stmt = $this->pdo->query("SELECT * FROM user WHERE role = 'employee'");
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