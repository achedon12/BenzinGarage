<?php

class Administrator extends User{

    private int $id;
    private string $name;
    private string $firstName;
    private string $hashedPassword;
    private string $role;

    public function __construct(int $id, string $name, string $firstName, string $hashedPassword, string $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->firstName = $firstName;
        $this->hashedPassword = $hashedPassword;
        $this->role = $role;
    }

}