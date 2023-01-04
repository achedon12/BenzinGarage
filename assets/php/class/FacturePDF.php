<?php

require_once "assets/php/class/Facture.php";
require_once "assets/php/class/Client.php";

class FacturePDF{

    private Facture $facture;
    private array $operations;

    private Client $client;

    public function __construct(Facture $facture, array $operations, Client $client){
        $this->facture = $facture;
        $this->operations = $operations;
        $this->client = $client;
    }

    /**
     * @return Facture
     */
    public function getFacture(): Facture{
        return $this->facture;
    }

    /**
     * @return array
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }


}
