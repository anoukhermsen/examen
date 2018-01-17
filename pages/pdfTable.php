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
$table1->easyCell('Raportage', 'font-size:30; font-style:B; font-color:#00bfff;');
$table1->easyCell('', 'img:../images/demo/backgrounds/logo-landstede.jpg, w40; align:R;');
$table1->printRow();

$table1->rowStyle('font-size:15; font-style:B;');
$table1->easyCell('Gebruikers gegevens');
$table1->easyCell('Landstede Harderwijk', 'align:R;');
$table1->printRow();
$table1->rowStyle('font-size:12;');

$table = "jongere";
$where = 'jongereId';
$columnSort = "jongereId";
$id = $_GET['id'];
$result = new Crud();
foreach ($result->selectFromTable($table, null, $where, $id, null, null, null, $columnSort) as $value)
{
    $naam = $value['jongereRoepnaam'];
    $tussenvoegsel = $value['jongereTussenvoegsel'];
    $achternaam = $value['jongereAchternaam'];
    $myDate = DateTime::createFromFormat('Y-m-d', $value['jongereGeboortedatum']);
    $newDateString = $myDate->format('d-m-Y');
}

$tables = "activiteit";
$columnSorts = "activiteitId";
foreach ($result->selectFromTable($tables, null, null, null, null, null, null, $columnSorts) as $value)
{
    $factuurnummer = $value['activiteitId'];
}


$table1->rowStyle('font-size:12;');
$table1->easyCell("<b>Name:</b> $naam $tussenvoegsel $achternaam\n<b>Geboortedatum:</b> $newDateString\n");
$table1->easyCell("Gerben Dijkstra\n Westeinde 33 \n Harderwijk\n 3844 DD\n 0341 437 937", 'align:R;');
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