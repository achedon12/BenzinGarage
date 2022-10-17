<?php

class Intervention{

    const INTERVENTION_END = 0;
    const INTERVENTION_START = 1;
    const INTERVENTION_VERIFY = 2;

    private int $id;

    private Client $client;

    private string $startDate;

    private string $endDate;

    private int $etat;

    private float $price;

    public function __construct(int $id, Client $client, string $startDate,string $endDate, int $etat, float $price){
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->client = $client;
        $this->etat = $etat;
        $this->price = $price;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getStartDate(): string{
        return $this->startDate;
    }

    public function getEndDate(): string{
        return $this->endDate;
    }

    public function getClient(): Client{
        return $this->client;
    }

    public function getEtat(): int{
        return $this->etat;
    }

    public function getPrice(): float{
        return $this->price;
    }

}