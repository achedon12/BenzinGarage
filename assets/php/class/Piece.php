<?php

class Piece{

    private string $reference;

    private int $stock;

    private float $price;

    public function __construct(string $reference, int $stock, float $price){
        $this->reference = $reference;
        $this->stock = $stock;
        $this->price = $price;
    }

    public function getReference(): string{
        return $this->reference;
    }

    public function getStock(): int{
        return $this->stock;
    }

    public function getPrice(): int{
        return $this->price;
    }

}