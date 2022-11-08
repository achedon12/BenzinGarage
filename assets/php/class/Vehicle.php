<?php

class Vehicle{

    private int $id;
    private int $numSerie;
    private int $numModel;
    private date $dateRoadRelease;
    private int $client;

    public function __construct(int $id, int $numSerie, int $numModel, date $dateRoadRelease, int $client){
        $this->id = $id;
        $this->numSerie = $numSerie;
        $this->numModel = $numModel;
        $this->dateRoadRelease = $dateRoadRelease;
        $this->client = $client;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getVehicleClient(int $client): int{

    }

    public function getVehicleModel(): int{
        return $this->model;
    }

    public function getVehicleDateRoadRelease(): date{
        return $this->dateRoadRelease;
    }

    public function getVehicleNumSerie(): int{
        return $this->numSerie;
    }


}