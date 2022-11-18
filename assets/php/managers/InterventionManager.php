<?php

class InterventionManager {

    private PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Create an intervention for a given client.
     * @param Intervention $intervention
     * @return bool
     */
    public function createIntervention(Intervention $intervention): bool{
        $sql = "INSERT INTO sae_garage.intervention (date_rdv, heure_rdv, descriptif_demande, km_actuel, devis_on, etat, id_operateur, no_serie, id_client) VALUES (:date_rdv, :heure_rdv, :descriptif_demande, :km_actuel, :devis_on, :etat, :id_operateur, :no_serie, :id_client)";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute([
            "date_rdv" => $intervention->getDateRdv(),
            "heure_rdv" => $intervention->getHeureRdv(),
            "descriptif_demande" => $intervention->getDescriptifDemande(),
            "km_actuel" => $intervention->getKmActuel(),
            "devis_on" => $intervention->isDevisOn(),
            "etat" => $intervention->getEtatdemande(),
            "id_operateur" => $intervention->getIdOperateur(),
            "no_serie" => $intervention->getVehicle()->getNoSerie(),
            "id_client" => $intervention->getClient()->getId()
        ])){return true;}
        else{return false;}
    }


    /**
     * Verify if a given intervention exist.
     * @param Intervention $intervention
     * @return bool
     */
    public function existIntervention(Intervention $intervention): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sae_garage.intervention WHERE id = :id");
        $stmt->execute(["id" => $intervention->getId()]);
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
     * Get informations from a given intervention.
     * @param Intervention $intervention
     * @return string
     */
    public function getInformationForTask(Intervention $intervention): string{

    }
}