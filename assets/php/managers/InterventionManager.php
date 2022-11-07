<?php

class InterventionManager{

    /**
     * Create a intervention for a given client.
     * @param Client $client
     * @return Intervention
     */
    public function createIntervention(Client $client): Intervention{

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