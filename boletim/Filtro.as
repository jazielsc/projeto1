//início da classe Filtro
class Filtro {
	//define função a pública setFiltro
	//o parâmetro cb vai receber o nome do combobox a ser filtrado
	//como esta função não vai retornar nenhum valor a declaramos como Void
	public function setFiltro(cb:Object):Void {
		//este array serve para armazenar os dados originais do combobox
		var dp:Array = new Array();
		//este array serve para armazenar os dados do combobox para depois passar para o array dp
		var dados:Array = new Array();
		//nesta variável armazenaremos o valor digitado no combobox
		var texto:String;
		//aqui atribuímos o provedor de dados do combobox
		dados = cb.dataProvider;
		//neste laço armazenamos os dados originais do combobox
		for (var i in dados) {
			dp.push({data:dados[i].data, label:dados[i].label});
		}
		//criamos um ouvinte de eventos para o combobox
		var cbListener:Object = new Object();
		cbListener.change = function() {
			//ao digitar algo abre o combobox
			cb.open();
			//convertemos o texto digitado no combobox para minúsculas
			texto = cb.text;
			//este array vai receber somente os dados que satisfazem o filtro
			var dadosFiltrados:Array = new Array();
			//neste laço comparamos o valor digitado com todos os valores do combobox
			for (var i in dp) {
				//agora comparamos o valor do label de todos os índices do array
				//o substring serve para comparar a palavra digitada com um número
				//correspondente de caracteres do label do índice atual já convertida para minúscula
				if (dp[i].label.substring(0, texto.length).toLowerCase() == texto) {
					//caso o valor digitado seja igual ao trecho de caracteres do índice atual
					//armazenamos estes dados 
					dadosFiltrados.push(dp[i]);
				}
			}
			//removemos todos os itens no combobox para receber os novos já filtrados
			cb.removeAll();
			//atribuimos os dados filtrados ao combobox
			cb.dataProvider = dadosFiltrados;
			//após o removeAll o texto digitado no combobox também é removido, etão devolvemos
			//o valor digitado para ele
			cb.text = texto;
			//aqui posicionamos o cursor após o último caracter digitado
			Selection.setSelection(texto.length, texto.length);
		};
		//e por fim adicionamos o ouvite de eventos ao combobox
		cb.addEventListener("change", cbListener);
	}
}