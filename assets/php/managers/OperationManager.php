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

    /**
     * @return array[]
     */
    public function getOperationList(): array{
       return [
           "ChangPneuAVG" => [
                "libelleop" => "chPnAVG",
                "dureeop" => 0.3,
                "codetarif" => 5
           ],
           "Vidange" => [
                "libelleop" => "VidFiltHuil",
                "dureeop" => 1.3,
                "codetarif" => 4
           ],
           "ChangPneuAVD" => [
                "libelleop" => "ChPnAVD",
                "dureeop" => 0.3,
                "codetarif" => 5
           ],
           "Nettoyage" => [
                "libelleop" => "Nettoy",
                "dureeop" => 0.1,
                "codetarif" => 2
           ],
            "DemontBoitVitesse" => [
                "libelleop" => "DmtBVits",
                "dureeop" => 2,
                "codetarif" => 7
            ]
       ];
    }


    public function getOperationListForIntervention(int $numdde): array{
        $stmt = $this->pdo->prepare("select * from sae_garage.operation_effectuer where numdde = :numdde;");
        $stmt->execute(["numdde" => $numdde]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addOperationForIntervention(int $numdde,string $codeop): array{
        $sql = $this->pdo->query("SELECT max(idop_ef) FROM sae_garage.operation_effectuer");
        $newID = $sql->fetch(PDO::FETCH_ASSOC)['max'] + 1;
        $libelle = "";
        switch ($codeop){
            case "ChangPneuAVG":
                $libelle = "ChPnAVG";
                break;
            case "Vidange":
                $libelle = "VidFiltHuil";
                break;
            case "Nettoyage":
                $libelle = "Nettoy";
                break;
            case "DemontBoitVitesse":
                $libelle = "DmtBVits";
                break;
            case "ChangPneuAVD":
                $libelle = "ChPnAVD";
                break;
        }
        $stmt = $this->pdo->prepare("insert into sae_garage.operation_effectuer (idop_ef, libelleop, codeop, numdde) values (:idop_ef, :libelleop, :codeop, :numdde);");
        $stmt->execute(["idop_ef" => $newID,"libelleop" => $libelle, "codeop" => $codeop, "numdde" => $numdde]);
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
        $stmt = $this->pdo->prepare("delete from sae_garage.operation_effectuer where numdde = :numdde and codeop = :codeop;");
        $stmt->execute(["numdde" => $param, "codeop" => $codeop]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTauxTVA(): float{
        return self::TAUX_TVA;
    }

    public function getOperationInformations(int $numdde): array{
        //TODO: to patch
        $stmt = $this->pdo->prepare("select idop_ef,libelleop, codeop, numdde, dureeop, codetarif, couthoraireht, duree_prevue from sae_garage.operation_effectuer join sae_garage.operation using(codeop) join prevoir_ope using(codeop) where numdde = :numdde;");
        $stmt->execute(["numdde" => $numdde]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}