<?php

require_once "assets/php/class/Facture.php";

class FactureManager{

    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    /**
     * Get all factures.
     * @return Facture[]
     */
    public function getAllFacture(): array{
        /** @var Facture[] $res */
        $res = [];
        $stmt = $this->pdo->prepare("SELECT * FROM sae_garage.facture");
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
            $res[] = new Facture($row["nofacture"], $row["datefacture"], $row["tauxtva"], $row["netapayer"], $row["etatfacture"], $row["numdde"]);
        }
        return $res;
    }

    /**
     * Get all factures where the state is not paid.
     * @param int $id
     * @return bool
     */
    public function factureExist(int $id): bool{
        $array = $this->getAllFacture();
        foreach ($array as $facture){
            if ($facture->getFactureNumber() === $id){
                return true;
            }
        }
        return false;
    }

    /**
     * Get a facture by its id.
     * @param int $id
     * @return Facture|null
     */
    public function getFacture(int $id): ?Facture{
        $array = $this->getAllFacture();
        foreach ($array as $facture){
            if ($facture->getFactureNumber() === $id){
                return $facture;
            }
        }
        return null;
    }



}