<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require_once "assets/php/class/Facture.php";
require_once "assets/php/managers/OperationManager.php";
require_once "assets/php/database/DatabaseManager.php";

class FacturePdfManager{

    private FacturePDF $facture;
    private OperationManager $operationManager;

    public function __construct(FacturePDF $facture){
        $this->facture = $facture;
        $this->operationManager = new OperationManager(DatabaseManager::getInstance());
    }

    public function toPdf(){
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($this->toHtml());
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents("C:\laragon\www\sae\\facture/facture_{$this->facture->getFacture()->getFactureNumber()}.pdf", $output);

        $dompdf->stream("facture.pdf", [
            "Attachment" => true,
            "isPhpEnabled" => true
        ]);
    }


    private function toHtml(): string{

        return str_replace(["{firstName}","{name}","{adresse}","{formeJuridique}","{numTVA}","{numFacture}","{date}","{priceHT}","{tauxTVA}","{priceTTC}"],
            [$this->facture->getClient()->getFirstName(),
                $this->facture->getClient()->getName(),
                $this->facture->getClient()->getAdresse(),
                "SARL",
                $this->facture->getFacture()->getTva(),
                $this->facture->getFacture()->getFactureNumber(),
                $this->facture->getFacture()->getFactureDate(),
                $this->getSumOperationPrice(),
                $this->facture->getFacture()->getTva(),
                $this->getSumOperationPrice() * (1 + $this->facture->getFacture()->getTva() / 100),
                ],$this->getHtml());
    }

    /**
     * @return FacturePDF
     */
    public function getFacture(): FacturePDF
    {
        return $this->facture;
    }

    private function getHtml(): string{
        return '
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }

        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .bold{
            font-weight: bold;
        }

        main
        {
            flex-direction: column;
            margin-top: 10px;
        }

        article
        {
            margin-left: 1%;
            margin-right: 1%;
            border: 1px solid rgb(22, 161, 22);
            width: 40%;
            display: flex;
            flex-direction: column;
        }

        article>*
        {
            padding: 1px;
        }


        section
        {
            margin-top: 10px;
            width: 100%;
            display: flex;
        }

        section:nth-child(1)
        {
            justify-content: left;
        }

        section:nth-child(2)
        {
            justify-content: right;
        }

        table
        {
            margin-top: 10px;
            width: 100%;
            text-align: center;
        }

        tr:nth-child(2N)
        {
            background-color: gainsboro;
            margin: 1%;
        }

        th
        {
            background-color: rgb(18, 14, 44);
            padding: 1%;
            color: white;
        }

        table.custom
        {
            margin-top: 10px;
            width: 15%;
            text-align: center;
            margin-left: 80%;
        }
    </style>
</head>
<body>
<main>
    <section>
        <article>
            <h1 class="bold">Identification du vendeur</h1>
            <h3>Nom : Indépendant</h3>
            <h3>Adresse :  51 Rue Barthélémy de Laffemas, 26000 Valence</h3>
            <h3>Numéro de SIREN : 123 456 789</h3>
            <h3>Numéro de téléphone : 04 75 41 88 00</h3>
            <h3>Enregistré au RCS/RM de Paris</h3>
        </article>
    </section>
    <section>
        <article>
            <h1 class="bold">Client</h1>
            <h3>Nom : {firstName} {name}</h3>
            <h3>Adresse : {adresse}</h3>
            <h3>Forme juridique : {formeJuridique}</h3>
            <h3>Numéro de TVA : {numTVA}</h3>
        </article>
    </section>
    <h2 class="bold">Facture n°{numFacture}</h2>
    <h3>Date : {date}</h3>
    <table style="border-color: rgb(18, 14, 44);">
        <thead>
        <tr>
            <th>Désignation des produits ou prestations</th>
            <th>Quantité</th>
            <th>Prix unitaire HT</th>
            <th>Total HT</th>
        </tr>
        </thead>
        <tbody id="operations" style="background-color: white; border-color: rgb(18, 14, 44);">
            '.$this->getOperations().'
        </tbody>
    </table>
    <table class="custom" style="background-color: rgb(18, 14, 44);">
        <thead>
        <tr>
            <th>Total HT</th>
            <th colspan="2" style="color: rgb(18, 14, 44); background-color: white; border: 1px solid rgb(18, 14, 44);">{priceHT}</th>
        </tr>
        </thead>
        <tbody style="color: white;">
        <tr>
            <td colspan="2">Montant de TVA</td>
            <td>{tauxTVA}%</td>
        </tr>
        </tbody>
        <thead style="border: 1px solid rgb(18, 14, 44);">
        <tr>
            <th>TOTAL TTC</th>
            <th colspan="2" style="color: rgb(18, 14, 44); background-color: white;">{priceTTC}</th>
        </tr>
        </thead>
    </table>
</main>
</body>
</html>
        ';
    }

    private function getOperations(): string{
        $operations = "";
        foreach ($this->facture->getOperations() as $operation){
            $operations .= '
            <tr style="border-color: rgb(18, 14, 44);">
                <td style="border-color: rgb(18, 14, 44);">'.$operation["codeop"].'</td>
                <td>1</td>
                <td>'.(float)$operation["couthoraireht"].'</td>
                <td>'.(float)$operation["couthoraireht"].'</td>
            </tr>
            ';
        }
        return $operations;
    }

    private function getSumOperationPrice(): float{
        $sum = 0;
        foreach ($this->facture->getOperations() as $operation){
            $sum += (float)$operation["couthoraireht"];
        }
        return $sum;
    }

}