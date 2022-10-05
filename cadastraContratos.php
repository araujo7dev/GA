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
  <?php include("cabecalho.php"); ?>   
    <!--- Tab Menu --->
    <div class="container w-auto text-dark bg-white border border-dark p-1 rounded" style="box-shadow: 2px 2px 25px black;">
    <?php include("menu.php"); ?>
        <!----Tabela para escolher locador---->
        <div class="container">
          <fieldset>
            <legend>Cadastro de Contrato</legend>
            <form class="form-group border border-dark p-4 rounded" action="./fechaContrato.php" method="post">
              <div class="row mb-3">
                <div class="col-md-3">
                    <label for="exampleFormControlSelect1">Escolha o Locador</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="50" name="locador" autofocus>
                              <option selected>Lista de Locadores</option> 

                        <?php $listaLocadores = $pdo->query("SELECT id, nome FROM locats WHERE locat='Locador' ORDER BY nome ASC");
                              foreach($listaLocadores as $locador ){ ?>
                              <option value="<?php echo $locador['id'] ?>"><?php echo $locador['nome'] ?></option>
                      <?php   }?>
                        </select>
                </div>


                <div class="col-md-3">
                    <label for="exampleFormControlSelect1">Escolha o Locatário</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="50" name="locatario">
                              <option selected>Lista de Locatários</option> 

                        <?php $listaLocatarios = $pdo->query("SELECT id, nome FROM locats WHERE locat='Locatário' ORDER BY nome ASC");
                              foreach($listaLocatarios as $locatario){ ?>
                              <option value="<?php echo $locatario['id'] ?>"><?php echo $locatario['nome'] ?></option>
                      <?php   }?>          
                        </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlSelect1">Escolha o Imóvel</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="50" name="imovel">
                              <option selected>Lista de Imóveis</option> 
                        <?php $listaImoveis = $pdo->query("SELECT id, descricao, utilizacao, designacao, logradouro, numero FROM imoveis WHERE status='0' ORDER BY descricao ASC");
                              foreach($listaImoveis as $imovel ){ ?>
                              <option value="<?php echo $imovel['id'] ?>"><?php echo $imovel['descricao']." - ".$imovel['utilizacao']." - ".$imovel['designacao']." - ".$imovel['logradouro']." - ".$imovel['numero'] ?></option>
                      <?php   }?>    
                        </select>
                </div>
              </div>
              
              <input type="submit" class="btn btn-primary mt-3" value="Fechar Contrato">
            </form>
          </fieldset>
        </div>

        <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
        <?php  } ?>

 <?php include("rodape.php") ; ?>  
      
</body>
</html>