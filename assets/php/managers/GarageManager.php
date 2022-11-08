<?php

class GarageManager extends DatabaseManager {

    /**
     * Get available account of a given piece.
     * @param Piece $piece
     * @return int
     */
    public function getAvailablePiece(Piece $piece): int{
        /** */
        $numberOfPiece = 0;
        $stmt = $this->getInstance()->query("select * from article where codearticle = ? and qte_stock > 0;");
        $numberOfPiece =
    }

    /**
     * Get All pieces.
     * @return array
     */
    public function getAllPieces(): array{
        /** @var  $array Piece[]*/
        $res = [];
        $stmt = $this->getInstance()->query("SELECT * FROM article;");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Piece($row['codearticle'], $row['libellearticle'], $row['qte_min'],$row['typearticle'],$row['prixunitactuelht'],$row['qte_stock']);
        return $res;
    }

    /**
     * Get price from a given piece.
     * @param Piece $piece
     * @return float
     */
    public function getPiecePrice(Piece $piece): float{

    }

    /**
     * Create a facture for a given client.
     * @param Client $client
     * @return Facture
     */
    public function createFacture(Client $client): Facture{

    }

    /**
     * Get all factures.
     * @return array
     */
    public function getAllFacture(): array{

    }
}