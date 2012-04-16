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
$opcao = $_POST['opcao'];


if ($opcao == 1){
$nomeOpcao = "Aluno";
$tabela = "aluno ";
$order_by = "nome";
$where = '1 AND cod_aluno = cod_aluno_professor';
} else if ($opcao == 2){

$nomeOpcao = "Professor";
$tabela = "professor ";
$order_by = "nome";
$where = '2 AND cod_professor = cod_aluno_professor';

} else if ($opcao == 3){

$nomeOpcao = "Funcionario";
$tabela = "funcionario ";
$order_by = "nome";
$where = "3 AND cod_funcionario = cod_aluno_professor";


} else {

$nomeOpcao = "Responsavel";
$tabela = "aluno ";
$order_by = "nome";
$where = '4 AND cod_aluno = cod_aluno_professor';
}


$str[2] = utf8_decode("Média");
$str[3] = utf8_decode("LISTA DE USUÁRIOS");
$str[0] = utf8_decode("Num.");




$query_select = mysql_query("SELECT instituicao.nome
FROM instituicao
WHERE instituicao.cod_instituicao = '$cod_instituicao'") or die (mysql_error(). "erro em select");

$result = mysql_fetch_array($query_select);


$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(0, 7, $result[0],0 , 'C');
$pdf->MultiCell(0, 7, $str[3],0 , 'C');
$pdf->ln(5);



$pdf->ln(10);

$pdf->SetFont('Arial', 'B', 8);
	
	$pdf->Cell(10, 5, "$str[0]", 1, 0, 'L');
	$pdf->Cell(85, 5, "$nomeOpcao", 1, 0, 'L');
	$pdf->Cell(75, 5, "Login", 1, 0, 'L');
        $pdf->Cell(25, 5, "Identidade", 1, 0, 'L');
        
        $pdf->Ln();


$query_notas = mysql_query("SELECT DISTINCT usuario.nome, usuario_login, identidade FROM usuario, $tabela
 WHERE usuario.cod_instituicao = '$cod_instituicao' AND
 referencia = $where ORDER BY usuario.nome",$conn) or die ("Error na consulta1");


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