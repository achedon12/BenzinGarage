<?php

class Facture{

    const FACTURE_PAYED = 0;
    const FACTURE_NOT_PAYED = 1;

    private int $factureNumber;

    private string $factureDate;

    private int $tva;

    private float $toPay;

    private int $etat;

    private int $numDde;

    /**
     * @param int $factureNumber
     * @param string $factureDate
     * @param int $tva
     * @param float $toPay
     * @param int $etat
     * @param int $numDde
     */
    public function __construct(int $factureNumber, string $factureDate, int $tva, float $toPay, int $etat, int $numDde)
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
     * @return int
     */
    public function getEtat(): int
    {
        return $this->etat;
    }

}