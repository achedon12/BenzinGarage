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
     * Get piece with ID
     */
    public function getPieceById(string $codearticle)
    {
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.article WHERE codearticle =:codearticle");
        $query->execute([
            "codearticle" => $codearticle
        ]);
        return $query->fetch();
    }

    /**
     * modify a piece with ID
     *
     */
    public function modifyPiece(Piece $piece, string $id):bool
    {
        $stmt = $this->pdo->prepare("UPDATE sae_garage.article SET codearticle=:codearticle, libellearticle=:libellearticle, qte_min=:qte_min, typearticle=:typearticle, prixunitactuelht=:prixunitactuelht, qte_stock=:qte_stock WHERE codearticle = :id");
        $stmt->execute([
            "codearticle" => $id,
            "libellearticle" => $piece->getLibelleArticle(),
            "qte_min" => $piece->getMinimalQuantite(),
            "typearticle" => $piece->getTypeArticle(),
            "prixunitactuelht" => $piece->getPrice(),
            "qte_stock" => $piece->getStockQuantite(),
            "id" =>$id
        ]);
        return true;
    }

    public function modifyVehicule( Vehicle $vehicle, string $idClient){
        $stmt = $this->pdo->prepare("UPDATE sae_garage.vehicule SET noimmatriculation=:codenoimm, noserie=:noSer, datemiseencirculation=:miseencir, nummodele=:nummo, codeclient=:codeclient WHERE codeclient = :idClient");
        $stmt->execute([
            "codenoimm"=> $vehicle->getNumberPlate(),
            "noSer"=> $vehicle->getNumeroSerie(),
            "miseencir"=> $vehicle->getDateMiseEnCirculation(),
            "nummo"=> $vehicle->getNumerModele(),
            "codeclient"=> $vehicle->getClient(),
            "idClient"=> $idClient
        ]);
        return true;
    }

    /**
     * Get All pieces.
     * @return array
     */
    public function getAllPieces(): array
    {
        /** @var  $array Piece[] */
        $array = [];
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.article Order By codearticle");
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $piece) {
            $array[] = new Piece($piece["codearticle"], $piece["libellearticle"], $piece["qte_min"], $piece["typearticle"], $piece["prixunitactuelht"], $piece["qte_stock"]);
        }
        return $array;
    }

    /**
     * Get All pieces available.
     * @return array
     */
    public function getAllPiecesAvailable(): array
    {
        /** @var  $array Piece[] */
        $array = [];
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.article WHERE commander=false ");
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $piece) {
            $array[] = new Piece($piece["codearticle"], $piece["libellearticle"], $piece["qte_min"], $piece["typearticle"], $piece["prixunitactuelht"], $piece["qte_stock"]);
        }
        return $array;
    }


    /**
     * Get All pieces not available.
     * @return array
     */
    public function getAllPiecesUnAvailable(): array
    {
        /** @var  $array Piece[] */
        $array = [];
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.article WHERE commander=true ");
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $piece) {
            $array[] = new Piece($piece["codearticle"], $piece["libellearticle"], $piece["qte_min"], $piece["typearticle"], $piece["prixunitactuelht"], $piece["qte_stock"]);
        }
        return $array;
    }




    /**
     * Get All pieces not available.
     * @return array
     */
    public function getAllPiecesNotAvailable(): array
    {
        /** @var  $array Piece[] */
        $array = [];
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.article WHERE qte_Stock<=qte_min");
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
        return $query->fetchAll();
    }

    /**
     * Get all pieces where stock are lower than a given value.
     * @param int $value
     * @return Piece[]
     */
    public function getAvailablePieceWhereStockLowerThan(int $value): array{
        /** @var Piece[] $array */
        $array = [];
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.article WHERE qte_stock < :value");
        $query->execute([
            "value" => $value
        ]);
        $result = $query->fetchAll();
        foreach ($result as $piece) {
            $array[] = new Piece($piece["codearticle"], $piece["libellearticle"], $piece["qte_min"], $piece["typearticle"], $piece["prixunitactuelht"], $piece["qte_stock"]);
        }
        return $array;
    }


    public function setAvailablePieceWhenRefill(int $idProduct){
        $query=$this->pdo->prepare("SELECT qte_min,qte_stock FROM sae_garage.article where codearticle=:id");
        $query->execute([
            "id"=> $idProduct
        ]);
        $result=$query->fetchAll();
        $qte_min=$result[0]['qte_min'];
        $qte_stock=$result[0]['qte_stock'];
        $query2=$this->pdo->prepare("UPDATE sae_garage.article set qte_stock=:newqte where codearticle=:id");
        $query2->execute([
            "newqte"=> $qte_stock+$qte_min,
            "id"=> $idProduct
        ]);

    }

    public function plusOneProduct(string $id){
        $query=$this->pdo->prepare("SELECT qte_stock FROM sae_garage.article where codearticle=:id");
        $query->execute([
            "id"=> $id
        ]);
        $res= $query->fetchAll();
        $stmt = $this->pdo->prepare("UPDATE sae_garage.article set qte_stock=:value where codearticle=:id");
        $stmt->execute([
            "value"=> $res[0][0]+1,
            "id"=> $id
        ]);
        return true;
    }

    public function moinsOneProduct(string $id){
        $query=$this->pdo->prepare("SELECT qte_stock FROM sae_garage.article where codearticle=:id");
        $query->execute([
            "id"=> $id
        ]);
        $res= $query->fetchAll();
        $stmt = $this->pdo->prepare("UPDATE sae_garage.article set qte_stock=:value where codearticle=:id");
        $stmt->execute([
            "value"=> $res[0][0]-1,
            "id"=> $id
        ]);
        return true;
    }



}