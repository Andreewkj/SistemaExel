<?php

  session_start();

  if(!isset($_SESSION['logado']) || $_SESSION['logado'] != 1){
      $_SESSION['msg'] = "Usuário Desconhecido";
      header("Location: ./login/login.php");
  }else{
?>
<?php include "./partials/header.php" ?>
   <div class="container mt-5">

    <h1 class="text-center mb-5">Bem vindo, <?php  echo $_SESSION['nome'];?></h1>

   <div class="container">
      <div class="row">
        <div class="col-sm-8">
        <form method="post" id="load_excel_form" enctype="multipart/form-data">

          <div class="form-group">


          <label for="inputfile"></label>
          <input type="file" class="form-control-file" id="inputfile" name="select_excel">
          <button class="btn btn-success mt-4" type="submit">Enviar</button>

          </div>
          </form>
        </div>
        <div class="col-sm-4"> <a href="./login/logout.php"><button type="button" class="btn btn-danger btn-lg">Logout</button></a></div>
      </div>
    </div>
      <div id="excel_area"></div>
     </div>
     </div>
     <?php include "./partials/footer.php" ?>
     <script src="scripts/deletar.js"></script>
      <script src="scripts/buscar.js"></script>
<?php } ?>