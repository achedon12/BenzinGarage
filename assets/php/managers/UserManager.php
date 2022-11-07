<?php

class UserManager{

    const ADMINISTRATEUR = "administrateur";
    const EMPLOYE = "employe";
    const MANAGER = "manager";

    public function getAllClients(): array{

    }

    public function getAllAdministrateur(): array{
        /** @var  $array Administrator[]*/
        $array = [];
        return $array;
    }

    public function getAllEmploye(): array{
        /** @var  $array Employee[]*/
        $array = [];
        return $array;
    }

    public function getAllManager(): array{
        /** @var  $array Manager[]*/
        $array = [];
        return $array;
    }

    public function getAllVehicle(): array{
        /** @var  $array Vehicle[]*/
        $array = [];
        return $array;
    }

    public function createAdministrateur(): Administrator{

    }

    public function removeAdministrateur(): Administrator{

    }

    public function modifyAdministrateur(): Administrator{

    }

    public function createEmploye(): Employee{
        
    }
    
    public function removeEmploye(): Employee{
        
    }
    
    public function modifyEmploye(): Employee{
        
    }
    
    public function createManager(): Manager{
        
    }
    
    public function removeManager(): Manager{
        
    }
    
    public function modifyManager(): Manager{
        
    }

    public function existManager(Manager $manager): bool{

    }

    public function existEmploye(Employee $employe): bool{

    }

    public function existAdministrateur(Administrator $administrateur): bool{

    }

    public function getRoles(): array{
        return [self::ADMINISTRATEUR,self::EMPLOYE,self::MANAGER];
    }

}