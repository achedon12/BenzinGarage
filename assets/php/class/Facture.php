<?php

class Facture{
    private int $factureNumber;
    private string $factureDate;
    private float $tva;
    private float $toPay;
    private string $etat;
    private int $numDde;

    /**
     * @param int $factureNumber
     * @param string $factureDate
     * @param float $tva
     * @param float $toPay
     * @param string $etat
     * @param int $numDde
     */
    public function __construct(int $factureNumber, string $factureDate, float $tva, float $toPay, string $etat, int $numDde)
    {
        $this->factureNumber = $factureNumber;
        $this->factureDate = $factureDate;
        $this->tva = $tva;
        $this->toPay = $toPay;
        $this->etat = $etat;
        $this->numDde = $numDde;

    }

    /**
     * @return int
     */
    public function getNumDde(): int
    {
        return $this->numDde;
    }

    /**
     * @return int
     */
    public function getFactureNumber(): int
    {
        return $this->factureNumber;
    }

    /**
     * @return string
     */
    public function getFactureDate(): string
    {
        return $this->factureDate;
    }

    /**
     * @return int
     */
    public function getTva(): int
    {
        return $this->tva;
    }

    /**
     * @return float
     */
    public function getToPay(): float
    {
        return $this->toPay;
    }

    /**
     * @return string
     */
    public function getEtat(): string
    {
        return $this->etat;
    }

}