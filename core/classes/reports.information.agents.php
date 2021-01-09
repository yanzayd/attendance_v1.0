<?php
// require 'core/init.php';
// require 'core/FPDF/fpdf.php';

/**
 *
 */
class myPDF extends FPDF
{
  function header() {
    $this->Image(LOGO_HA, 130,6,50);
  }

  function footer() {
    $this->SetY(-15);
    $this->SetFont('cambria','B',14);
    $this->Cell(0,15,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    $this->Ln();
  }

  function viewTable() {

#Repport Divulgation
    $this->Cell(280,5,'',0,3,'C');
    $this->SetFont('arial','B',12);
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(290,2,'INFORMATION DE l\'AGENT',0,1,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Ln();

    $this->Cell(280,5,'',0,4,'C');
    $this->SetFont('arial','B',12);
    $this->Cell(290,2,'APPROPOS DE L\'AGENT',0,1,'L');
    $this->cell(285,5,'',0,1,'L');
    $this->SetFont('arial','B',12);
    $this->Cell(140,7,' Matricule',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Noms',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Sex',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Date de Naissance',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Etat Civil',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Nationalite',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Niveau d\'Etude',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Numero de piece d\'identite',1,0,'L');
    $this->Cell(140,7,'',1,1,'C');

    $this->Cell(140,7,'Departement',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Bureau',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Fonction',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(280,9,'',0,4,'L');
    $this->Cell(80,2,'CONTACT ET ADDRESS DE L\'AGENT',0,1,'L');
    $this->cell(285,5,'',0,1,'L');
    $this->SetFont('arial','B',12);
    $this->Cell(140,7,' Address E-mail',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Telephone 1 & 2',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Province / Ville',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Commune',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');

    $this->Cell(140,7,'Quartier / Avenue / No',1,0,'L');
    $this->Cell(140,7,'',1,1,'L');


  }



}
  $pdf=new myPDF();
  $pdf->AliasNbPages();
  $pdf->AddPage('L','A4',0);
  $pdf->viewTable();
  $pdf->Output();


 ?>
