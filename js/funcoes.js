// JavaScript Document
/*****FUNÇÕES JAVASCRIPT ***/


/*****FUNÇÃO AJAX****/
function ajaxGET(url, obj,aguarda,obj2){
var xmlhttp;
var txt,xx,x,i;
if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
  	xmlhttp=new XMLHttpRequest();
}else {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function(){
	if (xmlhttp.readyState==4 && xmlhttp.status==200){
	    x=xmlhttp.responseText;
    	document.getElementById(obj).innerHTML=x;
		if (aguarda==true){
			atualizaTabela2(obj2);
			//montaEventoAluno();
		}
    }
}
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function carregaTurma(idCurso, obj){
	$.post('loader/carrega_turma.php',
		   {id: idCurso},
		   function(retorno){
			   $('#'+obj).html(retorno);
		   		}
		   );
//	ajaxGET('loader/carrega_turma.php?id='+idCurso, obj);
}

function carregaDisciplina(idTurma, obj){
	$.post('loader/carrega_disciplina.php',
		   {id: idTurma},
		   function(retorno){
			   $('#'+obj).html(retorno);
		   		}
		   );
	//ajaxGET('loader/carrega_disciplina.php?id='+idTurma, obj);
}

function carregaDisciplina2(idCurso, obj){
	$.post('loader/carrega_disciplina2.php',
		   {id: idCurso},
		   function(retorno){
			   $('#'+obj).html(retorno);
		   		}
		   );
	//ajaxGET('loader/carrega_disciplina.php?id='+idTurma, obj);
}

function carregaProfessor(idDisciplina, obj){
		$.post('loader/carrega_professor.php',
		   {id: idDisciplina},
		   function(retorno){
			   $('#'+obj).html(retorno);
		   		}
		   );
//	ajaxGET('loader/carrega_professor.php?id='+idDisciplina, obj);
}

function carregaAluno(idCurso,idTurma, obj){
	$.post('loader/carrega_aluno.php',
		   {id: idCurso,
		   cod_turma: idTurma},
		   function(retorno){
			   $('#'+obj).html(retorno);
		   		}
		   );
	ajaxGET('loader/carrega_aluno.php?cod_curso='+idCurso+'&cod_turma='+idTurma, obj);
}

function atualizaTabela2(obj){
	obj.find('tbody > tr').hover(function(){
        $(this).toggleClass('hover');
     });
	
	//dinstiguir pares e impares
	obj.find('tbody > tr:odd').addClass('odd');
	
	//ordenar campos
	obj.tablesorter({
          dateFormat: 'uk'
        }) 
        //.tablesorterPager({container: $("#pager")})
        .bind('sortStart', function(){
          obj.find('tbody > tr').removeClass('odd')
          .find('tbody > tr:odd').addClass('odd');
		  
        }); 
}

function atualizaTabela(){
	$('table#box-table-a > tbody > tr').hover(function(){
        $(this).toggleClass('hover');
     });
	
	//dinstiguir pares e impares
	$('table#box-table-a > tbody > tr:odd').addClass('odd');
	
	//ordenar campos
	$("table#box-table-a").tablesorter({
          dateFormat: 'uk'
        }) 
        //.tablesorterPager({container: $("#pager")})
        .bind('sortStart', function(){
          $('table#box-table-a > tbody > tr').removeClass('odd');
          $('table#box-table-a > tbody > tr:odd').addClass('odd');
		  
        }); 
}

function montaEventoAluno(){
	//selecionar dados do aluno e atualiza o form boletim
		$("tr.linha_aluno").click(function(){ 
			$('#acao').attr('value','insert_notas');
			//tenho que pegar os codigos
		   	$('#cod_aluno').attr('value', $(this).find('td:eq(0)').text() );
 		   	$('#nome').attr('value', $(this).find('td:eq(1)').text() );
		   	$('#cod_curso').attr('value', $('#carrega_curso').val() );
		   	$('#cod_turma').attr('value', $('#carrega_turma').val() );
		   	$('#cod_disciplina').attr('value', $('#carrega_disciplina').val() );
		   	$('#cod_professor').attr('value', $('#carrega_professor').val() );
		   return false; 
		}); 
}


/***********************
PARTE CARREGAMENTO DAS TABELAS
************************/
function carregaTabelaTurmaAluno(idDisciplina, idProfessor, obj){
	ajaxGET('loader/carrega_tabela_turma_aluno.php?disciplina='+idDisciplina+'&professor='+idProfessor, obj,true,$('#box-table-a'));

}

function carregaGridBoletim(idCurso, idTurma, idDisciplina, idProfessor, obj){
	ajaxGET('loader/carrega_grid_notas.php?curso='+idCurso+'&turma='+idTurma+'&disciplina='+idDisciplina+'&professor='+idProfessor, obj,true, $('#box-table-a-boletim'));	
}

function carregaGridBoletimAluno(idCurso, idTurma, idDisciplina, idProfessor, idAluno, obj){
	ajaxGET('loader/carrega_grid_notas_aluno.php?curso='+idCurso+'&turma='+idTurma+'&disciplina='+idDisciplina+'&aluno='+idAluno+'&professor='+idProfessor, obj,true, $('#box-table-a-boletim'));	
}

function carregaGridDisciplinaProfessor(idCurso, idTurma, idAluno, obj){
	ajaxGET('loader/carrega_grid_disciplina_professor.php?cod_curso='+idCurso+'&cod_turma='+idTurma+'&cod_aluno='+idAluno, obj,true,$('#box-table-a') );	
}


function carregaGridDisciplina(idProfessor, obj){
	ajaxGET('loader/carrega_grid_disciplina.php?cod_professor='+idProfessor, obj,true,$('#box-table-a') );	
}

function carregaGridDisciplinaAno(idProfessor, ano, obj){
	ajaxGET('loader/carrega_grid_disciplina_ano.php?cod_professor='+idProfessor+'&ano='+ano, obj, true, $('#box-table-a') );	
}
 
function carregaGridHorario(idTurma, obj){
	ajaxGET('loader/carrega_grid_horario.php?turma='+idTurma, obj, true, $('#box-table-a') );	
}

function carregaGridDataProva(idTurma, obj){
	ajaxGET('loader/carrega_grid_data_prova.php?turma='+idTurma, obj, true, $('#box-table-a') );	
}

function carregaGridPlanoAula(idTurma, obj){
	ajaxGET('loader/carrega_grid_plano_aula.php?turma='+idTurma, obj, true, $('#box-table-a') );	
}


/**************************
PARTE DAS NOTAS - BOLETIM
*************************/
/*FUNÇÃO QUE PREPARA PARA INSERIR NOTAS PARA GRID ALUNOS*/
function prepara_insert_notas_alunos(obj){
	limpaCampos('#Form_boletim');
	$('#acao').attr('value','insert_notas');
	//tenho que pegar os codigos
	$('#cod_aluno').attr('value', $(obj).find('td:eq(0)').text() );
 	$('#nome').attr('value', $(obj).find('td:eq(1)').text() );
	$('#botao').attr('value', "Cadastrar Notas" );
	$('#cod_curso').attr('value', $('#carrega_curso').val() );
	$('#cod_turma').attr('value', $('#carrega_turma').val() );
	$('#cod_disciplina').attr('value', $('#carrega_disciplina').val() );
	$('#cod_professor').attr('value', $('#carrega_professor').val() );
}

/*FUNÇÃO QUE PREPARA PRA ALTERAR NOTAS NO BOLETIM*/
function prepara_update_notas(obj){
	limpaCampos('#Form_boletim');
	$('#acao').attr('value','update_notas');
	//tenho que pegar os codigos
	$('#cod_boletim').attr('value', $(obj).find('td:eq(0)').text() );
 	$('#nome').attr('value', $(obj).find('td:eq(1)').text() );
	$('#nota_1').attr('value', $(obj).find('td:eq(2)').text() );
 	$('#nota_2').attr('value', $(obj).find('td:eq(3)').text() );
	$('#nota_3').attr('value', $(obj).find('td:eq(4)').text() );
 	$('#nota_4').attr('value', $(obj).find('td:eq(5)').text() );
	$('#nota_5').attr('value', $(obj).find('td:eq(6)').text() );
 	$('#nota_6').attr('value', $(obj).find('td:eq(7)').text() );
	$('#media').attr('value', $(obj).find('td:eq(8)').text() );
 	$('#faltas').attr('value', $(obj).find('td:eq(9)').text() );
	$('#unidade').attr('value', $(obj).find('td:eq(10)').text() );
	$('#cod_aluno').attr('value', $(obj).find('td:eq(11)').text() );
	$('#botao').attr('value', "Altarar Notas" );
	//preciso carregar os outros dados
	$('#cod_curso').attr('value', $('#carrega_curso').val() );
	$('#cod_turma').attr('value', $('#carrega_turma').val() );
	$('#cod_disciplina').attr('value', $('#carrega_disciplina').val() );
	$('#cod_professor').attr('value', $('#carrega_professor').val() );
}


/*FUNÇÃO QUE PREPARA PARA INSERIR NOTAS PARA GRID DISCIPLINA PROFESSOR*/
function prepara_insert_notas_disciplina_professor(obj){
	limpaCampos('#Form_boletim');
	$('#acao').attr('value','insert_notas');
	//tenho que pegar os codigos
	$('#cod_aluno').attr('value', $('#carrega_aluno').val() );
 	$('#nome').attr('value', $('#carrega_aluno option:selected').text() );
	$('#botao').attr('value', "Cadastrar Notas" );
	$('#cod_curso').attr('value', $('#carrega_curso').val() );
	$('#cod_turma').attr('value', $('#carrega_turma').val() );
	$('#cod_disciplina').attr('value', $(obj).find('td:eq(0)').text() );
	$('#cod_professor').attr('value', $(obj).find('td:eq(2)').text() );
	carregaGridBoletimAluno($('#carrega_curso').val(),$('#carrega_turma').val(), $('#cod_disciplina').val(),$('#cod_professor').val(), $('#cod_aluno').val(), 'carrega_boletim');
}

/*FUNÇÃO QUE PREPARA PRA ALTERAR NOTAS NO BOLETIM*/
function prepara_update_notas_disciplina_professor(obj){
	limpaCampos('#Form_boletim');
	$('#acao').attr('value','update_notas');
	//tenho que pegar os codigos
	$('#cod_boletim').attr('value', $(obj).find('td:eq(0)').text() );
 	$('#nome').attr('value', $(obj).find('td:eq(1)').text() );
	$('#nota_1').attr('value', $(obj).find('td:eq(2)').text() );
 	$('#nota_2').attr('value', $(obj).find('td:eq(3)').text() );
	$('#nota_3').attr('value', $(obj).find('td:eq(4)').text() );
 	$('#nota_4').attr('value', $(obj).find('td:eq(5)').text() );
	$('#nota_5').attr('value', $(obj).find('td:eq(6)').text() );
 	$('#nota_6').attr('value', $(obj).find('td:eq(7)').text() );
	$('#media').attr('value', $(obj).find('td:eq(8)').text() );
 	$('#faltas').attr('value', $(obj).find('td:eq(9)').text() );
	$('#unidade').attr('value', $(obj).find('td:eq(10)').text() );
	$('#cod_aluno').attr('value', $(obj).find('td:eq(11)').text() );
	$('#botao').attr('value', "Altarar Notas" );
	//preciso carregar os outros dados
	$('#cod_curso').attr('value', $('#carrega_curso').val() );
	$('#cod_turma').attr('value', $('#carrega_turma').val() );
	/* não posso atualizar campos*/
	//$('#cod_disciplina').attr('value', $('#carrega_disciplina').val() );
	//$('#cod_professor').attr('value', $('#carrega_professor').val() );
}




function limpaCampos(form){
	$(form).find('input[type=text]').val('');
	/*não posso zerar campos hidden*/
	//$('#Form_boletim').find('input[type=hidden]').val('');
	$("div#retorno").html('');
	
}

/* FUNÇÃO RESPONSAVEL POR DELETAR NOTAS*/
function deleteNotas(){
	if($('#cod_boletim').val()==""){
		$("div#retorno").html('Selecione as notas a serem deletadas.');
		return false;
	}
		
	$.post(
		$("form#Form_boletim").attr('action'),{
		acao:'delete_notas',
cod_professor:$('#carrega_professor').val(),
cod_disciplina:$('#carrega_disciplina').val(),
cod_turma:$('#carrega_turma').val(),
cod_curso:$('#carrega_curso').val(),
codigo:$('#cod_boletim').val() }
		,
		function(retorno){
			if(retorno.indexOf('ok')!=-1){
				$('div#retorno').html('Notas Deletadaas com sucesso.');
				carregaGridBoletim($('#carrega_curso').val(),$('#carrega_turma').val(), $('#carrega_disciplina').val(), $('#carrega_professor').val(), 'carrega_boletim');
				limpaCampos('#Form_boletim');
			}else{
 				$("div#retorno").html( retorno);
				$("div#retorno").show();
			}
		}
	);
}


/*FUNÇÃO QUE CADASTRA NOTA DE ALUNOS*/
function cadastraNotas(){
	$.post(
			$("form#Form_boletim").attr('action'),
			$("form#Form_boletim").serialize(),
			function(retorno){
				if(retorno.indexOf('ok')!=-1){
					$('div#retorno').html('Notas Cadastradas com sucesso.');
					carregaGridBoletim($('#carrega_curso').val(),$('#carrega_turma').val(), $('#carrega_disciplina').val(), $('#carrega_professor').val(), 'carrega_boletim');
					limpaCampos('#Form_boletim');
				}else{
					$('div#retorno').html('Notas já cadastradas.');
				}
			});
}

/*FUNÇÃO QUE CADASTRA DISCIPLINA LANCA PROFESSOR DISCIPLINA*/
function cadastraDisciplina(){
	$.post(
			$("form#Form_disciplina").attr('action'),
			$("form#Form_disciplina").serialize(),
			function(retorno){
				if(retorno.indexOf('ok')!=-1){
					$('div#retorno').html('Disciplina Cadastrada com sucesso.');
					carregaGridDisciplina($('#cod_professor').val(), 'carrega_disciplina_professor');
					limpaCampos('#Form_disciplina');
				}else{
					$("div#retorno").html( retorno );
					$("div#retorno").show();
				}
			});
	return false;
}

/*******************************
PARTE DOS HORARIOS
*******************************/

/*FUNÇÃO QUE PREPARA PARA INSERIR NOTAS PARA GRID ALUNOS*/
function prepara_insert_horario(){
	limpaCampos('#Form_Horario');
	$('#acao').attr('value','insert_horario');
	atualizaDia();
	//tenho que pegar os codigos
	$('#botao').attr('value','Cadastrar');
}

/*FUNÇÃO QUE PREPARA PARA INSERIR NOTAS PARA GRID ALUNOS*/
function prepara_update_horario(obj){
	limpaCampos('#Form_Horario');
	$('#acao').attr('value','update_horario');
	//tenho que pegar os codigos
	$('#cod_horario').attr('value', $(obj).find('td:eq(0)').text() );
	$('#codigo').attr('value', $(obj).find('td:eq(0)').text() );
	//tenho que seleionar a parada
	$('#dia_numero').find('option:selected').attr('selected','');
 	$('#dia').attr('value', $(obj).find('td:eq(1)').text() );
	atualizaDia();
	$('#botao').attr('value', "Altarar" );
}


/*FUNÇÃO QUE CADASTRA DISCIPLINA LANCA PROFESSOR DISCIPLINA*/
function cadastraHorario(){
	$.post(
			$("form#Form_Horario").attr('action'),
			$("form#Form_Horario").serialize(),
			function(retorno){
				if(retorno.indexOf('ok')!=-1){
					$('div#retorno').html('Horario Cadastrado com sucesso.');
					carregaGridHorario($('#carrega_turma').val(), 'carrega_horario');
					limpaCampos('#Form_Horario');
				}else{
					$("div#retorno").html( retorno );
					$("div#retorno").show();
				}
			});
	return false;
}

/*FUNÇÃO RESPONSAVEL POR DELETAR HORARIO*/
function deleteHorario(){
	if($('#cod_horario').val()==""){
		$("div#retorno").html('Selecione o horario a ser deletado.');
		return false;
	}
		
	$.post(
		$("form#Form_Horario").attr('action'),{
		acao:'delete_horario',
		cod_turma:$('#carrega_turma').val(),
		codigo:$('#codigo').val() }
		,
		function(retorno){
			if(retorno.indexOf('ok')!=-1){
				$('div#retorno').html('Horario Deletado com sucesso.');
									carregaGridHorario($('#carrega_turma').val(), 'carrega_horario');
				prepara_insert_horario();
				atualizaDia();
			}else{
 				$("div#retorno").html( retorno);
				$("div#retorno").show();
			}
		}
	);
}

function atualizaDia(){
	$('#dia').val($('#dia_numero').find('option:selected').text());
}


/*****************************
PARTE DE DATA PROVA 
*****************************/

/*FUNÇÃO QUE PREPARA PARA INSERIR NOTAS PARA GRID ALUNOS*/
function prepara_insert_data_prova(){
	limpaCampos('#Form_data_prova');
	$('#acao').attr('value','insert_calendario');
	atualizaDia();
	//tenho que pegar os codigos
	$('#botao').attr('value','Cadastrar');
}

/*FUNÇÃO QUE PREPARA PARA INSERIR NOTAS PARA GRID ALUNOS*/
function prepara_update_data_prova(obj){
	limpaCampos('#Form_data_prova');
	$('#acao').attr('value','update_calendario');
	//tenho que pegar os codigos
	$('#cod_horario').attr('value', $(obj).find('td:eq(0)').text() );
	$('#codigo').attr('value', $(obj).find('td:eq(0)').text() );
	//tenho que seleionar a parada
	$('#dia_numero').find('option:selected').attr('selected','');
 	$('#dia').attr('value', $(obj).find('td:eq(1)').text() );
	atualizaDia();
	$('#botao').attr('value', "Altarar" );
}


/*FUNÇÃO QUE CADASTRA DISCIPLINA LANCA PROFESSOR DISCIPLINA*/
function cadastraDataProva(){
	$.post(
			$("form#Form_data_prova").attr('action'),
			$("form#Form_data_prova").serialize(),
			function(retorno){
				if(retorno.indexOf('ok')!=-1){
					$('div#retorno').html('Data Cadastrada com sucesso.');
					carregaGridDataProva($('#carrega_turma').val(), 'carrega_data_prova');
					limpaCampos('#Form_data_prova');
				}else{
					$("div#retorno").html( retorno );
					$("div#retorno").show();
				}
			});
	return false;
}

/*FUNÇÃO RESPONSAVEL POR DELETAR HORARIO*/
function deleteDataProva(){
	if($('#cod_calendario').val()==""){
		$("div#retorno").html('Selecione a prova a ser deletado.');
		return false;
	}
		
	$.post(
		$("#Form_data_prova").attr('action'),{
		acao:'delete_calendario',
		cod_turma:$('#carrega_turma').val(),
		codigo:$('#codigo').val() }
		,
		function(retorno){
			if(retorno.indexOf('ok')!=-1){
				$('div#retorno').html('Data Deletada com sucesso.');
									carregaGridDataProva($('#carrega_turma').val(), 'carrega_data_prova');
				prepara_insert_data_prova();
				atualizaDia();
			}else{
 				$("div#retorno").html( retorno);
				$("div#retorno").show();
			}
		}
	);
}



/*****************************
PARTE DE PLANO DE AULA
*****************************/

/*FUNÇÃO QUE PREPARA PARA INSERIR NOTAS PARA GRID ALUNOS*/
function prepara_insert_plano_aula(){
	limpaCampos('#Form_data_prova');
	$('#acao').attr('value','insert_calendario');
	atualizaDia();
	//tenho que pegar os codigos
	$('#botao').attr('value','Cadastrar');
}

/*FUNÇÃO QUE PREPARA PARA INSERIR NOTAS PARA GRID ALUNOS*/
function prepara_update_plano_aula(obj){
	limpaCampos('#Form_data_prova');
	$('#acao').attr('value','update_calendario');
	//tenho que pegar os codigos
	$('#cod_horario').attr('value', $(obj).find('td:eq(0)').text() );
	$('#codigo').attr('value', $(obj).find('td:eq(0)').text() );
	//tenho que seleionar a parada
	$('#dia_numero').find('option:selected').attr('selected','');
 	$('#dia').attr('value', $(obj).find('td:eq(1)').text() );
	atualizaDia();
	$('#botao').attr('value', "Altarar" );
}


/*FUNÇÃO QUE CADASTRA DISCIPLINA LANCA PROFESSOR DISCIPLINA*/
function cadastraPlanoAula(){
	$.post(
			$("form#Form_plano_aula").attr('action'),
			$("form#Form_plano_aula").serialize(),
			function(retorno){
				if(retorno.indexOf('ok')!=-1){
					$('div#retorno').html('Plano Aula Cadastrado com sucesso.');
					carregaGridDataProva($('#carrega_turma').val(), 'carrega_plano_aula');
					limpaCampos('#Form_plano_aula');
				}else{
					$("div#retorno").html( retorno );
					$("div#retorno").show();
				}
			});
	return false;
}

/*FUNÇÃO RESPONSAVEL POR DELETAR HORARIO
*/
function deletePlanoAula(){
	if($('#cod_plano_aula').val()==""){
		$("div#retorno").html('Selecione a prova a ser deletado.');
		return false;
	}
		
	$.post(
		$("#Form_plano_aula").attr('action'),{
		acao:'delete_calendario',
		cod_turma:$('#carrega_turma').val(),
		codigo:$('#codigo').val() }
		,
		function(retorno){
			if(retorno.indexOf('ok')!=-1){
				$('div#retorno').html('Data Deletada com sucesso.');
									carregaGridPlanoAula($('#carrega_turma').val(), 'carrega_plano_aula');
				prepara_insert_plano_aula();
				atualizaDia();
			}else{
 				$("div#retorno").html( retorno);
				$("div#retorno").show();
			}
		}
	);
}



