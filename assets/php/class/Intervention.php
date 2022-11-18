<?php

class Intervention{

    const INTERVENTION_END = 0;
    const INTERVENTION_START = 1;
    const INTERVENTION_VERIFY = 2;

    private int $id;
    private string $dateRdv;
    private string $heureRdv;
    private string $descriptifDemande;
    private int $kmActuel;
    private bool $devisOn;
    private int $etat;
    private string $idOpérateur;
    private Vehicle $vehicle;
    private Client $client;

    /**
     * @param int $id
     * @param string $dateRdv
     * @param string $heureRdv
     * @param string $descriptifDemande
     * @param int $kmActuel
     * @param bool $devisOn
     * @param int $etat
     * @param string $idOpérateur
     * @param Vehicle $vehicle
     * @param Client $client
     */
    public function __construct(int $id, string $dateRdv, string $heureRdv, string $descriptifDemande, int $kmActuel, bool $devisOn, int $etat, string $idOpérateur, Vehicle $vehicle, Client $client)
    {
        $this->id = $id;
        $this->dateRdv = $dateRdv;
        $this->heureRdv = $heureRdv;
        $this->descriptifDemande = $descriptifDemande;
        $this->kmActuel = $kmActuel;
        $this->devisOn = $devisOn;
        $this->etat = $etat;
        $this->idOpérateur = $idOpérateur;
        $this->vehicle = $vehicle;
        $this->client = $client;
    }

    /**
     * @return int
     * Incrementation de l'id pour garder le dernier ID permettant de ne pas utiliser un id deja utiliser
     */
    public function keepLastId() : int{

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdOpérateur(): string
    {
        return $this->idOpérateur;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getDateRdv(): string
    {
        return $this->dateRdv;
    }

    /**
     * @return string
     */
    public function getHeureRdv(): string
    {
        return $this->heureRdv;
    }

    /**
     * @return string
     */
    public function getDescriptifDemande(): string
    {
        return $this->descriptifDemande;
    }

    /**
     * @return int
     */
    public function getKmActuel(): int
    {
        return $this->kmActuel;
    }

    /**
     * @return bool
     */
    public function isDevisOn(): bool
    {
        return $this->devisOn;
    }

    /**
     * @return int
     */
    public function getEtat(): int
    {
        return $this->etat;
    }

    /**
     * @return Vehicle
     */
    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }


}