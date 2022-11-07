<?php

class UserManager{

    const ADMINISTRATEUR = "administrateur";
    const EMPLOYE = "employe";
    const MANAGER = "manager";

    /**
     * Get all clients.
     * @return array
     */
    public function getAllClients(): array{

    }

    /**
     * Get all administrators.
     * @return array
     */
    public function getAllAdministrators(): array{

    }

    /**
     * Get all employees.
     * @return array
     */
    public function getAllEmployees(): array{

    }

    /**
     * Get all managers.
     * @return array
     */
    public function getAllManagers(): array{

    }

    /**
     * Get all vehicles.
     * @return array
     */
    public function getAllVehicle(): array{

    }

    /**
     * Create an administrator from given informations.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $role
     * @return User
     */
    public function createAdministrator(string $name, string $hashedPassword, string $firstName, string $role = self::ADMINISTRATEUR): User{

    }

    /**
     * Delete a given admnistrator.
     * @param User $administrator
     * @return bool
     */
    public function removeAdministrator(User $administrator): bool{

    }

    /**
     * Modify a given administrator.
     * @param User $administrator
     * @return User
     */
    public function modifyAdministrator(User $administrator): User{

    }

    /**
     * Create an employee from given informations.
     * @param string $name
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $role
     * @return User
     */
    public function createEmployee(string $name, string $hashedPassword, string $firstName, string $role = self::EMPLOYE): User{

    }

    /**
     * Delete an employee.
     * @param User $employee
     * @return User
     */
    public function removeEmployee(User $employee): User{
        
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
        
    }

    /**
     * Delete a given manager.
     * @param User $manager
     * @return User
     */
    public function removeManager(User $manager): User{
        
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

    }

    /**
     * Verify if a given employee exist.
     * @param User $employee
     * @return bool
     */
    public function existEmployee(User $employee): bool{

    }

    /**
     * Verify if a given administrator exist.
     * @param User $administrator
     * @return bool
     */
    public function existAdministrator(User $administrator): bool{

    }

    /**
     * Get all roles.
     * @return string[]
     */
    public function getRoles(): array{
        return [self::ADMINISTRATEUR,self::EMPLOYE,self::MANAGER];
    }

}