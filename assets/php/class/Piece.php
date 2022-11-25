<?php

class Piece{

    private string $codeArticle;
    private string $libelleArticle;
    private int $quantiteMinimal;
    private string $typeArticle;
    private float $price;
    private int $quantiteStock;

    /**
     * @param string $codeArticle
     * @param string $libelleArticle
     * @param int $quantiteMinimal
     * @param string $typeArticle
     * @param float $price
     * @param int $quantiteStock
     */
    public function __construct(string $codeArticle, string $libelleArticle, int $quantiteMinimal, string $typeArticle, float $price, int $quantiteStock)
    {
        $this->codeArticle = $codeArticle;
        $this->libelleArticle = $libelleArticle;
        $this->quantiteMinimal = $quantiteMinimal;
        $this->typeArticle = $typeArticle;
        $this->price = $price;
        $this->quantiteStock = $quantiteStock;
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
        return $this->quantiteMinimal;
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
    public function getStockQuantite(): int
    {
        return $this->quantiteStock;
    }


}