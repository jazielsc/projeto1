<?php

error_reporting(0);

require_once($_SERVER['DOCUMENT_ROOT']."/boletim/fpdf/fpdf.php");
$pdf = new FPDF();

$pdf->SetMargins(10, 10, 10);
$pdf->Open();
$pdf->AddPage();


$conn = mysql_connect("mysql01.boletimflex.com","boletimflex","rootflex123");
mysql_select_db("boletimflex") or die ("ERRO seleciona banco!");


$cod_aluno = $_POST['cod_aluno'];
if(isset($_POST['ano'])){
			$ano = (int)$_POST['ano'];
			} else{
                            $ano = date("Y");
                        }

if($ano != ""){
                         $where = " AND YEAR(turma.data) = '$ano'";
                     } else{
                        $where = "";
                     }

$str[3] = utf8_decode("DISCIPLINAS");
$str[0] = utf8_decode("Horário");


$query_select = mysql_query("SELECT instituicao.nome, aluno.nome, EXTRACT(YEAR FROM data) as ANO FROM turma, instituicao, aluno WHERE turma.cod_instituicao = instituicao.cod_instituicao AND aluno.cod_instituicao = instituicao.cod_instituicao AND cod_aluno = '$cod_aluno' $where") or die (mysql_error(). "erro em select");

$result = mysql_fetch_array($query_select);



$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(0, 7, $result[0],0 , 'C');
$pdf->MultiCell(0, 7, $str[3],0 , 'C');
$pdf->ln(5);
$pdf->Cell(140, 5, "Aluno: $result[1]", 0, 0, 'L');
$pdf->Cell(50, 5, "Ano: $result[2]", 0, 0, 'L');


$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 9);

	// 195
	$pdf->Cell(70, 5, "Disciplina", 1, 0, 'L');
	$pdf->Cell(65, 5, "Curso", 1, 0, 'L');
	$pdf->Cell(60, 5, "Turma", 1, 0, 'L');
	
	$pdf->Ln();


$query_notas = mysql_query("SELECT cod_item2, aluno.nome, disciplina.nome, curso.nome, turma.nome FROM item2, disciplina, aluno, curso, turma WHERE turma.cod_turma = disciplina.cod_turma AND turma.cod_curso = curso.cod_curso AND curso.cod_curso = disciplina.cod_curso AND item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND aluno.cod_aluno = '$cod_aluno' AND aluno.cod_status = 1 $where ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");


while ($result2 = mysql_fetch_array($query_notas)){ // retornando os valores da consulta em array e enviando para o flash

$pdf->Cell(70, 5, "$result2[2]", 1, 0, 'L');
$pdf->Cell(65, 5, "$result2[3]", 1, 0, 'L');
$pdf->Cell(60, 5, "$result2[4]", 1, 0, 'L');

$pdf->ln(5);

}


$pdf->Output();

?>