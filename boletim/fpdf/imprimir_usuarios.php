<?php
 //session_start();

 error_reporting(0);
 
require_once($_SERVER['DOCUMENT_ROOT']."/boletim/fpdf/fpdf.php");
$pdf = new FPDF();

$pdf->SetMargins(10, 10, 10);
$pdf->Open();
$pdf->AddPage();

$conn = mysql_connect("mysql01.boletimflex.com","boletimflex","rootflex123");
mysql_select_db("boletimflex") or die ("ERRO seleciona banco!");

$cod_instituicao = (int) $_SESSION['id_instituicao'];
$cod_turma = $_POST['cod_turma'];
$cod_curso = $_POST['cod_curso'];

$str[2] = utf8_decode("Média");
$str[3] = utf8_decode("LISTA DE USUÁRIOS");
$str[0] = utf8_decode("Num.");

if ($cod_turma != ""){
                     $where_p = "turma.cod_turma = '$cod_turma' AND";
                     $where = "turma.cod_curso = curso.cod_curso AND turma.cod_turma = '$cod_turma' AND
                         disciplina.cod_disciplina = item2.cod_disciplina
                         AND item2.cod_aluno = aluno.cod_aluno AND disciplina.cod_turma = '$cod_turma' AND";
                     $tabela = ",turma, disciplina, item2";
                     }
                     else{
                     $where_p = "";
                     $where = "";
                     $tabela = "";
                     }


$query_select = mysql_query("SELECT curso.nome, turma.nome, instituicao.nome
FROM curso, turma, instituicao
WHERE $where_p curso.cod_curso = turma.cod_curso AND curso.cod_curso = '$cod_curso' AND instituicao.cod_instituicao = curso.cod_instituicao AND instituicao.cod_instituicao = '$cod_instituicao'") or die (mysql_error(). "erro em select");

$result = mysql_fetch_array($query_select);


$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(0, 7, $result[2],0 , 'C');
$pdf->MultiCell(0, 7, $str[3],0 , 'C');
$pdf->ln(5);
$pdf->Cell(55, 5, "Curso: $result[0]", 0, 0, 'L');

if($cod_turma!= "")
$pdf->Cell(150, 5, "Turma: $result[1]", 0, 0, 'L');


$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 8);

	
	$pdf->Cell(10, 5, "$str[0]", 1, 0, 'L');
	$pdf->Cell(85, 5, "Aluno", 1, 0, 'L');
	$pdf->Cell(75, 5, "Login", 1, 0, 'L');
        $pdf->Cell(25, 5, "Identidade", 1, 0, 'L');
        
        $pdf->Ln();


$query_notas = mysql_query("SELECT DISTINCT usuario.nome, usuario_login, aluno.identidade FROM usuario, curso, aluno $tabela
                            WHERE $where aluno.cod_curso = '$cod_curso' AND usuario.cod_instituicao = '$cod_instituicao' AND
                            curso.cod_curso = aluno.cod_curso AND referencia = 1 AND cod_aluno_professor = aluno.cod_aluno
 ORDER BY usuario.nome",$conn) or die ("Error na consulta1");


$colocacao = 1;


while ($result2 = mysql_fetch_array($query_notas)){ // retornando os valores da consulta em array e enviando para o flash

$pdf->Cell(10, 5, "$colocacao", 1, 0, 'L');
$pdf->Cell(85, 5, "$result2[0]", 1, 0, 'L');
$pdf->Cell(75, 5, "$result2[1]", 1, 0, 'L');
$pdf->Cell(25, 5, "$result2[2]", 1, 0, 'L');

$pdf->ln(5);

$colocacao++;


}


$pdf->Output();

?>