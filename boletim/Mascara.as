//início da classe máscara
class Mascara {
	//define função a pública setMascara com os parâmetros:
	//"campo" do tipo Object e "formato" do tipo String
	//como esta função não vai retornar nenhum valor a declaramos como Void
	public function setMascara(campo:Object, formato:String):Void {
		
		//restrige a inserção de qualquer caracter que não seja numérico
		campo.restrict = "0-9";
		//define o tamanho máximo de caracteres que podem ser inseridos no campo
		campo.maxChars = formato.length;
		//cria um array para armazenar os caracteres da máscara e suas respectivas posições
		var char:Array = new Array();
		char.splice(0);
		//no formato da máscara os campos númericos são representados por zero
		//no laço abaixo percorremos a variável formato caracter a caracter 
		for (var i = 0; i<formato.length; i++) {
			//se o caracter da vez for diferente de zero quer dizer que ele é um caracter da máscara
			if (formato.charAt(i) != 0) {
				//armazena a posição e o caracter da máscara
				char.push({intervalo:i, caractere:formato.charAt(i)});
			}
		}
		//o laço abaixo percorre o array char buscando a posição da máscara 
		function checaMascara() {
			for (var i = 0; i<char.length; i++) {
				//aqui temos que verificar se o usuário não está pressionado backspace
				//pois se não checarmos isso, quando for precionado backspace o cursor
				//vai ficar preso após a máscara
				if (!Key.isDown(Key.BACKSPACE)) {
					//se a posição do cursos coincidir com a posição da máscara
					if (campo.length == char[i].intervalo) {
						//atribuimos a máscara referente a posicção atual
						campo.text += char[i].caractere;
						//posicionamos o curos no próximo caracter após a máscara
						Selection.setSelection(char[i].intervalo+1, char[i].intervalo+1);
					}
				}
			}
		}
		//o os componentes TextInput são do tipo MovieClip e o objeto TextField é do tipo Object
		//portando abaixo temos que definir um EventListener para o TextInput e o evento onChanged
		//para o TextField já que um objeto não aceita um addEventListener
		//abaixo checamos se o campo em questão é um TextInput ou um TextField
		if (typeof (campo) == "movieclip") {
			//cria o listener para receber o evento change
			var mListener:Object = new Object();
			//atribui a função ao evento change
			mListener.change = function() {
				//chama a função que checa e insere as máscara
				checaMascara();
			};
			//atribuimos o listener ao campo
			campo.addEventListener("change", mListener);
		} else if (typeof (campo) == "object") {
			campo.onChanged = function() {
				//chama a função que checa e insere as máscara
				checaMascara();
			};
		}
	}
}
