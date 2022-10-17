<?php

class Facture{

    const FACTURE_PAYED = 0;
    const FACTURE_NOT_PAYED = 1;

    private int $factureNumber;

    private string $factureDate;

    private int $tva;

    private float $toPay;

    private int $etat;

    public function __construct(int $factureNumber, string $factureDate, int $tva, float $toPay, int $etat)
    {
        $this->factureNumber = $factureNumber;
        $this->factureDate = $factureDate;
        $this->tva = $tva;
        $this->toPay = $toPay;
        $this->etat = $etat;
    }

    public function getFactureNumber(): int{
        return $this->factureNumber;
    }

    public function getFactureDate(): string{
        return $this->factureDate;
    }
    public function getTva(): int{
        return $this->tva;
    }
    public function getToPay(): float{
        return $this->toPay;
    }

    public function getEtat(): int{
        return $this->etat;
    }

}