<?php

class Client{

    private int $id;

    private string $name;

    private string $firstName;

    private string $adresse;

    private int $codePostal;

    private string $city;

    private int $telephoneNumber;

    private string  $eMail;

    private string $dateCreation;

    /**
     * @param int $id
     * @param string $name
     * @param string $firstName
     * @param string $adresse
     * @param int $codePostal
     * @param string $city
     * @param int $telephoneNumber
     * @param string $eMail
     * @param string $dateCreation
     */
    public function __construct(int $id, string $name, string $firstName, string $adresse, int $codePostal, string $city, int $telephoneNumber, string $eMail, string $dateCreation)
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

    public function getId(): int{
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

    public function getCodePostal(): int{
        return $this->codePostal;
    }

    public function getCity(): string{
        return $this->city;
    }

    public function getEmail(): string{
        return $this->eMail;
    }

    public function getTelephoneNumber(): int{
        return $this->telephoneNumber;
    }
}