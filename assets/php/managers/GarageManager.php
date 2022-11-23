<?php
require_once("./assets/php/class/Piece.php");

class GarageManager {

    private PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get available account of a given piece.
     * @param string $codearticle
     * @return int
     */
    public function getAvailablePiece(string $codearticle): int{
        $query = $this->pdo->prepare("SELECT qte_Stock FROM sae_garage.article WHERE codeArticle = :codearticle");
        $query->execute([
            "codearticle" => $codearticle
        ]);
        $result = $query->fetch();
        return $result["qte_stock"];
    }

    /**
     * Get All pieces.
     * @return array
     */
    public function getAllPieces(): array{
        /** @var  $array Piece[]*/
        $array = [];
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.article");
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $piece){
            $array[] = new Piece($piece["codearticle"], $piece["libellearticle"], $piece["qte_min"], $piece["typearticle"], $piece["prixunitactuelht"], $piece["qte_stock"]);
        }
        return $array;
    }

    /**
     * Get price from a given piece.
     * @param string $codearticle
     * @return float
     */
    public function getPiecePrice(string $codearticle): float{
        $query = $this->pdo->prepare("SELECT prixUnitActuelHT FROM sae_garage.article WHERE codeArticle = :codearticle");
        $query->execute([
            "codearticle" => $codearticle
        ]);
        $result = $query->fetch();
        return $result["prixunitactuelht"];
    }

    /**
     * Create a facture for a given client.
     * @param Client $client
     * @return Facture
     */
    public function createFacture(Client $client): Facture{
        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.facture(nofacture,datefacture,tauxtva,netapayer,etatfacture,numdde)VALUES (?,'2022-07-22',20,15.99,'Emise',1);");
        $stmt->execute([$client->$client->id]);
    }

    /**
     * Get all factures.
     * @return array
     */
    public function getAllFacture(): array{
        /** @var  $array Facture[]*/
        $res = [];
        $stmt = $this->pdo->query("select * from sae_garage.facture;");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Facture($row['nofacture'], $row['datefacture'], $row['tauxtva'],$row['netapayer'],$row['etatfacture'],$row['numdde']);
        return $res;
    }
}