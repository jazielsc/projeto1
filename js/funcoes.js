// JavaScript Document
/*****FUNÇÕES JAVASCRIPT ***/


/*****FUNÇÃO AJAX****/
function ajaxGET(url, obj){
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