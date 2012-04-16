<?php
require_once($_SERVER['DOCUMENT_ROOT']."/boletim/fpdf/fpdf.php");
$pdf = new FPDF();

$pdf->SetMargins(10, 10, 10);
$pdf->Open();
$pdf->AddPage();




$conn = mysql_connect("mysql01.boletimflex.com","boletimflex","rootflex123");
mysql_select_db("boletimflex") or die ("ERRO seleciona banco!");


$cod_turma = $_POST['cod_turma'];
$cod_curso = $_POST['cod_curso'];


$str[2] = utf8_decode("Média");
$str[3] = utf8_decode("RANKING");
$str[0] = utf8_decode("Num.");

if ($cod_turma != ""){
                     $where = "AND boletim.cod_turma = '$cod_turma'";
                     $where_p = "AND turma.cod_turma = '$cod_turma'";
                     }
                     else{
                     $where = "";
                     $where_p = "";
                     }


             



$query_select = mysql_query("SELECT curso.nome, turma.nome, instituicao.nome
FROM curso, turma, instituicao
WHERE instituicao.cod_instituicao = curso.cod_instituicao AND curso.cod_curso = turma.cod_curso AND curso.cod_curso = '$cod_curso' $where_p") or die (mysql_error(). "erro em select");

$result = mysql_fetch_array($query_select);


$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(0, 7, $result[2],0 , 'C');
$pdf->MultiCell(0, 7, $str[3],0 , 'C');
$pdf->ln(5);
$pdf->Cell(55, 5, "Curso: $result[0]", 0, 0, 'L');
if($cod_turma != "")
$pdf->Cell(150, 5, "Turma: $result[1]", 0, 0, 'L');



$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 9);

	
	$pdf->Cell(10, 5, "$str[0]", 1, 0, 'L');
	$pdf->Cell(70, 5, "Aluno", 1, 0, 'L');
	$pdf->Cell(50, 5, "Curso", 1, 0, 'L');
        $pdf->Cell(50, 5, "Turma", 1, 0, 'L');
        $pdf->Cell(15, 5, "$str[2]", 1, 0, 'L');

        $pdf->Ln();


$query_notas = mysql_query("SELECT aluno.nome, curso.nome, turma.nome, disciplina.nome, TRUNCATE( AVG( media ) , 2) AS media_geral, max(media) AS nota
FROM aluno, curso, turma, disciplina, boletim
WHERE boletim.cod_aluno = aluno.cod_aluno
AND boletim.cod_curso = curso.cod_curso
AND turma.cod_turma = boletim.cod_turma
AND boletim.cod_disciplina = disciplina.cod_disciplina
AND boletim.cod_professor = disciplina.cod_professor
AND boletim.cod_curso = '$cod_curso' $where GROUP BY aluno.nome
ORDER BY media_geral DESC, nota DESC, aluno.nome",$conn) or die ("Error na consulta1");


$colocacao = 1;

while ($result2 = mysql_fetch_array($query_notas)){ // retornando os valores da consulta em array e enviando para o flash

$pdf->Cell(10, 5, "$colocacao", 1, 0, 'L');
$pdf->Cell(70, 5, "$result2[0]", 1, 0, 'L');
$pdf->Cell(50, 5, "$result2[1]", 1, 0, 'L');
$pdf->Cell(50, 5, "$result2[2]", 1, 0, 'L');
$pdf->Cell(15, 5, "$result2[4]", 1, 0, 'L');

$pdf->ln(5);


$colocacao++;

}


$pdf->Output();

?>