<?php

class InterventionManager extends DatabaseManager{

    /**
     * Create a intervention for a given client.
     * @param Client $client
     * @return Intervention
     */
    public function createIntervention(Intervention $ddeInterv, string $daterdv, string $heurerdv,string $descriptif_demande, int $km_actuel,bool $devisOn, int $etat,string $idOpérateur,Vehicle $vehicle, Client $client): bool{
        $stmt = $this->pdo->prepare("INSERT INTO sae_garage.dde_interv(numdde,daterdv,heurerdv,descriptif_demande,km_actuel,devis_on,etatdemande,idoperateur,noimmatriculation,codeclient)  VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$client->$client->codeclient]); // ici on doit rajouter tout les parametres pour la création
        return true;
    }

    /**
     * Verify if a given intervention exist.
     * @param Intervention $intervention
     * @return bool
     */
    public function existIntervention(Intervention $intervention): bool{

    }

    /**
     * Update informations for a given interventions.
     * @param Intervention $intervention
     * @return bool
     */
    public function updateIntervention(Intervention $intervention): bool{

    }

    /**
     * Add a intervention for a given client.
     * @param Intervention $intervention
     * @param Client $client
     * @return bool
     */
    public function addInterventionForClient(Intervention $intervention, Client $client): bool{

    }

    /**
     * Get price of a given intervention.
     * @param Intervention $intervention
     * @return int
     */
    public function getInterventionPrice(Intervention $intervention): int{

    }

    /**
     * Get all interventions.
     * @return array
     */
    public function getInterventionList(): array{

    }

    /**
     * Get informations from a given intervention.
     * @param Intervention $intervention
     * @return string
     */
    public function getInformationForTask(Intervention $intervention): string{

    }
}