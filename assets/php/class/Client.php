<?php

class Client{

    private int $id;

    private string $name;

    private string $firstName;

    private string $adresse;

    private int $codePostal;

    private string $city;

    private string $telephoneNumber;

    private string  $eMail;

    private string $dateCreation;

    private string $hashedPassword;

    public function __construct(int $id, string $name, string $firstName, string $adresse, int $codePostal, string $city, string $telephoneNumber, string $eMail, string $dateCreation,string $hashedPassword)
    {
        $this->id = $id;
        $this->name = $name;
        $this->firstName = $firstName;
        $this->eMail = $eMail;
        $this->adresse = $adresse;
        $this->dateCreation = $dateCreation;
        $this->codePostal = $codePostal;
        $this->city = $city;
        $this->telephoneNumber = $telephoneNumber;
        $this->hashedPassword = $hashedPassword;

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



    /**
     * @return string
     */
    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }

    public function getVehicle(): ?Vehicle{
        return $this->vehicle;
    }

    public function getFirstName(): string{
        return $this->firstName;
    }

    public function getAdresse(): string{
        return $this->adresse;
    }

    public function getCodePostal(): int{
        return $this->codePostal;
    }

    public function getCity(): string{
        return $this->city;
    }

    public function getEmail(): string{
        return $this->eMail;
    }

    public function getTelephoneNumber(): string{
        return $this->telephoneNumber;
    }
}