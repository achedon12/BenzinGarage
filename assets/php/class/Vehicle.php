<?php

require_once("./assets/php/class/Client.php");

class Vehicle{

    private string $numberPlate;
    private string $noSerie;
    private string $dateMiseEnCirculation;
    private int $numModele;
    private string $client;

    /**
     * @param string $numberPlate
     * @param string $noSerie
     * @param string $dateMiseEnCirculation
     * @param int $numModele
     * @param string $client
     */
    public function __construct(string $numberPlate, string $noSerie, string $dateMiseEnCirculation, int $numModele, string $client)
    {
        $this->numberPlate = $numberPlate;
        $this->noSerie = $noSerie;
        $this->dateMiseEnCirculation = $dateMiseEnCirculation;
        $this->numModele = $numModele;
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getNoSerie(): string
    {
        return $this->noSerie;
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
    public function getNumModele(): int
    {
        return $this->numModele;
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