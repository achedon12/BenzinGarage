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
}