<?php
require_once "./assets/php/class/Modele.php";
class ModeleManager{
    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function getAllModele():array{
        $array = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.modele");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $array[] = new Modele($row["nummodele"], $row["modele"], $row["nummarque"]);

        return $array;
    }




}
