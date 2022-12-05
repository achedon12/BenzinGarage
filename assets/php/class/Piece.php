<?php

class Piece{

    private string $codeArticle;
    private string $libelleArticle;
    private int $qteMin;
    private string $typeArticle;
    private float $price;
    private int $qteStock;

    /**
     * @param string $codeArticle
     * @param string $libelleArticle
     * @param int $qteMin
     * @param string $typeArticle
     * @param float $price
     * @param int $qteStock
     */
    public function __construct(string $codeArticle, string $libelleArticle, int $qteMin, string $typeArticle, float $price, int $qteStock)
    {
        $this->qteMin = $qteMin;
        $this->qteStock = $qteStock;
        $this->codeArticle = $codeArticle;
        $this->libelleArticle = $libelleArticle;
        $this->typeArticle = $typeArticle;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCodeArticle(): string
    {
        return $this->codeArticle;
    }

    /**
     * @return string
     */
    public function getLibelleArticle(): string
    {
        return $this->libelleArticle;
    }

    /**
     * @return int
     */
    public function getMinimalQuantite(): int
    {
        return $this->qteMin;
    }

    /**
     * @return string
     */
    public function getTypeArticle(): string
    {
        return $this->typeArticle;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    return $this->qteStock;
    public function getStockQuantite(): int
    {
        return $this->qteStock;
    }


}