<?php

class OperationManager
{

    const TAUX_TVA = 20;

    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getOperationListForIntervention(int $numdde): array{
        $stmt = $this->pdo->prepare("select * from sae_garage.prevoir_ope join sae_garage.operation using(codeop) where numdde = :numdde;");
        $stmt->execute(["numdde" => $numdde]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getOperationById(string $idOpe){
        $stmt = $this->pdo->prepare("select * from sae_garage.operation where codeop=:id");
        $stmt->execute(["id"=> $idOpe]);
        return $stmt->fetchAll();
    }

    public function getCoutHorraire(string $codeTarif){
        $requete=$this->pdo->prepare("select couthoraireactuelht from sae_garage.tarif_mo where codetarif=:code");
        $requete->execute(["code"=> $codeTarif]);
        $tarifHorraire = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $tarifHorraire;
    }

    public function deleteOperationForIntervention(int $param, mixed $codeop)
    {
        $stmt = $this->pdo->prepare("delete from sae_garage.prevoir_ope where numdde = :numdde and codeop = :codeop;");
        $stmt->execute(["numdde" => $param, "codeop" => $codeop]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addOperationForIntervention(int $numdde,string $codeop): array{
        $stmt = $this->pdo->prepare("insert into sae_garage.prevoir_ope (numdde,codeop,couthoraireht,duree_prevue) values(:numdde,:codeop,NULL,NULL);");
        $stmt->execute(["numdde" => $numdde, "codeop" => $codeop]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTauxTVA(): float{
        return self::TAUX_TVA;
    }

    public function getOperationInformations(int $numdde): array{
        $stmt = $this->pdo->prepare("select * from sae_garage.prevoir_ope where numdde = :numdde;");
        $stmt->execute(["numdde" => $numdde]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOperationAEffectuerToPDF(int $numdde): array{
        $stmt = $this->pdo->prepare("select idop_ef,libelleop from sae_garage.operation_effectuer where numdde = :numdde;");
        $stmt->execute(["numdde" => $numdde]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPriceForOperation(int $codeTarif): float{
        $stmt = $this->pdo->prepare("select couthoraireactuelht from sae_garage.tarif_mo where codetarif = :codetarif;");
        $stmt->execute(["codetarif" => $codeTarif]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["couthoraireactuelht"];
    }

    public function hasIntervention(int $param, mixed $codeop): bool
    {
        $stmt = $this->pdo->prepare("select * from sae_garage.prevoir_ope where numdde = :numdde and codeop = :codeop;");
        $stmt->execute(["numdde" => $param, "codeop" => $codeop]);
        return count($stmt->fetchAll(PDO::FETCH_ASSOC)) > 0;
    }

    public function getOperations(): array{
        $query = $this->pdo->prepare("SELECT * FROM sae_garage.operation");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}