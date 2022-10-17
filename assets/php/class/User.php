<?php

class User{

    private int $id;

    private string $name;

    private string $firstName;

    private string $hashedPassword;

    private string $role;

    public function __construct(int $id, string $name, string $hashedPassword, string $firstName, string $role){
        $this->id = $id;
        $this->name = $name;
        $this->hashedPassword = $hashedPassword;
        $this->firstName = $firstName;
        $this->role = $role;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getHashedPassword(): string{
        return $this->hashedPassword;
    }

    public function getPasswordNotHashed(): string{

    }

    public function getFirtName(): string{
        return $this->firstName;
    }

    public function gerRole(): string{
        return $this->role;
    }

}