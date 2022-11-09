<?php

class Piece{

    private string $libellearticle;

    private int $qte_min;

    private float $prixunitactuelht;

    public string $codearticle;

    private string $typearticle;

    private int $qte_stock;

    /**
     * @param string $codearticle
     * @param string $libellearticle
     * @param int $qte_min
     * @param String $typearticle
     * @param float $prixunitactuelht
     * @param int $qte_stock
     */
    public function __construct(string $codearticle, string $libellearticle, int $qte_min, String $typearticle, float $prixunitactuelht, int $qte_stock){
        $this->libellearticle = $libellearticle;
        $this->qte_min = $qte_min;
        $this->prixunitactuelht = $prixunitactuelht;
        $this->codearticle = $codearticle;
        $this->typearticle = $typearticle;
        $this->qte_stock = $qte_stock;
    }

    /**
     * @return string
     */
    public function getTypearticle(): string
    {
        return $this->typearticle;
    }

    /**
     * @return int
     */
    public function getQteStock(): int
    {
        return $this->qte_stock;
    }

    public function getlibellearticle(): string{
        return $this->libellearticle;
    }

    public function getQte_min(): int{
        return $this->qte_min;
    }

    public function getPrixunitactuelht(): int{
        return $this->prixunitactuelht;
    }

    public function getCodeArticle(): string
    {
        return $this->codearticle;
    }
}