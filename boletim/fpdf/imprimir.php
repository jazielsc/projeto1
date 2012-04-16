<?php
require_once($_SERVER['DOCUMENT_ROOT']."/boletim/fpdf/fpdf.php");
$pdf = new FPDF();

$pdf->SetMargins(10, 10, 10);
$pdf->Open();
$pdf->AddPage();




$conn = mysql_connect("127.0.0.1","root","leo127863");
mysql_select_db("sigav") or die ("ERRO seleciona banco!");

$cod_avaliacao = $_POST['cod_avaliacao'];
$tipos_prova = $_POST['tipos_prova'];

$str[0] = utf8_decode("Nota Mínima");

$avaliacao = mysql_query("SELECT avaliacao.cod_avaliacao, avaliacao.nome, curso.nome, turma.nome, disciplina.nome, professor.nome, valor, minima FROM avaliacao, curso, turma, disciplina, professor WHERE  curso.cod_curso AND avaliacao.cod_curso AND turma.cod_turma = avaliacao.cod_turma AND disciplina.cod_disciplina = avaliacao.cod_disciplina AND avaliacao.cod_professor = professor.cod_professor AND avaliacao.cod_avaliacao = $cod_avaliacao");
$result = mysql_fetch_array($avaliacao);

if ($tipos_prova == 1){

$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(0, 7, $result[1],0 , 'C');
$pdf->ln(5);
$pdf->Cell(70, 5, "Curso: $result[2]", 0, 0, 'L');
$pdf->Cell(50, 5, "Turma: $result[3]", 0, 0, 'L');
$pdf->Cell(45, 5, "Disciplina: $result[4]", 0, 0, 'L');
$pdf->ln(5);
$pdf->Cell(70, 5, "Professor: $result[5]", 0, 0, 'L');
$pdf->Cell(50, 5, "Valor da Prova: $result[6]", 0, 0, 'L');
$pdf->Cell(30, 5, "$str[0] $result[7]", 0, 0, 'L');
$pdf->ln(10);



$query_questao = mysql_query("SELECT numero, peso, pergunta, tipo FROM questao WHERE cod_avaliacao = '$cod_avaliacao' ORDER BY numero",$conn) or die ("Error na consulta" .mysql_error());

while ($result2 = mysql_fetch_array($query_questao)){ // retornando os valores da consulta em array e enviando para o flash

$pdf->MultiCell(200, 5, "$result2[0]. $result2[2]", 0, 20, 'L');
$pdf->ln(5);

$query_resposta = mysql_query("SELECT cod_resposta, alternativa, resposta, comentario FROM resposta WHERE numero = '$result2[0]' AND cod_questao = '$cod_avaliacao' ORDER BY numero, alternativa",$conn) or die ("Error na consulta1");
while ($result3 = mysql_fetch_array($query_resposta)) {


$pdf->Cell(30, 5, "$result3[1]. $result3[2]", 0, 0, 'L');
$pdf->ln(5);
}

$pdf->ln(5);

}
} else {
    
$contador = 1;
while ($contador <= $tipos_prova){

$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(0, 7, $result[1],0 , 'C');
$pdf->ln(5);
$pdf->Cell(70, 5, "Curso: $result[2]", 0, 0, 'L');
$pdf->Cell(50, 5, "Turma: $result[3]", 0, 0, 'L');
$pdf->Cell(45, 5, "Disciplina: $result[4]", 0, 0, 'L');
$pdf->ln(5);
$pdf->Cell(70, 5, "Professor: $result[5]", 0, 0, 'L');
$pdf->Cell(50, 5, "Valor da Prova: $result[6]", 0, 0, 'L');
$pdf->Cell(30, 5, "$str[0] $result[7]", 0, 0, 'L');
$pdf->ln(10);



$query_questao = mysql_query("SELECT numero, peso, pergunta, tipo FROM questao WHERE cod_avaliacao = '$cod_avaliacao' ORDER BY  rand()",$conn) or die ("Error na consulta" .mysql_error());

$i=1;
while ($result2 = mysql_fetch_array($query_questao)){ // retornando os valores da consulta em array e enviando para o flash

$pdf->MultiCell(200, 5, "$i. $result2[2]", 0, 20, 'L');

$i++;

$pdf->ln(5);

$query_resposta = mysql_query("SELECT cod_resposta, alternativa, resposta, comentario FROM resposta WHERE numero = '$result2[0]' AND cod_questao = '$cod_avaliacao' ORDER BY numero, alternativa",$conn) or die ("Error na consulta1");
while ($result3 = mysql_fetch_array($query_resposta)) {


$pdf->Cell(30, 5, "$result3[1]. $result3[2]", 0, 0, 'L');
$pdf->ln(5);
}

$pdf->ln(5);

}

$contador++;
if ($contador <= $tipos_prova)
    $pdf->AddPage();
}

}
$pdf->Output();

?>