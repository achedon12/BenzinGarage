<?php

class ClientManager{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Create a new Client.
     * @param string $name
     * @param string $firstName
     * @param string $adresse
     * @param int $codePostal
     * @param string $city
     * @param string $telephoneNumber
     * @param Vehicle $vehicle
     * @return Client
     */
    public function createClient(string $name, string $firstName, string $adresse, int $codePostal, string $city, string $telephoneNumber, Vehicle $vehicle): Client{

    }

    /**
     * Verify if a given client exist.
     * @param Client $client
     * @return bool
     */
    public function clientExist(Client $client): bool{

    }

    /**
     * Delete a given client.
     * @param Client $client
     * @return bool
     */
    public function deleteClient(Client $client): bool{

    }

    /**
     * Update informations for a given client
     * @param Client $client
     * @return Client
     */
    public function modifyClient(Client $client): Client{

    }

    /**
     * Get vehicle from a given client.
     * @param Client $client
     * @return Vehicle
     */
    public function getClientVehicle(Client $client): Vehicle{
        return $client->getVehicle();
    }

    /**
     * Verify if a given client has a vehicle.
     * @param Client $client
     * @return bool
     */
    public function clientHasVehicle(Client $client): bool{
        if($client->getVehicle() == null) return false; else{
            return true;
        }
    }

    /**
     * Add a new Vehicle for a given client.
     * @param Client $client
     * @param Vehicle $vehicle
     * @return bool
     */
    public function addVehicleToClient(Client $client, Vehicle $vehicle): bool{

    }

    /**
     * Remove a vehicle from a given client.
     * @param Client $client
     * @param Vehicle $vehicle
     * @return bool
     */
    public function removeVehicleFromClient(Client $client, Vehicle $vehicle): bool{

    }

    /**
     * Get a client from parameters.
     * @param int $id
     * @param string $name
     * @param string $firstName
     * @param string $adresse
     * @param int $codePostal
     * @param string $city
     * @param string $telephone
     * @param Vehicle|null $vehicle
     * @return Client
     */
    public function getClient(int $id, string $name, string $firstName, string $adresse, int $codePostal, string $city, string $telephone, Vehicle $vehicle = null): Client{
        return new Client($id,  $name, $firstName, $adresse, $codePostal, $city, $telephone,  $vehicle );
    }
}