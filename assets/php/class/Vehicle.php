<?php

require_once("./assets/php/class/Client.php");

class Vehicle{

    private string $numberPlate;
    private string $numeroSerie;
    private string $dateMiseEnCirculation;
    private int $numerModele;
    private string $client;

    /**
     * @param string $numberPlate
     * @param string $numeroSerie
     * @param string $dateMiseEnCirculation
     * @param int $numerModele
     * @param string $client
     */
    public function __construct(string $numberPlate, string $numeroSerie, string $dateMiseEnCirculation, int $numerModele, string $client)
    {
        $this->numberPlate = $numberPlate;
        $this->numeroSerie = $numeroSerie;
        $this->dateMiseEnCirculation = $dateMiseEnCirculation;
        $this->numerModele = $numerModele;
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getNumeroSerie(): string
    {
        return $this->numeroSerie;
    }

    /**
     * @return string
     */
    public function getDateMiseEnCirculation(): string
    {
        return $this->dateMiseEnCirculation;
    }

    /**
     * @return int
     */
    public function getNumerModele(): int
    {
        return $this->numerModele;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }


    public function getNumberPlate(): string{
        return $this->numberPlate;
    }

    public function getVehicleClient(): string{
        return $this->client;
    }

}