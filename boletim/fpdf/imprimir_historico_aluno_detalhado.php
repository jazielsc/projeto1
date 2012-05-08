<?php
require_once($_SERVER['DOCUMENT_ROOT']."/boletim/fpdf/fpdf.php");
$pdf = new FPDF();

$pdf->SetMargins(10, 10, 10);
$pdf->Open();
$pdf->AddPage();



require_once("../scripts/conecta.php");
/*$conn = mysql_connect("mysql01.boletimflex.com","boletimflex","rootflex123");
mysql_select_db("boletimflex") or die ("ERRO seleciona banco!");*/


$cod_aluno = $_POST['cod_aluno'];
$semestre = $_POST['semestre'];


$str[0] = utf8_decode("Matrícula");
$str[1] = utf8_decode("C. Horária");
$str[2] = utf8_decode("Média");
$str[3] = utf8_decode("HISTÓRICO ESCOLAR");
$str[4] = utf8_decode("Média do Curso");
$str[5] = utf8_decode("Total de Carga Horária");


$query_select = mysql_query("SELECT aluno.nome, instituicao.nome, matricula, curso.nome, aluno.identidade, date_format(aluno.datanasc,'%d/%m/%Y') AS data FROM aluno, cidade, bairro, rua, uf, status, instituicao, curso WHERE aluno.cod_curso = curso.cod_curso AND curso.cod_instituicao = instituicao.cod_instituicao AND aluno.cod_cidade = cidade.cidade_id AND aluno.cod_bairro = bairro.bairro_id AND aluno.cod_rua = rua_id AND aluno.cod_status = status.cod_status AND aluno.cod_uf = uf_id AND aluno.cod_instituicao = instituicao.cod_instituicao AND cod_aluno = '$cod_aluno'") or die (mysql_error(). "erro em select");

$result = mysql_fetch_array($query_select);



$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(0, 7, $result[1],0 , 'C');
$pdf->MultiCell(0, 7, $str[3],0 , 'C');
$pdf->ln(5);
$pdf->Cell(55, 5, "$str[0]: $result[2]", 0, 0, 'L');
$pdf->Cell(90, 5, "Nome: $result[0]", 0, 0, 'L');
$pdf->Cell(40, 5, "Nascimento: $result[5]", 0, 0, 'L');
$pdf->ln(5);
$pdf->Cell(55, 5, "Identidade: $result[4]", 0, 0, 'L');
$pdf->Cell(90, 5, "Curso: $result[3]", 0, 0, 'L');
$pdf->Cell(30, 5, "Unidade: $semestre", 0, 0, 'L');

$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 9);

	
	$pdf->Cell(70, 5, "Disciplina", 1, 0, 'L');
	
        $pdf->Cell(14, 5, "Nota 1", 1, 0, 'L');
        $pdf->Cell(14, 5, "Nota 2", 1, 0, 'L');
        $pdf->Cell(14, 5, "Nota 3", 1, 0, 'L');
        $pdf->Cell(14, 5, "Nota 4", 1, 0, 'L');
        $pdf->Cell(14, 5, "Nota 5", 1, 0, 'L');
        $pdf->Cell(14, 5, "Nota 6", 1, 0, 'L');
		$pdf->Cell(14, 5, "$str[2]", 1, 0, 'L');
		$pdf->Cell(11, 5, "Faltas", 1, 0, 'L');
		$pdf->Cell(8, 5, "", 1, 0, 'L');
	$pdf->Ln();
	
$cod_instituicao = $_POST['cod_instituicao'];	
$query_tipo = mysql_query("SELECT cod_tipo, media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die("Erro consulta config!");

$resultado_tipo = mysql_fetch_array($query_tipo);

if($resultado_tipo[0] == 1)
$tipo = "semestre";
else
$tipo = "unidade";

$query_final = mysql_query("SELECT COUNT(cod_boletim), SUM(media) as media, SUM(carga_horaria) as carga_horaria FROM disciplina, boletim, turma WHERE disciplina.cod_turma = turma.cod_turma AND boletim.cod_turma = turma.cod_turma AND disciplina.cod_disciplina = boletim.cod_disciplina AND boletim.cod_curso = disciplina.cod_curso AND boletim.cod_turma = disciplina.cod_turma AND boletim.cod_aluno = '$cod_aluno' AND turma.cod_curso = boletim.cod_curso AND turma.cod_curso = disciplina.cod_curso AND $tipo = '$semestre'",$conn) or die ("Error na consulta1 ". mysql_error());



		           

$result3 = mysql_fetch_array($query_final);
// se retornou então envia a mensagem

if ($result3[0] > 0){

$media_final = number_format(($result3[1] / $result3[0]), 2, '.', '');

$query_notas = mysql_query("SELECT cod_boletim, carga_horaria, disciplina.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06,  media, faltas, IF(media >= '$resultado_tipo[0]', 'Ap','Rp') FROM disciplina, boletim, turma WHERE  disciplina.cod_turma = turma.cod_turma AND boletim.cod_turma = turma.cod_turma AND disciplina.cod_disciplina = boletim.cod_disciplina AND boletim.cod_curso = disciplina.cod_curso AND boletim.cod_turma = disciplina.cod_turma AND boletim.cod_aluno = '$cod_aluno' AND  turma.cod_curso = boletim.cod_curso AND turma.cod_curso = disciplina.cod_curso AND $tipo = '$semestre'",$conn) or die ("Error na consulta2 ". mysql_error());


while ($result2 = mysql_fetch_array($query_notas)){ // retornando os valores da consulta em array e enviando para o flash

$pdf->Cell(70, 5, "$result2[2]", 1, 0, 'L');

$pdf->Cell(14, 5, "$result2[3]", 1, 0, 'L');
$pdf->Cell(14, 5, "$result2[4]", 1, 0, 'L');
$pdf->Cell(14, 5, "$result2[5]", 1, 0, 'L');
$pdf->Cell(14, 5, "$result2[6]", 1, 0, 'L');
$pdf->Cell(14, 5, "$result2[7]", 1, 0, 'L');
$pdf->Cell(14, 5, "$result2[8]", 1, 0, 'L');
$pdf->Cell(14, 5, "$result2[9]", 1, 0, 'L');
$pdf->Cell(11, 5, "$result2[10]", 1, 0, 'L');
$pdf->Cell(8, 5, "$result2[11]", 1, 0, 'L');

$pdf->ln(5);

}

$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(55, 5, "$str[4]: $media_final", 0, 0, 'L');

} else{

$pdf->Cell(55, 5, "Sem Resultado!", 0, 0, 'L');

}

$pdf->Output();

?>