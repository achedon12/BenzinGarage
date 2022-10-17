<?php

class Vehicle{

    private int $id;

    private string $numberPlate;

    private Client $client;

    public function __construct(int $id, string $numberPlate, Client $client){
        $this->id = $id;
        $this->numberPlate = $numberPlate;
        $this->client = $client;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getNumberPlate(): string{
        return $this->numberPlate;
    }

    public function getVehicleClient(): Client{
        return $this->client;
    }

}