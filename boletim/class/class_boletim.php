<?php

	header("Content-Type:text/html; charset=ISO-8859-1",true);
	class Class_boletim{
		public $cod_boletim;
		public $nota_1;
		public $nota_2;
		public $nota_3;
		public $nota_4;
		public $nota_5;
		public $nota_6;
		public $media;
		public $faltas;
		public $cod_curso;
		public $cod_turma;
		public $cod_disciplina;
		public $cod_professor;	
		public $cod_aluno;
		public $unidade;
     
		public function insert_notas($nota_1,$nota_2,$nota_3,$nota_4,$nota_5,$nota_6,$numero_avaliacoes,$faltas,$cod_aluno,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$unidade,$select=1){
			$media = 0;
			$media = ($nota_1 + $nota_2 + $nota_3 + $nota_4 + $nota_5 + $nota_6) / $numero_avaliacoes;
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			session_start();
			$cod_instituicao = (int) $_SESSION['id_instituicao'];
			//$query = mysql_query("SELECT media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
			//$resultado = mysql_fetch_array($query);
			$query_select = mysql_query("SELECT cod_boletim FROM boletim WHERE cod_aluno = '$cod_aluno' AND cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND unidade = '$unidade'") or die ("Erro select ". mysql_error());
			// verificando se a query retornou algum valor
			$quant = mysql_num_rows($query_select);
			// se retornou então envia a mensagem
            if ($quant > 0){
				$this->resultado = "NAO"; 
            }
			else {
				$query_insert = mysql_query("INSERT INTO boletim VALUE (NULL, '$nota_1', '$nota_2', '$nota_3', '$nota_4', '$nota_5', '$nota_6', '$numero_avaliacoes', '$faltas', '$media', '$cod_curso', '$cod_turma', '$cod_disciplina', '$cod_professor', '$cod_aluno','$unidade')") or die ("Erro insert1 ". mysql_erro());              
                     if($select == 1){
						$query_grid = mysql_query("SELECT cod_boletim, aluno.2_nome_completo, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' ORDER BY aluno.2_nome_completo",$conn) or die ("Error na consulta1");
						$i = 0;
						while ($result = mysql_fetch_array($query_grid)) { // retornando os valores da consulta em array e enviando para o flash
							echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";                                                  
                            $i++;
                        }

					}
					else {
						$query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND boletim.cod_aluno = '$cod_aluno' ORDER BY aluno.nome",$conn) or die (mysql_error(). " Error na consulta1");
						$i = 0;
						while ($result = mysql_fetch_array($query_grid)){ // retornando os valores da consulta em array e enviando para o flash
                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";
                            $i++;
                        }
					}                   
					$this->resultado = "ok";
                }
		}


		public function update_notas($nota_1,$nota_2,$nota_3,$nota_4,$nota_5,$nota_6,$numero_avaliacoes,$faltas,$cod_aluno,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$codigo,$unidade,$select){
			$media = 0;
			$media = ($nota_1 + $nota_2 + $nota_3 + $nota_4 + $nota_5 + $nota_6) / $numero_avaliacoes;
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			session_start();
			$cod_instituicao = (int) $_SESSION['id_instituicao'];
			$query = mysql_query("SELECT media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
			$resultado = mysql_fetch_array($query);
			echo "&media_curso=$resultado[0]";
			$query_select = mysql_query("SELECT cod_boletim FROM boletim WHERE cod_aluno = '$cod_aluno' AND cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina'") or die ("Erro select ". mysql_error());
			// verificando se a query retornou algum valor
			$quant = mysql_num_rows($query_select);
			// se retornou então envia a mensagem
			if ($quant > 0){
				$query_update = mysql_query("UPDATE boletim SET nota_01 = '$nota_1', nota_02 = '$nota_2', nota_03 = '$nota_3', nota_04 = '$nota_4', nota_05 = '$nota_5', nota_06 = '$nota_6', n_avaliacoes  = '$numero_avaliacoes', faltas = '$faltas', media = '$media', unidade = '$unidade' WHERE cod_boletim = '$codigo'") or die ("Erro insert1 ". mysql_erro());
				if($select == 1){
					$query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' ORDER BY aluno.nome",$conn) or die ("Error na consulta1");
					$i = 0;
					while ($result = mysql_fetch_array($query_grid)){ 
						echo "&codigo$i=$result[0]";
						echo "&nome$i=$result[1]";
						echo "&nota_01$i=$result[2]";
						echo "&nota_02$i=$result[3]";
						echo "&nota_03$i=$result[4]";
						echo "&nota_04$i=$result[5]";
						echo "&nota_05$i=$result[6]";
						echo "&nota_06$i=$result[7]";
						echo "&media$i=$result[8]";
						echo "&faltas$i=$result[9]";
						echo "&unidade$i=$result[10]";
						$i++;
					}
				}
				else{
					$query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND boletim.cod_aluno = '$cod_aluno' ORDER BY aluno.nome",$conn) or die (mysql_error(). " Error na consulta1");
					$i = 0;
					while ($result = mysql_fetch_array($query_grid)){
						echo "&codigo$i=$result[0]";
						echo "&nome$i=$result[1]";
						echo "&nota_01$i=$result[2]";
						echo "&nota_02$i=$result[3]";
						echo "&nota_03$i=$result[4]";
						echo "&nota_04$i=$result[5]";
						echo "&nota_05$i=$result[6]";
						echo "&nota_06$i=$result[7]";
						echo "&media$i=$result[8]";
						echo "&faltas$i=$result[9]";
						echo "&unidade$i=$result[10]";
						$i++;
					}
				}
				$this->resultado = "ok";
			}
		}
		
		public function update_disciplina($nome,$cod_professor,$cod_curso,$cod_turma,$codigo){      
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");        
			$query_insert = mysql_query("UPDATE disciplina SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma' WHERE cod_disciplina = '$codigo'") or die ("Erro update". mysql_errno());
			$query_grid = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.nome, turma.nome FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");
			$i = 0;
			while ($result = mysql_fetch_array($query_grid)){
				echo "&codigo$i=$result[0]";
				echo "&curso$i=$result[1]";
				echo "&disciplina$i=$result[2]";
				echo "&professor$i=$result[3]";
				echo "&turma$i=$result[4]";
				$i++;
			}
			$this->resultado = "ok";      
		}

		public function delete_notas($codigo,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$select){        
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			session_start();
			$cod_instituicao = (int) $_SESSION['id_instituicao'];
			$query = mysql_query("SELECT media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
			$resultado = mysql_fetch_array($query);
			echo "&media_curso=$resultado[0]";        
			$query_delete = mysql_query("DELETE FROM boletim WHERE cod_boletim = '$codigo'");
			$query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' ORDER BY aluno.nome",$conn) or die ("Error na consulta1");
			// zerando contadores
			$i = 0;
			if ($select == 1){
				while ($result = mysql_fetch_array($query_grid)){ // retornando os valores da consulta em array e enviando para o flash
					echo "&codigo$i=$result[0]";
					echo "&nome$i=$result[1]";
					echo "&nota_01$i=$result[2]";
					echo "&nota_02$i=$result[3]";
					echo "&nota_03$i=$result[4]";
					echo "&nota_04$i=$result[5]";
					echo "&nota_05$i=$result[6]";
					echo "&nota_06$i=$result[7]";
					echo "&media$i=$result[8]";
					echo "&faltas$i=$result[9]";
					echo "&unidade$i=$result[10]";
					$i++;
				}
			}
			else {
				$query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND boletim.cod_aluno = '$cod_aluno' ORDER BY aluno.nome",$conn) or die (mysql_error(). " Error na consulta1");
			   // zerando contadores
				$i = 0;
				while ($result = mysql_fetch_array($query_grid)){ // retornando os valores da consulta em array e enviando para o flash
					echo "&codigo$i=$result[0]";
					echo "&nome$i=$result[1]";
					echo "&nota_01$i=$result[2]";
					echo "&nota_02$i=$result[3]";
					echo "&nota_03$i=$result[4]";
					echo "&nota_04$i=$result[5]";
					echo "&nota_05$i=$result[6]";
					echo "&nota_06$i=$result[7]";
					echo "&media$i=$result[8]";
					echo "&faltas$i=$result[9]";
					echo "&unidade$i=$result[10]";
					$i++;
				}
			}
			$this->resultado = "ok";
		}

		public function ranking($cod_curso,$cod_turma) {
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			if ($cod_turma != ""){
				$where = "AND boletim.cod_turma = '$cod_turma'";
			}
			else {
				$where = "";
			}
			$query_grid = mysql_query("SELECT aluno.nome, curso.nome, turma.nome, disciplina.nome, TRUNCATE( AVG( media ) , 2) AS media_geral, max(media) AS nota
										FROM aluno, curso, turma, disciplina, boletim
										WHERE aluno.cod_status = 1 AND boletim.cod_aluno = aluno.cod_aluno
										AND boletim.cod_curso = curso.cod_curso
										AND turma.cod_turma = boletim.cod_turma
										AND boletim.cod_disciplina = disciplina.cod_disciplina
										AND boletim.cod_professor = disciplina.cod_professor
										AND boletim.cod_curso = '$cod_curso' $where GROUP BY aluno.nome
										ORDER BY media_geral DESC, nota DESC, aluno.nome",$conn) or die ("Error na consulta1" . mysql_error());
			// zerando contadores
			$i = 0;
			$colocacao = 1;
			while ($result = mysql_fetch_array($query_grid)){
				echo "&colocacao$i=$colocacao";
				echo "&aluno$i=$result[0]";
				echo "&curso$i=$result[1]";
				echo "&turma$i=$result[2]";
				echo "&disciplina$i=$result[3]";
				echo "&media$i=$result[4]";
				echo "&nota$i=$result[5]";
				$i++;
				$colocacao ++;
			}
			$this->resultado = "ok";
		}

		public function ranking_media($cod_curso,$cod_turma) {
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			if ($cod_turma != ""){
				$where = "AND boletim.cod_turma = '$cod_turma'";
			}
			else{
				$where = "";
			}
			$query_grid = mysql_query("SELECT aluno.nome, curso.nome, turma.nome, disciplina.nome, media FROM aluno, curso, turma, disciplina, boletim WHERE boletim.cod_aluno = aluno.cod_aluno AND boletim.cod_curso = curso.cod_curso AND turma.cod_turma = boletim.cod_turma AND boletim.cod_disciplina = disciplina.cod_disciplina and boletim.cod_professor = disciplina.cod_professor AND boletim.cod_curso = '$cod_curso' $where ORDER BY media DESC",$conn) or die ("Error na consulta1" . mysql_error());
			$i = 0;
			$colocacao = 1;
			while ($result = mysql_fetch_array($query_grid)){
				echo "&colocacao$i=$colocacao";
				echo "&aluno$i=$result[0]";
				echo "&curso$i=$result[1]";
				echo "&turma$i=$result[2]";
				echo "&disciplina$i=$result[3]";
				echo "&media$i=$result[4]";
				$i++;
				$colocacao ++;
			}
			$this->resultado = "ok";
		}
	}

?>
