<?php

class GarageManager {

    private PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get available account of a given piece.
     * @param Piece $codearticle
     * @return int
     */
    public function getAvailablePiece(Piece $codearticle): int{
        /** */
        $stmt = $this->pdo->query("select qte_stock from sae_garage.article where codearticle = ? ;");
        return $stmt->execute([$codearticle->codearticle]);
    }

    /**
     * Get All pieces.
     * @return array
     */
    public function getAllPieces(): array{
        /** @var  $array Piece[]*/
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM sae_garage.article;");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Piece($row['codearticle'], $row['libellearticle'], $row['qte_min'],$row['typearticle'],$row['prixunitactuelht'],$row['qte_stock']);
        return $res;
    }

    /**
     * Get price from a given piece.
     * @param Piece $codearticle
     * @return float
     */
    public function getPiecePrice(Piece $codearticle): float{
        $stmt = $this->pdo->query("select prixunitactuelht from sae_garage.article where codearticle = ?;");
        return $stmt->execute([$codearticle->$codearticle->codearticle]);
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