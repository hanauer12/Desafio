<?php

//Conexão com o banco de dados temporario.

$connbancotemporario = new mysqli("localhost", "root", "", "teste");
 mysqli_set_charset($conn,"utf8");

//Conexão com o banco final.
$connbanco = new mysqli("localhost", "root", "", "MedicalChallenge");
 mysqli_set_charset($conn,"utf8");

    $arq  = $_FILES["file"]["tmp_name"];
    $nome  = $_FILES["file"]["name"];

    $ext = explode(".", $nome);
    $validaextensao = end($ext);

    //Valida extensão do arquivo se o arquivo recebido na pagina html , onde eu passo via POST não for .csv não executa o restante do codigo.
    
    if($validaextensao != "csv"){
        echo "ext invalida";
    }else{
     
    //Tratei o arquivo .csv recebido com uma função do PHP (fopen) aonde consigo ler todo arquivo.    
        $lerarq = fopen($arq, 'r');
    
    //Usei a função fgetcsv do PHP para poder tratar os dados do csv especificando que são separados por ;
    //Sendo assim lendo cada campo do arquivo csv , cada campo se tratava de uma string iniciando na posição 0.
    //Nesse codigo teve problema pois não consegui tratar alguns campos como data de nascimento pois no documento .csv esta separado por / e no banco aceitava somente separado por -.
    //Sendo assim , fez alguns teste aonde usei somente campos como nome, pai,convenio e fizeram a inserção dos dados no banco temporario.
    //Minha ideia seria inserir os dados nesse banco de dados temporario que tinha criado para a tabela pacientes do banco principal e após isso acessar esse banco de dados , ler as informações e inserir somente o que precisava no banco principal, mas infelizmente não obteve sucesso, realiazindo o procedimendo.

        while(($dados = fgetcsv($lerarq, 1000, ";")) !== FALSE)
    
        {
            $cod_paciente = utf8_encode($dados[0]);
            $nome_paciente = utf8_encode($dados[1]);
            $nasc_paciente = utf8_encode($dados[2]);
            $pai_paciente = utf8_encode($dados[3]);
            $mae_paciente = utf8_encode($dados[4]);
            $cpf_paciente = utf8_encode($dados[5]);
            $rg_paciente = utf8_encode($dados[6]);
            $sexo_pac = utf8_encode($dados[7]);
            $id_conv = utf8_encode($dados[8]);
            $convenio = utf8_encode($dados[9]);
            $obs_clinicas = utf8_encode($dados[10]);

$result = $connbancotemporario->query("INSERT INTO primeiro (cod_paciente, nome_paciente, nasc_paciente, pai_paciente, mae_paciente,
 cpf_paciente, rg_paciente, sexo_pac, id_conv, convenio, obs_clinicas) VALUES ('$cod_paciente', '$nome_paciente', '$nasc_paciente',
  '$pai_paciente', '$mae_paciente', '$cpf_paciente', '$rg_paciente', '$sexo_pac', '$id_conv', '$convenio', '$obs_clinicas')");     
        }

            if($result){
                echo "Dados inseridos com sucesso no banco de dados";
                 }else{
                echo"Problemas ao inserir as informações no banco de dados";
            }
     


    }

?>



