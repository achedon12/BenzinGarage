<?php

class Piece{

    private string $reference;

    private int $stock;

    private float $price;

    private string $name;

    public function __construct(string $name, string $reference, int $stock, float $price){
        $this->reference = $reference;
        $this->stock = $stock;
        $this->price = $price;
        $this->name = $name;
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

    public function getName(): string
    {
        return $this->name;
    }
}