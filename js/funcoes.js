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
	$('table > tbody > tr').hover(function(){
        $(this).toggleClass('hover');
     });
	
	//dinstiguir pares e impares
	$('table > tbody > tr:odd').addClass('odd');
	
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
          $('table > tbody > tr:odd').addClass('odd');
        }); 
		
		
		//selecionar dados
		$("tr").click(function(){ 
			//tenho que pegar os codigos
		   	alert( $(this).find('td:eq(1)').text() ); 
		   return false; 
		}); 
		 
}
function carregaTabelaTurmaAluno(idDisciplina, idProfessor, obj){
	ajaxGET('loader/carrega_tabela_turma_aluno.php?disciplina='+idDisciplina+'&professor='+idProfessor, obj,true);

}
