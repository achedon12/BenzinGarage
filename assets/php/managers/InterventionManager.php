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
     * @param int $id
     * @param string $dateRdv
     * @param string $heureRdv
     * @param string $descriptifDemande
     * @param int $kmActuel
     * @param bool $devisOn
     * @param string $etat
     * @param string $idOpérateur
     * @param Vehicle $vehicle
     * @param string $codeClient
     * @return bool
     */
    public function createIntervention(string $dateRdv, string $heureRdv, string $descriptifDemande, int $kmActuel, bool $devisOn, string $etat, string $idOpérateur, string $noimmatriculation, string $codeClient): bool{
        $sql = $this->pdo->query("SELECT max(numdde) FROM sae_garage.dde_interv");
        $newID = $sql->fetch(PDO::FETCH_ASSOC)['max'] + 1;
        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.dde_interv (numdde, daterdv, heurerdv, descriptif_demande, km_actuel, devis_on, etatdemande, idoperateur, noimmatriculation, codeclient) VALUES (:id, :date_rdv, :heure_rdv, :descriptif_demande, :km_actuel, :devis_on, :etat_demande, :id_operateur, :id_vehicule, :code_client)");
        $stmt->execute([
            "id" => (string)$newID,
            "date_rdv" => $dateRdv,
            "heure_rdv" => $heureRdv,
            "descriptif_demande" => $descriptifDemande,
            "km_actuel" => $kmActuel,
            "devis_on" => $devisOn,
            "etat_demande" => $etat,
            "id_operateur" => $idOpérateur,
            "id_vehicule" => $noimmatriculation,
            "code_client" => $codeClient
        ]);
        return $stmt;
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
     * Update information for a given interventions.
     * @param Intervention $intervention
     * @return bool
     */
    public function updateIntervention(Intervention $intervention): bool{
        $sql = "update sae_garage.dde_interv set daterdv = :dateVal, heurerdv = :heureVal , datedescriptif_demande = :descVal,km_actuel = :kmVal, devis_on = :devisVal, etatdemande = :etatVal, idOpVal = :idoperateur, noimmatriculation = :noImmaVal, codeclient = :codeClientVal where numdde = ?;";
        $stmt = $this->pdo->prepare($sql);
        if ( $stmt->execute([
            "dateVal" => $intervention->getDateRdv(),
            "heureVal" => $intervention->getHeureRdv(),
            "descVal" => $intervention->getDescriptifDemande(),
            "kmVal" => $intervention->getKmActuel(),
            "devisVal" => $intervention->isDevisOn(),
            "etatVal" => $intervention->getEtatdemande(),
            "idoperateur" => $intervention->getIdOperateur(),
            "noImmaVal" => $intervention->getVehicle()->getNumberPlate(),
            "codeClientVal" => $intervention->getClient()->getId()
        ])){ return true; }
        else { return false; }
    }

    /**
     * Add an intervention for a given client.
     * @param Intervention $intervention
     * @param Client $client
     * @return bool
     */
    public function addInterventionForClient(Intervention $intervention, Client $client): bool{
        $sql = "INSERT INTO sae_garage.intervention (date_rdv, heure_rdv, descriptif_demande, km_actuel, devis_on, etatdemande, idoperateur, noimmatriculation, codeclient) VALUES (:date_rdv, :heure_rdv, :descriptif_demande, :km_actuel, :devis_on, :etat, :id_operateur, :no_serie, :id_client)";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute([
            "date_rdv" => $intervention->getDateRdv(),
            "heure_rdv" => $intervention->getHeureRdv(),
            "descriptif_demande" => $intervention->getDescriptifDemande(),
            "km_actuel" => $intervention->getKmActuel(),
            "devis_on" => $intervention->isDevisOn(),
            "etatdemande" => $intervention->getEtatdemande(),
            "idoperateur" => $intervention->getIdOperateur(),
            "noimmatriculation" => $intervention->getVehicle()->getNoSerie(),
            "codeclient" => $client->getId()
        ])){return true;}
        else{return false;}
    }

    /**
     * Get price of a given intervention.
     * @param Intervention $intervention
     * @return int
     */
    public function getInterventionPrice(Intervention $intervention): int{
        $stmt = $this->pdo->prepare("select netapayer from sae_garage.facture join dde_interv using(numdde) where numdde = :numdde;");
        $stmt->execute([
            "numdde" => $intervention->getId()
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC)["netapayer"];
    }

    /**
     * Get all interventions.
     * @return array
     */
    public function getInterventionList(): array{
        $stmt = $this->pdo->prepare("select * from sae_garage.dde_interv;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get information from a given intervention.
     * @param Intervention $intervention
     * @return string
     */
    public function getInformationForTask(Intervention $intervention): string{
        $stmt = $this->pdo->prepare("select descriptif_demande from sae_garage.dde_interv where numdde = :numdde;");
        $stmt->execute([
            "numdde" => $intervention->getId()
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC)["descriptif_demande"];
    }
}