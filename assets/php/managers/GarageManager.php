<?php

class GarageManager{

    /**
     * Get available account of a given piece.
     * @param Piece $piece
     * @return int
     */
    public function getAvailablePiece(Piece $piece): int{

    }

    /**
     * Get All pieces.
     * @return array
     */
    public function getAllPieces(): array{
        /** @var  $array Piece[]*/
       $array = [];
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