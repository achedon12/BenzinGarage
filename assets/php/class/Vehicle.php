<?php

class Vehicle{

    private string $numberPlate;
    private string $noSerie;
    private string $dateMiseEnCirculation;
    private int $numModele;
    private Client $client;

    /**
     * @param string $numberPlate
     * @param string $noSerie
     * @param string $dateMiseEnCirculation
     * @param int $numModele
     * @param Client $client
     */
    public function __construct(string $numberPlate, string $noSerie, string $dateMiseEnCirculation, int $numModele, Client $client)
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
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }


    public function getNumberPlate(): string{
        return $this->numberPlate;
    }

    public function getVehicleClient(): Client{
        return $this->client;
    }

}