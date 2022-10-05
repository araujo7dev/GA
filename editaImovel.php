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

  $id_imovel = $_GET['id'];
  // Puxar dados do imóvel cujo id é o de cima.
  $queryImovel = $pdo->query("SELECT * FROM imoveis WHERE id='$id_imovel'");
  $imovel = $queryImovel->fetch();
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

        <!---Formulário de Cadastro de Locador --->
        <fieldset>
        <legend>Editar dados de Imóvel</legend>
        <div class="container w-auto mt-2">
            <form class="form-group border border-dark p-4 rounded" action="./funcoes/editaImovelDB.php" method="post">
              <!----Linha 1---->
              <div class="row mb-3">
                  <div class="col-md-4">
                        <label for="exampleFormControlSelect1">Descrição</label>
                          <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="10" name="descricao" autofocus>
                            <option value="Apartamento" selected>Apartamento</option>
                            <option value="Casa">Casa</option>
                            <option value="Sobrado">Sobrado</option>
                            <option value="Sala">Sala</option>

                            <option selected ><?php echo $imovel['descricao'] ?></option>
                          </select>
                      
                  </div>
                  <div class="col-md-3">
                      <label for="">Utilização</label>
                          <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="10" name="utilizacao">
                            <option value="Comercial" selected>Comercial</option>
                            <option value="Residencial">Residencial</option>

                            <option selected value="<?php echo $imovel['utilizacao'] ?>"><?php echo $imovel['utilizacao'] ?></option>
                          </select>
                  </div>
                  <div class="col-md-1">
                    <label for="">W.C</label>
                    <input class="form-control form-control-sm" type="number" name="wc" size="20" maxlength="2" value="<?php echo $imovel['wc'] ?>">
                  </div>
                  
              </div>

              <!----Linha 2---->
              <div class="row mb-3">
                  <div class="col-md-1">
                      <label for="">Área m²</label>
                      <input class="form-control form-control-sm" type="text" name="area" maxlength="6" value="<?php echo $imovel['area'] ?>">
                  </div>
                  
                  <div class="col-md-2">
                    <label for="">Garagem</label>
                          <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="10" name="garagem">
                            <option value="Privativa" selected>Privativa</option>
                            <option value="Rotativa">Rotativa</option>

                            <option selected value="<?php echo $imovel['garagem'] ?>"><?php echo $imovel['garagem'] ?></option>
                          </select>
                  </div>
                  <div class="col-md-5">
                    <label for="">Designação</label>
                    <input class="form-control form-control-sm" type="text" name="designacao" placeholder="'apto 01', 'Sala 05' ..." value="<?php echo $imovel['designacao'] ?>">
                  </div>
              </div>

              <!----Linha 3---->
              <div class="row mb-3">
                  <div class="col-md-6">
                      <label for="">Logradouro</label>
                      <input class="form-control form-control-sm" type="text" name="logradouro" maxlength="127" placeholder="Digite o endereço" value="<?php echo $imovel['logradouro'] ?>">
                  </div>
                  <div class="col-md-2">
                    <label for="">Número</label>
                    <input class="form-control form-control-sm" type="number" name="numero" maxlength="5" placeholder="Digite o número" value="<?php echo $imovel['numero'] ?>">
                  </div>
                  <div class="col-md-4">
                    <label for="">Complemento</label>
                    <input class="form-control form-control-sm" type="text" name="complemento" placeholder="Digite o complemento" value="<?php echo $imovel['complemento'] ?>">
                  </div>
              </div>

              <!----Linha 4---->
              <div class="row mb-3">
                  <div class="col-md-5">
                      <label for="">Bairro</label>
                      <input class="form-control form-control-sm" type="text" name="bairro" maxlength="127" placeholder="Digite o bairro" value="<?php echo $imovel['bairro'] ?>">
                  </div>
                  <div class="col-md-5">
                    <label for="">Cidade</label>
                    <input class="form-control form-control-sm" type="text" name="cidade" maxlength="127" placeholder="Digite a cidade" value="<?php echo $imovel['cidade'] ?>">
                  </div>
                  <div class="col-md-2">
                    <label for="">CEP</label>
                    <input class="form-control form-control-sm" type="text" name="cep" id="" maxlength="9" placeholder="00000-000" value="<?php echo $imovel['cep'] ?>">
                  </div>
              </div>
                <input type="hidden" name="id_usuario" value="<?php echo $imovel['id_usuario'] ?>">
                <input type="hidden" name="id_imovel" value="<?php echo $id_imovel ?>">
              <input type="submit" class="btn btn-primary mt-3" value="Editar">
            </form>
        </div>
        </fieldset>
    </div>
    <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
    <?php  } ?>
    <br><br><br>

    
    
    <?php include("rodape.php"); ?>

    
</body>
</html>