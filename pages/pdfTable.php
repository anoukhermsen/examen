<?php

session_start();

require('../class/Extends/fpdf.php');
require('../class/Extends/exfpdf.php');
require('../class/Extends/easyTable.php');
include '../class/Sql.php';

//$pdf = new FPDF();
$pdf = new exFPDF();
$pdf->AddPage();
$sql = new Sql();


$pdf->SetFont('Arial','',10);

$table1=new easyTable($pdf, 2);
$table1->easyCell('', 'img:../img/klavertjevier.jpg, w40; align:L;');
$table1->easyCell('Rapportage uitgeschreven jongeren', 'align:R; font-size:30; font-style:B; font-color:#3CA222;');
$table1->printRow();

$table1->rowStyle('font-size:15; font-style:B;');
//$table1->easyCell('Gebruikers gegevens');
$table1->easyCell('Jongeren Kansrijker', 'align:L;');
$table1->printRow();
$table1->rowStyle('font-size:12;');

$table1->rowStyle('font-size:12;');
$table1->easyCell("M. Norton\n Muziekwijk 22/15 \n3564 ND Almere\n 0352 741 209", 'align:L;');
$table1->printRow();
$table1->endTable(5);

$table=new easyTable($pdf, '{35, 35, 35, 40, 35}','align:L{LLLLL};border:1; border-color:#a1a1a1; ');
$table->rowStyle('align:{LLLLL};valign:M;bgcolor:#000000; font-color:#ffffff; font-family:Arial; font-style:B;');
$table->easyCell('Jongere roepnaam');
$table->easyCell('Jongere tussenvoegsel');
$table->easyCell('Jongere achternaam');
$table->easyCell('Instituut/opleidings naam');
$table->easyCell('Start datum');
$table->printRow();

$table->rowStyle('valign:M;border:LR;paddingY:2;');
for($i=0; $i < 1; $i++)
{
    $bgcolor = '';
    if ($i % 2)
    {
        $bgcolor = 'bgcolor:#ccf2ff;';
    }

    $table->rowStyle('valign:M;border:LR;paddingY:2;' . $bgcolor);


//====================================================================

    $year = $_GET['id'];


    foreach ($sql->joinJongereInstituutPDF($year) as $value)
    {
        $yearST = $value['instituutStartdatum'];
        $myDate = DateTime::createFromFormat('Y-m-d', $value['instituutStartdatum']);
        $newDateString = $myDate->format('d-m-Y');

        $table->easyCell($value['jongereRoepnaam']);
        $table->easyCell($value['jongereTussenvoegsel']);
        $table->easyCell($value['jongereAchternaam']);
        $table->easyCell($value['instituutNaam']);
        $table->easyCell($newDateString);
        $table->printRow();
    }

}

//
//for($i=0; $i < 1; $i++)
//{
//    $bgcolor='';
//    if($i%2)
//    {
//        $bgcolor='bgcolor:#ccf2ff;';
//    }
//    $table->rowStyle('valign:M;border:LR;paddingY:2;' . $bgcolor);
//    $table->easyCell($naam);
//    $table->easyCell($tussenvoegsel);
//    $table->easyCell($achternaam);
//    $table->printRow();
//}
$table->endTable();

$pdf->Output('');