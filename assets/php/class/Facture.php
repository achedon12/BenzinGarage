<?php

class Facture{

    const FACTURE_PAYED = 0;
    const FACTURE_NOT_PAYED = 1;

    private int $nofacture;

    private string $datefacture;

    private int $tauxtva;

    private float $netapayer;

    private int $etatfacture;

    private int $numdde;

    public function __construct(int $nofacture, string $datefacture, int $tauxtva, float $netapayer, int $etatfacture,int $numdde)
    {
        $this->nofacture = $nofacture;
        $this->datefacture = $datefacture;
        $this->tauxtva = $tauxtva;
        $this->netapayer = $netapayer;
        $this->etatfacture = $etatfacture;
        $this->numdde = $numdde;
    }

    /**
     * @return int
     */
    public function getNumdde(): int
    {
        return $this->numdde;
    }

    public function getNofacture(): int{
        return $this->nofacture;
    }

    public function getDatefacture(): string{
        return $this->datefacture;
    }
    public function getTauxtva(): int{
        return $this->tauxtva;
    }
    public function getNetapayer(): float{
        return $this->netapayer;
    }

    public function getEtatfacture(): int{
        return $this->etatfacture;
    }

}