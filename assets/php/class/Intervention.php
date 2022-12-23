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

    private string $idOperateur;
    
    private string $numeroImmatriculation;

    private string $codeClient;

    private string $etatDemande;



    /**
     * @param int $id
     * @param string $dateRdv
     * @param string $heureRdv
     * @param string $descriptifDemande
     * @param int $kmActuel
     * @param bool $devisOn
     * @param string $idOperateur
     * @param string $etatdemande
     * @param string $numeroImmatriculation
     * @param string $codeClient
     * @param string $etatDemande
     */
    public function __construct(int $id, string $dateRdv, string $heureRdv, string $descriptifDemande, int $kmActuel, bool $devisOn, string $idOperateur, string $numeroImmatriculation,string $codeClient, string $etatDemande)
    {
        $this->id = $id;
        $this->dateRdv = $dateRdv;
        $this->heureRdv = $heureRdv;
        $this->descriptifDemande = $descriptifDemande;
        $this->kmActuel = $kmActuel;
        $this->devisOn = $devisOn;
        $this->idOperateur = $idOperateur;
        $this->numeroImmatriculation = $numeroImmatriculation;
        $this->codeClient = $codeClient;
        $this->etatDemande = $etatDemande;
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
    public function getIdOperateur(): string
    {
        return $this->idOperateur;
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
    public function getDevis(): bool
    {
        return $this->devisOn;
    }

    /**
     * @return string
     */
    public function getEtatdemande(): string
    {
        return $this->etatDemande;
    }

    /**
     * @return string
     */
    public function getNumeroImmatriculation(): string
    {
        return $this->numeroImmatriculation;
    }

    /**
     * @return string
     */
    public function getCodeClient(): string
    {
        return $this->codeClient;
    }
}