<?php
require_once("./assets/php/class/Client.php");
require_once("./assets/php/class/Vehicle.php");

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
     * @param string $email
     * @return bool
     */
    public function createClient(string $name, string $firstName, string $adresse, int $codePostal, string $city, string $telephoneNumber, string $email): bool{
        $sql = $this->pdo->query("SELECT max(codeclient) FROM sae_garage.client");
        $newID = $sql->fetch(PDO::FETCH_ASSOC)['max'] + 1;
        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.client (codeclient, nom, prenom, adresse, codepostal, ville, tel, mail, datecreation ) VALUES (:id, :nom, :prenom, :adresse, :codePostal, :ville, :telephone, :mail, :dateCreation)");
        $stmt->execute([
            "id"=>(string)$newID,
            "nom" => $name,
            "prenom" => $firstName,
            "adresse" => $adresse,
            "codePostal" => $codePostal,
            "ville" => $city,
            "telephone" => $telephoneNumber,
            "mail" => $email,
            "dateCreation" => date("Y-n-d")
        ]);
        return true;
    }

    /**
     * Verify if a given client exist.
     * @param string $codeclient
     * @return bool
     */
    public function clientExist(string $codeclient): bool{
        $stmt = $this->pdo->prepare("SELECT * FROM sae_garage.client WHERE codeclient = :id");
        $stmt->execute(["id" => $codeclient]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Delete a given client.
     * @param string $codeclient
     * @return bool
     */
    public function deleteClient(string $codeclient): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM sae_garage.client WHERE codeclient = ?");
        $stmt->execute([$codeclient]);
        return true;
    }

    /**
     * Update information for a given client
     * @param Client $client
     * @param string $id
     * @return bool
     */
    public function modifyClient(Client $client,string $id): bool{
        $stmt = $this->pdo->prepare("UPDATE sae_garage.client SET nom = :nom, prenom = :prenom, adresse = :adresse, codepostal = :codePostal, ville = :ville, tel = :telephone, mail = :mail, datecreation = :dateCreation WHERE codeclient = :id");
        $stmt->execute([
            "id" => $id,
            "nom" => $client->getName(),
            "prenom" => $client->getFirstName(),
            "adresse" => $client->getAdresse(),
            "codePostal" => $client->getCodePostal(),
            "ville" => $client->getCity(),
            "telephone" => $client->getTelephoneNumber(),
            "mail" => $client->getEmail(),
            "dateCreation" => $client->getDateCreation()
        ]);
        return true;
    }



    /**
     * Get vehicle from a given client.
     * @param string $codeclient
     * @return Vehicle
     */
    public function getClientVehicle(string $codeclient): Vehicle{
        $stmt = $this->pdo->prepare("SELECT * FROM sae_garage.vehicule WHERE codeclient = :id");
        $stmt->execute(["id" => $codeclient]);
        $result = $stmt->fetch();
        return new Vehicle($result["numberPlate"],$result["noSerie"],$result["dateMiseEnCirculation"],$result["numModele"],$result["client"]);
    }

    /**
     * Verify if a given client has a vehicle.
     * @param string $codeclient
     * @return bool
     */
    public function clientHasVehicle(string $codeclient): bool{
        $stmt = $this->pdo->prepare("SELECT * FROM sae_garage.vehicule WHERE codeclient = :id");
        $stmt->execute(["id" =>$codeclient]);
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
     * Get a client from a given id.
     * @param string $id
     * @return Client|null
     */
    public function getClientByID(string $id): ?Client{
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

    /**
     * Get all clients.
     * @return array
     */
    public function getAllClients(): array{
        /** @var $res Client[]*/
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.client order by codeclient");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Client($row["codeclient"], $row["nom"], $row["prenom"], $row["adresse"], $row["codepostal"], $row["ville"], $row["tel"],$row["mail"],$row["datecreation"] );
        return $res;
    }
}