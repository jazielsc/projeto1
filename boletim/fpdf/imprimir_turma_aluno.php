<?
require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


$cod_turma = $_GET['cod_turma'];

$query_notas = mysql_query("SELECT DISTINCT matricula, aluno.2_nome_completo, curso.nome FROM aluno, disciplina, item2, curso WHERE disciplina.cod_turma = '$cod_turma' AND disciplina.cod_disciplina = item2.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND curso.cod_curso = aluno.cod_curso AND aluno.cod_status = 1 ORDER BY aluno.2_nome_completo",$conn) or die ("Error na consulta1");

?>

<div style="width: 210mm;">
	<table style="width: 210mm; border: 1px solid black; border-collapse: collapse;">
		<tr>
			<th style="border: 1px solid black; border-collapse: collapse; padding-left: 5mm; padding-right: 5mm;">Matricula</th>
			<th style="border: 1px solid black; border-collapse: collapse; padding-left: 5mm; padding-right: 5mm;">Nome do Aluno</th>
			<th style="border: 1px solid black; border-collapse: collapse; padding-left: 5mm; padding-right: 5mm;">Curso</th>
		</tr>
<?
while ($result2 = mysql_fetch_array($query_notas)){ 
?>
<tr>
	<td style="border: 1px solid black; border-collapse: collapse; padding-left: 3mm; padding-right: 3mm; text-align: center;"><?echo $result2[0];?></td>
	<td style="border: 1px solid black; border-collapse: collapse; padding-left: 3mm; padding-right: 3mm;"><?echo $result2[1];?></td>
	<td style="border: 1px solid black; border-collapse: collapse; padding-left: 3mm; padding-right: 3mm;"><?echo $result2[2];?></td>
</tr>
<?
}
?>
</div>
<center>
	<a target="_self" href="javascript:window.print()"><img src="/img/print.png" WIDTH=20 HEIGHT=20/></a>
	<br>
</center>