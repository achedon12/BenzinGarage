<?php
require_once("./assets/php/class/Piece.php");
require_once("./assets/php/class/Client.php");
require_once("./assets/php/class/Facture.php");

class GarageManager
{

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
    public function getAvailablePiece(string $codearticle): int
    {
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
    public function getAllPieces(): array
    {
        /** @var  $array Piece[] */
        $array = [];
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.article");
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $piece) {
            $array[] = new Piece($piece["codearticle"], $piece["libellearticle"], $piece["qte_min"], $piece["typearticle"], $piece["prixunitactuelht"], $piece["qte_stock"]);
        }
        return $array;
    }

    /**
     * Get price from a given piece.
     * @param string $codearticle
     * @return float
     */
    public function getPiecePrice(string $codearticle): float
    {
        $query = $this->pdo->prepare("SELECT prixUnitActuelHT FROM sae_garage.article WHERE codeArticle = :codearticle");
        $query->execute([
            "codearticle" => $codearticle
        ]);
        $result = $query->fetch();
        return $result["prixunitactuelht"];
    }

    /**
     * Create a facture for a given Intervention.
     * @param string $datefacture
     * @param int $tauxtva
     * @param float $netapayer
     * @param string $etatfacture
     * @param int $numdde
     * @return bool
     */
    public function createFacture(string $datefacture, int $tauxtva, float $netapayer, string $etatfacture, int $numdde): bool
    {
        $sql = $this->pdo->query("SELECT max(nofacture) FROM sae_garage.facture ");
        $newId = $sql->fetch(PDO::FETCH_ASSOC)['max'] + 1;
        $query = $this->pdo->prepare("INSERT INTO sae_garage.facture (nofacture, datefacture,tauxtva,netapayer,etatfacture,numdde) VALUES (:nofacture, :datefacture,:tauxtva,:netapayer,:etatfacture,:numdde)");
        $query->execute([
            "nofacture" => $newId,
            "datefacture" => $datefacture,
            "tauxtva" => $tauxtva,
            "netapayer" => $netapayer,
            "etatfacture" => $etatfacture,
            "numdde" => $numdde
        ]);
        return true;
    }

    /**
     * Get all factures.
     * @return array
     */
    public function getAllFacture(): array
    {
        /** @var  $array Facture[] */
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.facture");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
}