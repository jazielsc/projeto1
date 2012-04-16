<?php 

session_start();
// Eliminar todas as variáveis de sessão.
unset($_SESSION['user_agent']);

unset($_SESSION['remote_addr']);

unset($_SESSION['NomeUsuario']);
			unset($_SESSION['passagem']);

		    unset($_SESSION['permissao']);
			unset($_SESSION['id_usuario']);

                        unset($_SESSION['id_referencia']);

			unset($_SESSION['id_aluno_professor']);

                        unset($_SESSION['pasta']);
                        unset($_SESSION['area_login']);

                        
// Finalmente, destruição da sessão.
//session_destroy();

if ($_SESSION['id_instituicao'] == 0)
Header("Location: login.php");
else
Header("Location: index.php");







?>