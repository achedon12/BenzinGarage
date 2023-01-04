<?php

class Modele{

    private int $nummodele;

    private string $modele;

    private int $nummarque;

    /**
     * @param int $nummodele
     * @param string $modele
     * @param int $nummarque
     */
    public function __construct(int $nummodele, string $modele, int $nummarque)
    {
        $this->nummodele = $nummodele;
        $this->modele = $modele;
        $this->nummarque = $nummarque;
    }

    /**
     * @return int
     */
    public function getNummodele(): int
    {
        return $this->nummodele;
    }

    /**
     * @return string
     */
    public function getModele(): string
    {
        return $this->modele;
    }

    /**
     * @return int
     */
    public function getNummarque(): int
    {
        return $this->nummarque;
    }




}
