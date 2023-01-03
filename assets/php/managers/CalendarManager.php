<?php

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/InterventionManager.php";
require_once "assets/php/managers/ClientManager.php";
require_once "assets/php/managers/OperationManager.php";

class CalendarManager{

    private DateTime $date;
    private array $week;

    private InterventionManager $interventionManager;
    private ClientManager $clientManager;

    private OperationManager $operationManager;

    public function __construct()
    {
        $this->date = new DateTime();
        $this->date->setDate(date("Y"), date("m"), date("d"));
        $this->week = [];
        $this->interventionManager = new InterventionManager(DatabaseManager::getInstance());
        $this->clientManager = new ClientManager(DatabaseManager::getInstance());
        $this->operationManager = new OperationManager(DatabaseManager::getInstance());
    }

    /**
     * @return array
     */
    public function getWeek(): array{

        $date = $this->date;
        $date->modify('monday this week');
        for($i = 0; $i < 7; $i++){
            $this->week[] = $date->format('Y-m-d');
            $date->modify('+1 day');
        }
        return $this->week;
    }

    /**
     * @return array
     */
    public function nextWeek(): array
    {
        date_add($this->date, date_interval_create_from_date_string('7 days'));
        $this->week = [];
        return $this->getWeek();
    }

    /**
     * @return array
     */
    public function beforeWeek(): array
    {
        date_sub($this->date,date_interval_create_from_date_string("7 days"));
        $this->week = [];
        return $this->getWeek();
    }

    public function getDay(string $day): string{
        return match (strtolower($day)) {
            "lundi" => $this->getWeek()[0],
            "mardi" => $this->getWeek()[1],
            "mercredi" => $this->getWeek()[2],
            "jeudi" => $this->getWeek()[3],
            "vendredi" => $this->getWeek()[4],
            "samedi" => $this->getWeek()[5],
            "dimanche" => $this->getWeek()[6],
            default => $this->getWeek()[0],
        };
    }

    /**
     * @throws Exception
     */
    public function convertDate(string $date): string{
        $date = new DateTime($date);
        return $date->format('d/m');
    }

    public function displayTable(int $id, array $week, $admin = true): void{

        $rdv = [];
        $interventions = $this->interventionManager->getInterventionListForOperator($id);
        $ids = [];
        $theId = 0;

        echo "<div hidden id='idOphidden'>$id</div>";
        foreach($interventions as $intervention){
            $client = $this->clientManager->getClientByID($intervention->getCodeClient());
            //TODO: a mettre pour que ca fonctionne avec nimporte quelle date (tests)
            //if(in_array($intervention->getDateRdv(), $week)){
                $rdv[$this->getDayFromDate($intervention->getDateRdv())][$this->getHours($intervention->getHeureRdv())] = $client->getName()." ".$client->getFirstName();
                $ids[] = $intervention->getId();
            //}
        }

        $jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
        echo "<table>";
        echo "<tr><th>Heure</th>";
        for($x = 1; $x < 8; $x++) {
            echo "<th>" . $jour[$x] . "</th>";
        }
        echo "</tr>";
        for($j = 8; $j < 19; $j += 2) {
            echo "<tr>";
            for($i = 0; $i < 7; $i++) {
                if($i == 0) {
                    echo "<td class=\"time\">".$j."</td>";
                }
                echo '<td>';
                if(isset($rdv[$jour[$i+1]][$j])) {
                    echo '<div class="timeDate" hidden>'.array_values($interventions)[$theId]->getHeureRdv().'</div>';
                    echo '<a class="reservation" href="#popUpRDV" id="'.$ids[$theId].'">'.$rdv[$jour[$i+1]][$j].'</a>';
                    $theId++;
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    private function translateNumberIntoDay(int $number): string{
        return match ($number) {
            1 => "Lundi",
            2 => "Mardi",
            3 => "Mercredi",
            4 => "Jeudi",
            5 => "Vendredi",
            6 => "Samedi",
            7 => "Dimanche",
            default => "Lundi",
        };
    }

    private function getDayFromDate(string $date): string{
        $explode = explode("-", $date);
        $timstamp = mktime(0, 0, 0, (int)$explode[2], (int)$explode[1], (int)$explode[0]);
        return $this->translateNumberIntoDay(date("w", $timstamp));
    }

    private function getHours(string $time): int{
        $explode = explode(":", $time);
        return $explode[0];
    }

    private function getMinutes(string $time): int{
        $explode = explode(":", $time);
        return $explode[1];
    }

    private function getSeconds(string $time): int{
        $explode = explode(":", $time);
        return $explode[2];
    }

    public function displayPopup($admin = true): void
    {
        if($admin){
            echo '<section id="popUpRDV">
                <section id="intoPopUpRDV">
                    <h1 class="nomClientIntervention"></h1>
                    <h1 class="heureIntervention"></h1>
                    <section class="typeIntevrentionZone">
                        <section class="left"></section>
                        <section class="right">
                           '. $this->displayAllOperations().'
                           <button name="addIntervention" class="addIntervention">Ajouter l\'intervention</button>
                        </section>
                    </section>
                    <a href="#" class="close"><img src="../assets/img/not%20done.png" alt=""></a>
                    <button class="validerIntervention">Valider l\'intervention</button>
                </section>
            </section>';
        }else{
            echo '<section id="popUpRDV">
                <section id="intoPopUpRDV">
                    <h1 class="nomClientIntervention"></h1>
                    <h1 class="heureIntervention">8h20 - 10h00 (1h40)</h1>
                    <section class="typeIntevrentionZone">
                        <section class="left" style="flex-basis: 100%"></section>
                    </section>
                    <a href="#" class="close"><img src="../assets/img/not%20done.png" alt=""></a>
                </section>
            </section>';
        }

    }

    private function displayAllOperations(): string
    {
        $operations = $this->operationManager->getOperationList();
        $select = "<label for=\"typeIntervention\">Type d'intervention</label>";
        $select .= "<select name='typeIntervention' id='typeIntervention' class='typeIntervention'>";
        $select .= "<option disabled selected value='0'>-- Choisir une intervention --</option>";
        foreach($operations as $operation => $value){
            $select .= '<option id="' . $operation . '">' . $this->getLibelleOperation($operation) . '</option>';
        }
        $select .= "</select>";
        return $select;
    }

    private function getLibelleOperation(string $id): string
    {
        switch ($id) {
            case "ChangPneuAVG":
                $libelle = "changement pneu avant gauche";
                break;
            case "Vidange":
                $libelle = "vidange";
                break;
            case "Nettoyage":
                $libelle = "nettoyage";
                break;
            case "DemontBoitVitesse":
                $libelle = "démontage boite de vitesse";
                break;
            case "ChangPneuAVD":
                $libelle = "changement pneu avant droit";
                break;
        }
        return $libelle;
    }
}