<?php

use Dompdf\Dompdf;

require_once "assets/php/class/Facture.php";

class FacturePdfManager{

    private FacturePDF $facture;

    public function __construct(FacturePDF $facture){
        $this->facture = $facture;
    }

    public function toPdf(){
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->toHtml());
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream("facture.pdf", [
            "Attachment" => false
        ]);
    }

    private function toHtml(): string{
        return str_replace(["{firstName}","{name}","{adresse}","{formeJuridique}","{numTVA}","{numFacture}","{date}"],
            [$this->facture->getClient()->getFirstName(),
                $this->facture->getClient()->getName(),
                $this->facture->getClient()->getAdresse(),
                "SARL",
                $this->facture->getFacture()->getTva(),
                $this->facture->getFacture()->getFactureNumber(),
                $this->facture->getFacture()->getFactureDate()

                ],file_get_contents("facture.html"));
    }

    /**
     * @return FacturePDF
     */
    public function getFacture(): FacturePDF
    {
        return $this->facture;
    }
}