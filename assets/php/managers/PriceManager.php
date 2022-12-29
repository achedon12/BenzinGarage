<?php
class PriceManager
{
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPriceByID(string $codeTarif){
        $requete=$this->pdo->prepare("select couthoraireactuelht from sae_garage.tarif_mo where codetarif=:code");
        $requete->execute(["code"=> $codeTarif]);
        $taHor = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $taHor;
    }

    public function getAllPrice(){
        $requete=$this->pdo->prepare("select * from sae_garage.tarif_mo");
        $requete->execute();
        $taHor = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $taHor;
    }

}