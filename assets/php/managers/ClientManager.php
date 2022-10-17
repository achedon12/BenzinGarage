<?php

class ClientManager{

    public function createClient(): Client{

    }

    public function clientExist(Client $client): bool{

    }

    public function deleteClient(Client $client): bool{

    }

    public function modifyClient(Client $client): Client{

    }

    public function getClientVehicle(Client $client): Vehicle{
        return $client->getVehicle();
    }

    public function clientHasVehicle(Client $client): bool{
        if($client->getVehicle() == null) return false; else{
            return true;
        }
    }

    public function addVehicleToClient(Client $client, Vehicle $vehicle): bool{

    }

    public function removeVehicleFromClient(Client $client, Vehicle $vehicle): bool{

    }

    public function getClient(int $id, string $name, string $firstName, string $adresse, int $codePostal, string $city, string $telephone, Vehicle $vehicle = null): Client{
        return new Client($id,  $name, $firstName, $adresse, $codePostal, $city, $telephone,  $vehicle );
    }
}