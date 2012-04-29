// JavaScript Document
/*****FUNÇÕES JAVASCRIPT ***/


/*****FUNÇÃO AJAX****/
function ajaxGET(url, obj,aguarda){
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
			atualizaTabela();
			montaNotas();
		}
    }
}
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function carregaTurma(idCurso, obj){
	ajaxGET('loader/carrega_turma.php?id='+idCurso, obj);
}

function carregaDisciplina(idTurma, obj){
	ajaxGET('loader/carrega_disciplina.php?id='+idTurma, obj);
}

function carregaProfessor(idDisciplina, obj){
	ajaxGET('loader/carrega_professor.php?id='+idDisciplina, obj);
}


function atualizaTabela(){
	$('table > tbody > tr.linha').hover(function(){
        $(this).toggleClass('hover');
     });
	
	//dinstiguir pares e impares
	$('table > tbody > tr.linha:odd').addClass('odd');
	
	//ordenar campos
	$("table").tablesorter({
          dateFormat: 'uk',
          headers: {
            2: {
              sorter: false
            }
          }
        }) 
        .tablesorterPager({container: $("#pager")})
        .bind('sortBegin', function(){
          $('table > tbody > tr').removeClass('odd');
          $('table > tbody > tr.linha:odd').addClass('odd');
          $('table > tbody > tr.linha:odd').addClass('odd');
		  
        }); 
}

function montaNotas(){
	//selecionar dados do aluno e atualiza o form boletim
		$("tr.linha").click(function(){ 
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

function carregaTabelaTurmaAluno(idDisciplina, idProfessor, obj){
	ajaxGET('loader/carrega_tabela_turma_aluno.php?disciplina='+idDisciplina+'&professor='+idProfessor, obj,true);

}


function cadastraNotas(){
	$.post(
			$("form#Form_boletim").attr('action'),
			$("form#Form_boletim").serialize(),
			function(retorno){
				if(retorno.indexOf('ok')!=-1){
					$('div#retorno').html('Cadastrado com sucesso.');
				}else{
					$("div#retorno").html('<' + 'label class="mensagem_erro" for="nome" generated="true"' + '>' + retorno + '</' + 'label' + '>');
					$("div#retorno").show();
				}
			});
}