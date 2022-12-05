<?php

abstract class AbstractUser{


    private string $id;

    private string $name;

    private string $firstName;

    private string $hashedPassword;

    private string $role;

    public function __construct(string $id, string $name, string $hashedPassword, string $firstName, string $role){
        $this->id = $id;
        $this->name = $name;
        $this->hashedPassword = $hashedPassword;
        $this->firstName = $firstName;
        $this->role = $role;
    }

    public function getId(): string{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getHashedPassword(): string{
        return $this->hashedPassword;
    }

    public function getPasswordNotHashed(): string{
        return "";
    }

    public function getFirstName(): string{
        return $this->firstName;
    }

    public function getRole(): string{
        return $this->role;
    }

}