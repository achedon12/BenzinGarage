<?php

use Dompdf\Dompdf;

require_once "assets/php/class/Facture.php";
require_once "assets/php/class/FacturePDF.php";
require_once "assets/php/managers/OperationManager.php";
require_once "assets/php/managers/FacturePdfManager.php";
require_once "assets/php/managers/InterventionManager.php";
require_once "assets/php/managers/ClientManager.php";
require_once "assets/php/database/DatabaseManager.php";

class FactureManager{

    private PDO $pdo;
    private OperationManager $operationManager;
    private ClientManager $clientManager;
    private InterventionManager $interventionManager;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
        $this->operationManager = new OperationManager(DatabaseManager::getInstance());
        $this->clientManager = new ClientManager(DatabaseManager::getInstance());
        $this->interventionManager = new InterventionManager(DatabaseManager::getInstance());
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

    public function toForm(Facture $facture): void{
        echo '
            <form class="facture">
                <article>
                    <label for="nofacture">Numéro de facture :</label>
                    <input type="text" name="nofacture" value="'.$facture->getFactureNumber().'" readonly>
                </article>
                <article>
                    <label for="datefacture">Date facture :</label>
                    <input type="text" name="datefacture" value="'.$facture->getFactureDate().'" readonly>
                </article>
                <article>
                    <label for="tauxtva">Taux TVA :</label>
                    <input type="text" name="tauxtva" value="'.$facture->getTva().'" readonly>
                </article>
                <article>
                    <label for="netapayer">Net à payer :</label>
                    <input type="text" name="netapayer" value="'.$facture->getToPay().'" readonly>
                </article>
                <article>
                    <label for="etatfacture">Etat facture :</label>
                    <input type="text" name="etatfacture" value="'.$facture->getEtat().'" readonly>
                </article>
                <article>
                    <label for="numdde">Numéro demande :</label>
                    <input type="text" name="numdde" value="'.$facture->getNumDde().'" readonly>
                </article>
            </form>
        ';
    }

    public function createFacturePDF(Facture $facture): void
    {
        $operations = $this->operationManager->getOperationInformations($facture->getNumDde());
        //print_r($operations[0]["codeop"]);
        (new FacturePdfManager(new FacturePDF($facture,$operations,$this->clientManager->getClientByID($this->interventionManager->getCodeClientFromDemandeIntervention($facture->getNumDde())))))->toPdf();
    }
}