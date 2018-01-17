<?php

session_start();

require('../class/Extends/fpdf.php');
require('../class/Extends/exfpdf.php');
require('../class/Extends/easyTable.php');
include '../class/Crud.php';

//$pdf = new FPDF();
$pdf = new exFPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$table1=new easyTable($pdf, 2);
$table1->easyCell('Rapportage', 'font-size:30; font-style:B; font-color:#3CA222;');
$table1->easyCell('', 'img:../img/klavertjevier.jpg, w40; align:R;');
$table1->printRow();

$table1->rowStyle('font-size:15; font-style:B;');
//$table1->easyCell('Gebruikers gegevens');
$table1->easyCell('Jongeren Kansrijker', 'align:R;');
$table1->printRow();
$table1->rowStyle('font-size:12;');

$table = "jongere";
$where = 'jongereId';
$columnSort = "jongereId";
$id = $_SESSION['gebruikersId'];
$result = new Crud();
foreach ($result->selectFromTable($table, null, $where, $id, null, null, null, $columnSort) as $value)
{
    $naam = $value['jongereRoepnaam'];
    $tussenvoegsel = $value['jongereTussenvoegsel'];
    $achternaam = $value['jongereAchternaam'];
    $myDate = DateTime::createFromFormat('Y-m-d', $value['jongereGeboortedatum']);
    $newDateString = $myDate->format('d-m-Y');
    $myDateInschrijf = DateTime::createFromFormat('Y-m-d H:i:s', $value['jongereInschrijfdatum']);
    $newDateStringInschrijf = $myDateInschrijf->format('d-m-Y H:i:s');
}

$tables = "activiteit";
$columnSorts = "activiteitId";
foreach ($result->selectFromTable($tables, null, null, null, null, null, null, $columnSorts) as $value)
{
    $factuurnummer = $value['activiteitId'];
}


$table1->rowStyle('font-size:12;');
$table1->easyCell("\n\n\n");
$table1->easyCell("M. Norton\n Muziekwijk 22/15 \n3564 ND Almere\n 0352 741 209", 'align:R;');
$table1->printRow();
$table1->endTable(5);
//====================================================================

$products=array(
    'Deelnamen aan Lanparty',
    );

$table=new easyTable($pdf, '{130, 20, 20, 20}','align:C{LCRR};border:1; border-color:#a1a1a1; ');

$table->rowStyle('align:{CCCR};valign:M;bgcolor:#000000; font-color:#ffffff; font-family:Arial; font-style:B;');
$table->easyCell('Product');
$table->easyCell('Aantal');
$table->easyCell('Prijs');
$table->printRow();

for($i=0; $i < 1; $i++)
{
    $bgcolor='';
    if($i%2)
    {
        $bgcolor='bgcolor:#ccf2ff;';
    }
    $table->rowStyle('valign:M;border:LR;paddingY:2;' . $bgcolor);
    $table->easyCell($products[$i]);
    $table->easyCell(1+$i);
    $table->easyCell('5 euro');
    $table->printRow();
}


$pdf->Output('');