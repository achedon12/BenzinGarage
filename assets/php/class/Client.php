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

    /**
     * @return string
     */
    public function getId(): string{
        return $this->id;
    }

    /**
     * @return string
     */
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

    /**
     * @return string
     */
    public function getFirstName(): string{
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getAdresse(): string{
        return $this->adresse;
    }

    /**
     * @return string
     */
    public function getCodePostal(): string{
        return $this->codePostal;
    }

    /**
     * @return string
     */
    public function getCity(): string{
        return $this->city;
    }

    /**
     * @return string
     */
    public function getEmail(): string{
        return $this->eMail;
    }

    /**
     * @return string
     */
    public function getTelephoneNumber(): string{
        return $this->telephoneNumber;
    }
}