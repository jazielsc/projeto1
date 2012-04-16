<?php
require_once($_SERVER['DOCUMENT_ROOT']."/boletim/fpdf/fpdf.php");
$pdf = new FPDF();

$pdf->SetMargins(10, 10, 10);
$pdf->Open();
$pdf->AddPage();




$conn = mysql_connect("mysql01.boletimflex.com","boletimflex","rootflex123");
mysql_select_db("boletimflex") or die ("ERRO seleciona banco!");


$cod_turma = $_POST['cod_turma'];



$str[3] = utf8_decode("LISTA DE ALUNOS");
$str[0] = utf8_decode("Matrícula");


$query_select = mysql_query("SELECT instituicao.nome, curso.nome, turma.nome FROM instituicao, curso, turma WHERE turma.cod_curso = curso.cod_curso AND curso.cod_instituicao = instituicao.cod_instituicao AND turma.cod_turma = '$cod_turma'") or die (mysql_error(). "erro em select");

$result = mysql_fetch_array($query_select);



$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(0, 7, $result[0],0 , 'C');
$pdf->MultiCell(0, 7, $str[3],0 , 'C');
$pdf->ln(5);
$pdf->Cell(55, 5, "Curso: $result[1]", 0, 0, 'L');
$pdf->Cell(150, 5, "Turma: $result[2]", 0, 0, 'L');


$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 9);

	
	$pdf->Cell(35, 5, "$str[0]", 1, 0, 'L');
	$pdf->Cell(90, 5, "Aluno", 1, 0, 'L');
	$pdf->Cell(70, 5, "Curso", 1, 0, 'L');
	$pdf->Ln();


$query_notas = mysql_query("SELECT DISTINCT matricula, aluno.nome, curso.nome
FROM aluno, disciplina, item2, curso
WHERE disciplina.cod_turma = '$cod_turma'
AND disciplina.cod_disciplina = item2.cod_disciplina
AND item2.cod_aluno = aluno.cod_aluno AND curso.cod_curso = aluno.cod_curso
ORDER BY aluno.nome",$conn) or die ("Error na consulta1");


while ($result2 = mysql_fetch_array($query_notas)){ // retornando os valores da consulta em array e enviando para o flash

$pdf->Cell(35, 5, "$result2[0]", 1, 0, 'L');
$pdf->Cell(90, 5, "$result2[1]", 1, 0, 'L');
$pdf->Cell(70, 5, "$result2[2]", 1, 0, 'L');

$pdf->ln(5);

}


$pdf->Output();

?>