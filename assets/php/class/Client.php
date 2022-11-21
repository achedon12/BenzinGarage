<?php

require_once "assets/php/class/AbstractUser.php";


class Client{

    private string $id;

    private string $name;

    private string $firstName;

    private string $adresse;

    private string $codePostal;

    private string $city;

    private string $telephoneNumber;

    private string  $eMail;

    private string $dateCreation;

    /**
     * @param string $id
     * @param string $name
     * @param string $firstName
     * @param string $adresse
     * @param string $codePostal
     * @param string $city
     * @param string $telephoneNumber
     * @param string $eMail
     * @param string $dateCreation
     */
    public function __construct(string $id, string $name, string $firstName, string $adresse, string $codePostal, string $city, string $telephoneNumber, string $eMail, string $dateCreation)
    {
        $this->id = $id;
        $this->name = $name;
        $this->firstName = $firstName;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->city = $city;
        $this->telephoneNumber = $telephoneNumber;
        $this->eMail = $eMail;
        $this->dateCreation = $dateCreation;
    }

    public function getId(): string{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }

    public function getFirstName(): string{
        return $this->firstName;
    }

    public function getAdresse(): string{
        return $this->adresse;
    }

    public function getCodePostal(): string{
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