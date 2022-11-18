<?php
require_once("./assets/php/database/DatabaseManager.php");

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
     * @return Client
     */
    public function createClient(int $id, string $name, string $firstName, string $adresse, int $codePostal, string $city, string $telephoneNumber, string $email, date $dateCreation): Client{
        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.client (codeclient, nom, prenom, adresse, codepostal, ville, tel, mail, datecreation ) VALUES (:id, :nom, :prenom, :adresse, :codePostal, :ville, :telephone, :mail, :dateCreation)");
        $stmt->execute([
            "id"=>$id,
            "nom" => $name,
            "prenom" => $firstName,
            "adresse" => $adresse,
            "codePostal" => $codePostal,
            "ville" => $city,
            "telephone" => $telephoneNumber,
            "mail" => $email,
            "dateCreation" => $dateCreation
        ]);
        return new Client($this->pdo->lastInsertId(), $name, $firstName, $adresse, $codePostal, $city, $telephoneNumber, $email, $dateCreation);
    }

    /**
     * Verify if a given client exist.
     * @param Client $client
     * @return bool
     */
    public function clientExist(Client $client): bool{
        $stmt = $this->pdo->prepare("SELECT * FROM sae_garage.client WHERE id = :id");
        $stmt->execute(["id" => $client->getId()]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Delete a given client.
     * @param Client $client
     * @return bool
     */
    public function deleteClient(Client $client): bool
    {
        if ($this->clientExist($client)) {
            $stmt = $this->pdo->prepare("DELETE FROM sae_garage.client WHERE id = :id");
            $stmt->execute(["id" => $client->getId()]);
            return true;
        }
        return false;
    }

    /**
     * Update informations for a given client
     * @param Client $client
     * @return Client
     */
    public function modifyClient(Client $client): Client{
        return $client;
    }


    /**
     * Get vehicle from a given client.
     * @param Client $client
     * @return Vehicle
     */
    public function getClientVehicle(Client $client): Vehicle{
        $stmt = $this->pdo->prepare("SELECT * FROM sae_garage.vehicule WHERE codeclient = :id");
        $stmt->execute(["id" => $client->getId()]);
        $result = $stmt->fetch();
        return new Vehicle($result["numberPlate"],$result["noSerie"],$result["dateMiseEnCirculation"],$result["numModele"],$result["client"]);
        }


    /**
     * Verify if a given client has a vehicle.
     * @param Client $client
     * @return bool
     */
    public function clientHasVehicle(Client $client): bool{
        $stmt = $this->pdo->prepare("SELECT * FROM sae_garage.vehicule WHERE codeclient = :id");
        $stmt->execute(["id" => $client->getId()]);
        return $stmt->rowCount() > 0;
    }


    /**
     * Remove a vehicle from a given client.
     * @param Client $client
     * @param Vehicle $vehicle
     * @return bool
     */
    public function removeVehicleFromClient(Client $client, Vehicle $vehicle): bool{
        if ($this->$vehicle->clientHasVehicle($client)){
            $stmt = $this->pdo->prepare("DELETE FROM sae_garage.vehicule WHERE codeclient = :id and numimmatriculation = :numImmatriculation");
            $stmt->execute([
                "id" => $client->getId()
                , "numImmatriculation" => $vehicle->getNumberPlate()
            ]);
            return true;
        }
        return false;
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
     * @param string $mail
     * @param string $datecreation
     * @return Client
     */
    public function getClient(int $id, string $name, string $firstName, string $adresse, int $codePostal, string $city, string $telephone, string $mail, string $datecreation): Client{
        return new Client($id, $name, $firstName, $adresse, $codePostal, $city, $telephone, $mail, $datecreation);
    }
}