<?php
  session_start();
  include_once("./funcoes/dbPDO.php");

  if($_SESSION['logado']){
    $iduser = $_SESSION['iduser'];
    $user = $_SESSION['user'];
  }else{
    $_SESSION["logado"] = "Você não está logado no sistema.";
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Aluguéis - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<body>
<?php include ("cabecalho.php"); ?>

    <!---Tab Menu--->
    <div class="container w-auto text-dark bg-white border border-dark p-1 rounded" style="box-shadow: 2px 2px 25px black;">

    <?php include("menu.php"); ?>


      <!--- Table ---->
      <fieldset>
        <legend>Listar Locadores e Locatários</legend>
      
          <div class="container w-auto mt-2">
            <table class="table table-responsive table-hover table-bordered border border-dark rounded p-4">
              <thead class="thead-light">
                <tr>
                  <th scope="col">nome</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Profissão</th>
                  <th scope="col">Data de Nascimento</th>
                  <th scope="col">Pessoa</th>
                  <th scope="col">Ver/Editar</th>
                  <th scope="col">Excluir</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $queryLocats = $pdo->query("SELECT id, nome, profissao, cpf, DATE_FORMAT(data_nasc, '%d/%m/%Y') as data_nasc, locat FROM locats ORDER BY nome ASC");

                  foreach( $queryLocats as $resultLocats){
                ?>
                    <tr>
                      <th scope="row"><?php echo $resultLocats['nome'] ?></th>
                      <td><?php echo $resultLocats['cpf'] ?></td>
                      <td><?php echo $resultLocats['profissao'] ?></td>
                      <td><?php echo $resultLocats['data_nasc'] ?></td>
                      <td><?php echo $resultLocats['locat'] ?></td>
                      <td class="text-center"><a href="editaLocadores.php?id=<?php echo $resultLocats['id'] ?>"><img src="./css/pencil-fill.svg" width="20px"></a></td>
                      <td class="text-center"><a href="./funcoes/deletaPessoa.php?id=<?php echo $resultLocats['id'] ?>"><img src="./css/trash-fill.svg" width="20" onclick="return confirm('Você confirma a exclusão deste registro?')"></a></td>
                    </tr>
            <?php } ?>
                
              </tbody>
            </table>
          </div>
      </fieldset>
    </div>
    <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
    <?php  } ?>
    <?php if(!empty($_SESSION['existe'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['existe'];  ?></p> 
            <?php unset($_SESSION['existe']); ?>
    <?php  } ?>
    <br><br>
    <?php include("rodape.php"); ?>
</body>
</html>