<?php

    session_start();

    include 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    include "connect.php";

    $idDeletar;

    //Validação para deletar informações
    if(isset($_POST['id_deletar']) && $_POST['id_deletar'] != ''){
        $idDeletar = $_POST['id_deletar'];

        $query_delete = "DELETE FROM tabelaup WHERE id = $idDeletar";
        $stmt_delete = $connect->prepare($query_delete);
        $stmt_delete->execute();

    }else{

        //Função para verificar a extenção do arquivo

        $allowed_extension = array('xls', 'xlsx');
        $file_array = explode(".", $_FILES['select_excel']['name']);
        $file_extension = end($file_array);
        if(in_array($file_extension, $allowed_extension))
        {
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($_FILES['select_excel']['tmp_name']);
    
        $data = $spreadsheet->getActiveSheet()->toArray();
    
        }else{
            $_SESSION['msg'] = "Formato do arquivo está incorreto";
        }


        //Função necessária para inserir informação no banco de dados string->Date
        function convertDataEua($attr){
            if($attr){
                $dataBr = $attr;
                $dataBri = explode('/', $dataBr);
                $dataEua = $dataBri[2] . '-' . $dataBri[1] . '-' . $dataBri[0];
                return $dataEua;
            }else{
                return $attr;
            }

        }
    

        //Função necessária para inserir informação no banco de dados string->float
        function convertToFloat($param){
            if($param){
                $valor = $param;
                $toConvert = explode(' ', $valor);
                $valorConvertido = $toConvert[1];
                return (float)$valorConvertido;
            }
            
            return $param;
    
        }


        //Função para mostrar a data ao usuário final
        function convertDataBr($attr){
            if($attr){
                $dataBr = $attr;
                $dataBri = explode('-', $dataBr);
                $convertBr = $dataBri[2] . '/' . $dataBri[1] . '/' . $dataBri[0];
                return $convertBr;
            } 
            
            return $attr;
            
        }

        foreach($data as $row){
     
            $cell = array(
                ':ean' => $row[0],
                ':produto' => $row[1],
                ':preco' => convertToFloat($row[2]),
                ':estoque' => $row[3],
                ':dataFabricacao' => convertDataEua($row[4])
            );
            
            if($cell[':preco'] > 0){

                //vefifica caso tenha valor repetido no banco de dados

                $query = "SELECT ean FROM tabelaup Where ean = :ean";
                $stmt = $connect->prepare($query);
                $stmt->bindValue(":ean",$cell[':ean']);
                $stmt->execute();
                $repetido =  $stmt->fetch();

                if($repetido){
                    $_SESSION['msg'] = "Valor EAN repetido não foi inserido";
                }else{
                    $query = "INSERT INTO tabelaup (
                        ean,nome_produto,preco,estoque,data_fabricacao) 
                        VALUES (
                            :ean,:produto,:preco,:estoque,:dataFabricacao)";
                    $stmt = $connect->prepare($query);
                    //inserindo direto com o array $cell
                    $stmt ->execute($cell);
                }
         
            }

            //buscando dados depois da inserção
            
            $query_tabela = "SELECT * FROM tabelaup";
    
            $stmt_tabela = $connect->prepare($query_tabela);
            $stmt_tabela->execute();
            $resultDB =  $stmt_tabela->fetchAll(PDO::FETCH_ASSOC);
    
        }

    }
?>
<html>
<div class="table-responsive">
    <table class="table table-bordered table-dark">

    <tr>

        <th>Ação</th>
        <th>EAN</th>
        <th>Nome do produto</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Data</th>

    </tr>
    <?php
    foreach($resultDB as $rowDB){?>
    <tr id="rowHide<?php echo $rowDB['id'] ?>">

        <td> <button class="btn btn-danger" onclick="deletar(<?php echo $rowDB['id'] ?>)">Deletar</button> </td>
        <td><?php echo $rowDB['ean']?></td>
        <td><?php echo $rowDB['nome_produto']?></td>
        <td><?php echo $rowDB['preco']?></td>
        <td><?php echo $rowDB['estoque']?></td>
        <td><?php echo convertDataBr($rowDB['data_fabricacao'])?></td>
        
    </tr>
    <?php } ?>
    </table>
    <!-- caso houver menssagem de erro -->
    <?php if(isset($_SESSION['msg'])){
        echo '<h3 class="text-danger">' . $_SESSION['msg'] . '</h3>';
        unset($_SESSION['msg']);
    }
    ?>
</div>
</html>