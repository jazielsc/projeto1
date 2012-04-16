<?php
require_once($_SERVER['DOCUMENT_ROOT']."/boletim/fpdf/fpdf.php");
$pdf = new FPDF();

$pdf->SetMargins(10, 10, 10);
$pdf->Open();
$pdf->AddPage();




$conn = mysql_connect("mysql01.boletimflex.com","boletimflex","rootflex123");
mysql_select_db("boletimflex") or die ("ERRO seleciona banco!");

$codigo = $_POST['codigo'];



$str[0] = utf8_decode("Matrícula");
$str[1] = utf8_decode("Horário");
$str[2] = utf8_decode("Média");
$str[3] = utf8_decode("PLANO DE AULA");
$str[4] = utf8_decode("Média do Curso");
$str[5] = utf8_decode("Total de Carga Horária");


$query_select = mysql_query("SELECT date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome, curso.nome, dia_numero, plano_aula, atividades, semestre FROM plano_aula, disciplina, professor, turma, curso WHERE plano_aula.cod_curso = curso.cod_curso AND disciplina.cod_curso = curso.cod_curso AND turma.cod_curso = curso.cod_curso AND  plano_aula.cod_plano_aula = '$codigo' AND disciplina.cod_professor = professor.cod_professor AND plano_aula.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND plano_aula.cod_turma = turma.cod_turma AND plano_aula.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio") or die (mysql_error(). "erro em select");

$result = mysql_fetch_array($query_select);



$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(0, 7, $str[3],0 , 'C');
$pdf->ln(5);
$pdf->Cell(55, 5, "Curso: $result[7]", 0, 0, 'L');
$pdf->Cell(90, 5, "Turma: $result[6]", 0, 0, 'L');
$pdf->Cell(40, 5, "Disciplina: $result[4]", 0, 0, 'L');
$pdf->ln(5);
$pdf->Cell(145, 5, "Professor: $result[5]", 0, 0, 'L');
$pdf->Cell(50, 5, "SEMESTRE / UNIDADE: $result[11]", 0, 0, 'L');

$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 9);

	
	$pdf->Cell(30, 5, "Dia", 1, 0, 'L');
	$pdf->Cell(40, 5, "$str[1]", 1, 0, 'L');
	$pdf->Cell(50, 5, "Disciplina", 1, 0, 'L');
	$pdf->Cell(70, 5, "Professor", 1, 0, 'L');
	$pdf->Ln();



$pdf->Cell(30, 5, "$result[0]", 1, 0, 'L');
$pdf->Cell(40, 5, "$result[3] - $result[1] - $result[2] ", 1, 0, 'L');
$pdf->Cell(50, 5, "$result[4]", 1, 0, 'L');
$pdf->Cell(70, 5, "$result[5]", 1, 0, 'L');


$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(55, 5, "Plano de Aula:", 0, 0, 'L');
$pdf->ln(5);
$pdf->Cell(55, 5, "$result[9]", 0, 0, 'L');
$pdf->ln(10);
$pdf->Cell(50, 5, "Atividades:", 0, 0, 'L');
$pdf->ln(5);
$pdf->Cell(50, 5, "$result[10]", 0, 0, 'L');

$pdf->Output();

?>