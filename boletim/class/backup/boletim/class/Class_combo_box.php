<?php

/**
 * classe para manipulação dos combobox do sistema, ou seja essa classe foi criada para o preenchimento dos combos
 * nos formulários...
 *
 * @author Administrador
 */
class Class_combo_box
{

    public $tabela;
    public $campos;
    public $order_by;
    public $cod;
    public $nome;


    public static function consulta_combo_bairro ()
    {

        include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

        $query_autor = mysql_query("SELECT bairro_id, bairro_nome FROM bairro ORDER BY bairro_nome",$conn);

        // verificando se a query retornou algum valor
        $quant = mysql_num_rows($query_autor);

        // se retornou então preenche os dados no flash

        if ($quant > 0)
            {

                $i = 0;
                while ($result_autor = mysql_fetch_array($query_autor))
                    {

                        echo "&cod$i=$result_autor[0]";
                        echo "&nome$i=$result_autor[1]";

                        $i++;
                    }

                echo "&mensagemtemas=OK";
            } else
                echo "&mensagemtemas=nao";


                mysql_close(); 

                
    } // fim do método

     public static function consulta_combo_cidade ()
    {

        include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

        $query_autor = mysql_query("SELECT bairro_id, bairro_nome FROM bairro ORDER BY bairro_nome",$conn);

        // verificando se a query retornou algum valor
        $quant = mysql_num_rows($query_autor);

        // se retornou então preenche os dados no flash

        if ($quant > 0)
            {

                $i = 0;
                while ($result_autor = mysql_fetch_array($query_autor))
                    {


                        echo "&cod$i=$result_autor[0]";
                        echo "&nome$i=$result_autor[1]";

                        $i++;
                    }

            echo "&mensagemtemas=OK";
            } else
            echo "&mensagemtemas=nao";


mysql_close();

    } // fim do método

    public static function consulta_combo_rua ()
    {

        include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

        $query_autor = mysql_query("SELECT rua_id, rua_nome FROM rua ORDER BY rua_nome",$conn);

        // verificando se a query retornou algum valor
        $quant = mysql_num_rows($query_autor);

        // se retornou então preenche os dados no flash

        if ($quant > 0)
            {

                $i = 0;
                while ($result_autor = mysql_fetch_array($query_autor))
                    {

                        echo "&cod$i=$result_autor[0]";
                        echo "&nome$i=$result_autor[1]";

                        $i++;
                    }

            echo "&mensagemtemas=OK";
        } else
            echo "&mensagemtemas=nao";


mysql_close();
    } // fim do método

    public static function consulta_combo_uf ()
    {

        include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

        $query_autor = mysql_query("SELECT uf_id, uf_sigla FROM uf ORDER BY uf_sigla",$conn);

        // verificando se a query retornou algum valor
        $quant = mysql_num_rows($query_autor);

        // se retornou então preenche os dados no flash

        if ($quant > 0)
            {

                $i = 0;
                while ($result_autor = mysql_fetch_array($query_autor))
                {

                    echo "&cod$i=$result_autor[0]";
                    echo "&nome$i=$result_autor[1]";

                    $i++;
                }

           echo "&mensagemtemas=OK";
        } else
          echo "&mensagemtemas=nao";


mysql_close();

     } // fim do método

     public static function consulta_combo_status ()
    {

        include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

        $query_autor = mysql_query("SELECT cod_status, nome FROM status ORDER BY cod_status",$conn);

        // verificando se a query retornou algum valor
        $quant = mysql_num_rows($query_autor);

        // se retornou então preenche os dados no flash

        if ($quant > 0)
            {

                $i = 0;
                while ($result_autor = mysql_fetch_array($query_autor))
                {

                    echo "&cod$i=$result_autor[0]";
                    echo "&nome$i=$result_autor[1]";

                    $i++;
                }

           echo "&mensagemtemas=OK";
        } else
          echo "&mensagemtemas=nao";


mysql_close();

     } // fim do método
} // fim da classe
?>