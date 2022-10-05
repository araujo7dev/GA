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

    <?php include ("menu.php"); ?>

    <!--- Table ---->
      <fieldset>
        <legend>Listar Imóveis</legend>
      
          <div class="container w-auto mt-2">
            <table class="table table-responsive table-hover table-bordered border rounded border-dark p-4">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Descricao</th>
                  <th scope="col">Utilização</th>
                  <th scope="col">W.C</th>
                  <th scope="col">Área(m²)</th>
                  <th scope="col">Garagem</th>
                  <th scope="col">Designação</th>
                  <th scope="col">Alugado</th>
                  <th scope="col">Ver/Editar</th>
                  <th scope="col">Excluir</th>
                </tr>
              </thead>
              <tbody>
                <?php $listaImoveis = $pdo->query("SELECT id, descricao, utilizacao, wc, area, garagem, designacao, status FROM imoveis ORDER BY descricao ASC"); 
                    foreach($listaImoveis as $listar){ ?>
                      <tr>
                        <th scope="row"><?php echo $listar['descricao'] ?></th>
                        <td><?php echo $listar['utilizacao'] ?></td>
                        <td><?php echo $listar['wc'] ?></td>
                        <td><?php echo $listar['area'] ?></td>
                        <td><?php echo $listar['garagem'] ?></td>
                        <td><?php echo $listar['designacao'] ?></td>

                        <!---- Dois operadores ternários dentro da td, o primeiro pra tornar vermelho ou azul o campo, o outro pra escolher entre Sim ou Não para o status do imóvel. ---->
                        <td class="text-center <?php $status = ($listar['status']) ? "alert alert-primary" : "alert alert-danger"; echo $status; ?>"><?php $status = ($listar['status']) ? "Sim" : "Não"; echo $status; ?></td>

                        <td class="text-center"><a href="editaImovel.php?id=<?php echo $listar['id'] ?>"><img src="./css/pencil-fill.svg" width="20px"></a></td>
                        <td class="text-center"><a href="./funcoes/deletaImovel.php?id=<?php echo $listar['id'] ?>"><img src="./css/trash-fill.svg" width="20" onclick="return confirm('Você confirma a exclusão deste registro?')"></a></td>
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
    
    <?php include ("rodape.php"); ?>
</body>
</html>