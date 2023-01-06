<?php

require_once "./assets/php/class/Intervention.php";
class InterventionManager {

    private PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Create an intervention for a given client.
     * @param string $dateRdv
     * @param string $heureRdv
     * @param string $descriptifDemande
     * @param int $kmActuel
     * @param bool $devisOn
     * @param string $etat
     * @param string $idOpérateur
     * @param string $noimmatriculation
     * @param string $codeClient
     * @return bool
     */
    public function createIntervention(string $dateRdv, string $heureRdv, string $descriptifDemande, int $kmActuel, bool $devisOn, string $etat, string $idOpérateur, string $noimmatriculation, string $codeClient): bool{
        $sql = $this->pdo->query("SELECT max(numdde) FROM sae_garage.dde_interv");
        $newID = $sql->fetch(PDO::FETCH_ASSOC)['max'] + 1;
        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.dde_interv VALUES (:id, :date_rdv, :heure_rdv, :descriptif_demande, :km_actuel, :devis_on,:id_operateur, :id_vehicule, :codeclient,:etat_demande)");
        $stmt->execute([
            "id" => (string)$newID,
            "date_rdv" => $dateRdv,
            "heure_rdv" => $heureRdv,
            "descriptif_demande" => $descriptifDemande,
            "km_actuel" => $kmActuel,
            "devis_on" => $devisOn,
            "id_operateur" => $idOpérateur,
            "id_vehicule" => $noimmatriculation,
            "codeclient" => $codeClient,
            "etat_demande" => $etat
        ]);
        return true;
    }


    /**
     * Verify if a given intervention exist.
     * @param int $numdde
     * @return bool
     */
    public function existIntervention(int $numdde): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sae_garage.dde_interv WHERE numdde = :id");
        $stmt->execute(["id" => $numdde]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Update information for a given intervention.
     * @param string $daterdv
     * @param string $heurerdv
     * @param string $descriptif_demande
     * @param int $km_actuel
     * @param bool $devis_on
     * @param string $etatdemande
     * @param string $idoperateur
     * @param string $noimmatriculation
     * @param string $codeclient
     * @param int $numdde
     * @return bool
     */
    public function updateIntervention(string $daterdv, string $heurerdv, string $descriptif_demande, int $km_actuel, bool $devis_on,string $etatdemande,string $idoperateur, string $noimmatriculation, string $codeclient,int $numdde): bool{
        $sql = ("UPDATE sae_garage.dde_interv SET daterdv = :daterdv, heurerdv = :heurerdv, descriptif_demande = :descriptif_demande, km_actuel = :km_actuel, devis_on = :devis_on, etatdemande = :etatdemande, idoperateur = :idoperateur, noimmatriculation = :noimmatriculation, codeclient = :codeclient WHERE numdde = :numdde");
        $stmt = $this->pdo->prepare($sql);
        if ( $stmt->execute([
            "daterdv" => $daterdv,
            "heurerdv" => $heurerdv,
            "descriptif_demande" => $descriptif_demande,
            "km_actuel" => $km_actuel,
            "devis_on" => $devis_on,
            "etatdemande" => $etatdemande,
            "idoperateur" => $idoperateur,
            "noimmatriculation" => $noimmatriculation,
            "codeclient" => $codeclient,
            "numdde" => $numdde
        ])){ return true; }
        else { return false; }
    }

    /**
     * Add an intervention for a given client.
     * @param Intervention $intervention
     * @return bool
     */
    public function addInterventionForClient(Intervention $intervention): bool{
        $sql = "INSERT INTO sae_garage.intervention (date_rdv, heure_rdv, descriptif_demande, km_actuel, devis_on, etatdemande, idoperateur, noimmatriculation, codeclient) VALUES (:date_rdv, :heure_rdv, :descriptif_demande, :km_actuel, :devis_on, :etat, :id_operateur, :no_serie, :id_client)";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute(
[
                "date_rdv" => $intervention->getDateRdv(),
                "heure_rdv" => $intervention->getHeureRdv(),
                "descriptif_demande" => $intervention->getDescriptifDemande(),
                "km_actuel" => $intervention->getKmActuel(),
                "devis_on" => $intervention->getDevis(),
                "etat" => $intervention->getEtatdemande(),
                "id_operateur" => $intervention->getIdOperateur(),
                "no_serie" => $intervention->getNumeroImmatriculation(),
                "id_client" => $intervention->getCodeClient()
            ]
        )){ return true; }
        else { return false; }
    }

    /**
     * Get price of a given intervention.
     * @param int $numdde
     * @return float
     */
    public function getInterventionPrice(int $numdde): float{
        $stmt = $this->pdo->prepare("select netapayer from sae_garage.facture where numdde = :numdde;");
        $stmt->execute([
            "numdde" => $numdde
        ]);
        return (float)$stmt->fetch(PDO::FETCH_ASSOC)["netapayer"];
    }

    /**
     * Get all interventions.
     * @return array
     */
    public function getInterventionList(): array{
        /** @var Intervention[] $array */
        $array = [];
        $stmt = $this->pdo->prepare("select * from sae_garage.dde_interv;");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item){
            $array[] = new Intervention(
                (int)$item["numdde"],
                $item["daterdv"],
                $item["heurerdv"],
                $item["descriptif_demande"],
                (int)$item["km_actuel"],
                (bool)$item["devis_on"],
                $item["etatdemande"],
                $item["idoperateur"],
                $item["noimmatriculation"],
                $item["codeclient"]
            );
        }
        return $array;
    }

    /**
     * Get information from a given intervention.
     * @param int $numdde
     * @return string
     */
    public function getInformationForTask(int $numdde): string{
        $stmt = $this->pdo->prepare("select descriptif_demande from sae_garage.dde_interv where numdde = :numdde;");
        $stmt->execute([
            "numdde" => $numdde
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC)["descriptif_demande"];
    }

    /**
     * Get all interventions for a given operator.
     * @param int $id
     * @return array
     */
    public function getInterventionListForOperator(int $id): array{
        /** @var Intervention[] $array */
        $array = [];
        $stmt = $this->pdo->prepare("select * from sae_garage.dde_interv where idoperateur = :id and codeclient is not null;");
        $stmt->execute([
            "id" => $id
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item){
            $array[] = new Intervention(
                (int)$item["numdde"],
                $item["daterdv"],
                $item["heurerdv"],
                $item["descriptif_demande"],
                (int)$item["km_actuel"],
                (bool)$item["devis_on"],
                $item["idoperateur"],
                $item["noimmatriculation"],
                $item["codeclient"],
                $item["etatdemande"]
            );
        }
        return $array;
    }


    public function getCodeClientFromDemandeIntervention(int $numdde): string{
        $stmt = $this->pdo->prepare("select codeclient from sae_garage.dde_interv where numdde = :numdde;");
        $stmt->execute([
            "numdde" => $numdde
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["codeclient"];
    }

    public function getLastInterventionInserted(): int{
        $stmt = $this->pdo->prepare("select max(numdde) as numdde from sae_garage.dde_interv;");
        $stmt->execute();
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)["numdde"];
    }

}