<?php

class UserManager{

    const ADMINISTRATEUR = "administrateur";
    const EMPLOYE = "employe";
    const MANAGER = "manager";

    public function getAllClients(): array{

    }

    public function getAllAdministrateur(): array{

    }

    public function getAllEmploye(): array{

    }

    public function getAllManager(): array{

    }

    public function getAllVehicle(): array{

    }

    public function createAdministrateur(): User{

    }

    public function removeAdministrateur(): User{

    }

    public function modifyAdministrateur(): User{

    }

    public function createEmploye(): User{
        
    }
    
    public function removeEmploye(): User{
        
    }
    
    public function modifyEmploye(): User{
        
    }
    
    public function createManager(): User{
        
    }
    
    public function removeManager(): User{
        
    }
    
    public function modifyManager(): User{
        
    }

    public function existManager(User $manager): bool{

    }

    public function existEmploye(User $employe): bool{

    }

    public function existAdministrateur(User $administrateur): bool{

    }

    public function getRoles(): array{
        return [self::ADMINISTRATEUR,self::EMPLOYE,self::MANAGER];
    }

}