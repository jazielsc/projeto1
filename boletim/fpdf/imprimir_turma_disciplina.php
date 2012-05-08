<?
require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


$cod_turma = $_GET['cod_turma'];


$query_notas = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.2_, turma.1_ FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma AND turma.cod_turma = '$cod_turma' ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");

?>

<div style="width: 210mm;">
	<table style="width: 210mm; border: 1px solid black; border-collapse: collapse;">
		<tr>
			<th style="border: 1px solid black; border-collapse: collapse; padding-left: 5mm; padding-right: 5mm;">Codigo</th>
			<th style="border: 1px solid black; border-collapse: collapse; padding-left: 5mm; padding-right: 5mm;">Curso</th>
			<th style="border: 1px solid black; border-collapse: collapse; padding-left: 5mm; padding-right: 5mm;">Disciplina</th>
			<th style="border: 1px solid black; border-collapse: collapse; padding-left: 5mm; padding-right: 5mm;">Professor</th>
			<th style="border: 1px solid black; border-collapse: collapse; padding-left: 5mm; padding-right: 5mm;">Turma</th>
		</tr>
<?
while ($result2 = mysql_fetch_array($query_notas)){ 
?>
<tr>
	<td style="border: 1px solid black; border-collapse: collapse; padding-left: 3mm; padding-right: 3mm; text-align: center;"><?echo $result2[0];?></td>
	<td style="border: 1px solid black; border-collapse: collapse; padding-left: 3mm; padding-right: 3mm;"><?echo $result2[1];?></td>
	<td style="border: 1px solid black; border-collapse: collapse; padding-left: 3mm; padding-right: 3mm;"><?echo $result2[2];?></td>
	<td style="border: 1px solid black; border-collapse: collapse; padding-left: 3mm; padding-right: 3mm;"><?echo $result2[3];?></td>
	<td style="border: 1px solid black; border-collapse: collapse; padding-left: 3mm; padding-right: 3mm;"><?echo $result2[4];?></td>
</tr>
<?
}
?>
</div>
<center>
	<a target="_self" href="javascript:window.print()"><img src="/img/print.png" WIDTH=20 HEIGHT=20/></a>
	<br>
</center>