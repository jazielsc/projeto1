<?php
require_once($_SERVER['DOCUMENT_ROOT']."/boletim/fpdf/fpdf.php");
$pdf = new FPDF();

$pdf->SetMargins(10, 10, 10);
$pdf->Open();
$pdf->AddPage();




$conn = mysql_connect("mysql01.boletimflex.com","boletimflex","rootflex123");
mysql_select_db("boletimflex") or die ("ERRO seleciona banco!");


$cod_turma = $_POST['cod_turma'];



$str[3] = utf8_decode("DISCIPLINAS");
$str[0] = utf8_decode("Horário");


$query_select = mysql_query("SELECT instituicao.nome, curso.nome, turma.nome, date_format(data,'%d/%m/%Y') AS data, turno, semestre FROM turma, instituicao, curso WHERE turma.cod_instituicao = instituicao.cod_instituicao AND turma.cod_curso = curso.cod_curso AND cod_turma = '$cod_turma'") or die (mysql_error(). "erro em select");

$result = mysql_fetch_array($query_select);



$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(0, 7, $result[0],0 , 'C');
$pdf->MultiCell(0, 7, $str[3],0 , 'C');
$pdf->ln(5);
$pdf->Cell(55, 5, "Curso: $result[1]", 0, 0, 'L');
$pdf->Cell(150, 5, "Turma: $result[2]", 0, 0, 'L');


$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 9);

	// 195
	$pdf->Cell(45, 5, "Disciplina", 1, 0, 'L');
	$pdf->Cell(40, 5, "Curso", 1, 0, 'L');
	$pdf->Cell(40, 5, "Turma", 1, 0, 'L');
	$pdf->Cell(70, 5, "Professor", 1, 0, 'L');
	$pdf->Ln();


$query_notas = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.nome, turma.nome FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma AND turma.cod_turma = '$cod_turma' ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");


while ($result2 = mysql_fetch_array($query_notas)){ // retornando os valores da consulta em array e enviando para o flash

$pdf->Cell(45, 5, "$result2[2]", 1, 0, 'L');
$pdf->Cell(40, 5, "$result2[1]", 1, 0, 'L');
$pdf->Cell(40, 5, "$result2[4]", 1, 0, 'L');
$pdf->Cell(70, 5, "$result2[3]", 1, 0, 'L');

$pdf->ln(5);

}


$pdf->Output();

?>