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
     * Get a client from a given id.
     * @param string $id
     * @return Client|null
     */
    public function getClient(string $id): ?Client{
        $sql = "SELECT * FROM sae_garage.client WHERE codeclient = :id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->bindParam(':id', $id, PDO::PARAM_STR);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $result = $prepare->fetchAll();
            return new Client($result[0]["codeclient"],$result[0]["nom"],$result[0]["prenom"],$result[0]["adresse"],$result[0]["codepostal"],$result[0]["ville"],$result[0]["tel"],$result[0]["mail"],$result[0]["datecreation"]);
        }
        return null;
    }
}