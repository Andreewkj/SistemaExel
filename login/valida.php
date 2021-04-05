<?php

    session_start();

    include "../connect.php";

    if(isset($_POST['inputSenha'])){
        $usuario = filter_input(INPUT_POST, 'inputEmail', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'inputSenha', FILTER_SANITIZE_STRING);
        if((!empty($usuario)) && (!empty($senha))){
            //Gerar senha criptografada
            //echo password_hash($senha, PASSWORD_DEFAULT);
            $query = "SELECT * FROM usuarios WHERE email = '$usuario'";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $result =  $stmt->fetch(PDO::FETCH_ASSOC);
            //buscando senha do banco e validando 
            if(password_verify($senha, $result['senha'])){
                
                $_SESSION['id'] = $result['id'];
                $_SESSION['nome'] = $result['nome'];
                $_SESSION['logado'] = 1;

                header("Location: ../index.php");
            }else{
                $_SESSION['msg'] = "Login ou senha incorretos";
                header("Location: login.php");
            }

        }else{
            $_SESSION['msg'] = "Verifique os campos preenchidos";
            header("Location: login.php");
        }
    }else{
        $_SESSION['msg'] = "Erro por falta de credenciais";
        header("Location: login.php");
    }


?>