<?php


require_once "../database/DatabaseManager.php";
require_once "../class/Intervention.php";
class Inter
{

    private PDO $pdo;
    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getIntervention(int $id): array{
        $stmt = $this->pdo->prepare("select * from sae_garage.dde_interv where numdde = :id;");
        $stmt->execute(["id" => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}