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

  $idregistro = $_GET['id'];

  $queryID = $pdo->query( "SELECT 
                            id, 
                            nome, 
                            est_civil, 
                            profissao, 
                            rg, 
                            cpf, 
                            data_nasc, 
                            email, 
                            logradouro, 
                            numero,
                            complemento,
                            bairro,
                            cidade,
                            cep,
                            locat FROM locats WHERE id='$idregistro'");
    $resultado = $queryID->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Aluguéis</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<body>
   
<?php include ("cabecalho.php"); ?>
    
    <!--- Tab Menu --->
    <div class="container w-auto text-dark bg-white border border-dark p-1 rounded" style="box-shadow: 2px 2px 25px black;">
        
    <?php include ("menu.php"); ?>

        <!---Formulário de Cadastro de Locador --->
        <fieldset>
        <legend>Editar Cadastro</legend>
        <div class="container w-auto mt-2">
            <form class="form-group border border-dark p-4 rounded" action="./funcoes/editaLocadoresDB.php" method="post">
              <!----Linha 1---->
              <div class="row mb-3">
                  <div class="col-md-6">
                      <label for="">Nome</label>
                      <input class="form-control form-control-sm" type="text" name="nome" value="<?php echo $resultado['nome'] ?>" autofocus required>
                  </div>
                  <div class="col-md-3">
                    <label for="exampleFormControlSelect1">Estado Civil</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="est_civil" required>
                          <option value="Solteiro(a)" selected>Solteiro(a)</option>
                          <option value="Casado(a)">Casado(a)</option>
                          <option value="Divorciado(a)">Divorciado(a)</option>
                          <option value="Viúvo(a)">Viúvo(a)</option>
                          <option value="<?php echo $resultado['est_civil'] ?>" selected><?php echo $resultado['est_civil'] ?></option>
                        </select>
                  </div>
                  <div class="col-md-3">
                    <label for="">Profissão</label>
                    <input class="form-control form-control-sm" type="text" name="profissao" value="<?php echo $resultado['profissao'] ?>" maxlength="127" required>
                  </div>
              </div>

              <!----Linha 2---->
              <div class="row mb-3">
                  <div class="col-md-3">
                      <label for="">RG</label>
                      <input class="form-control form-control-sm" type="text" name="rg" value="<?php echo $resultado['rg'] ?>" maxlength="11" required>
                  </div>
                  <div class="col-md-3">
                    <label for="">CPF</label>
                    <input class="form-control form-control-sm" type="text" name="cpf" value="<?php echo $resultado['cpf'] ?>" maxlength="14" required>
                  </div>
                  <div class="col-md-2">
                    <label for="">Data de Nascimento</label>
                    <input class="form-control form-control-sm" type="date" name="data_nasc" value="<?php echo $resultado['data_nasc'] ?>" id="" required>
                  </div>
                  <div class="col-md-4">
                      <label for="">Email</label>
                      <input class="form-control form-control-sm" type="email" name="email" value="<?php echo $resultado['email'] ?>" required>
                  </div>
              </div>

              <!----Linha 3---->
              <div class="row mb-3">
                  <div class="col-md-6">
                      <label for="">Logradouro</label>
                      <input class="form-control form-control-sm" type="text" name="logradouro" value="<?php echo $resultado['logradouro'] ?>" maxlength="127" required>
                  </div>
                  <div class="col-md-2">
                    <label for="">Número</label>
                    <input class="form-control form-control-sm" type="text" name="numero" value="<?php echo $resultado['numero'] ?>" maxlength="5">
                  </div>
                  <div class="col-md-4">
                    <label for="">Complemento</label>
                    <input class="form-control form-control-sm" type="text" name="complemento" value="<?php echo $resultado['complemento'] ?>" id="">
                  </div>
              </div>

              <!----Linha 4---->
              <div class="row mb-3">
                  <div class="col-md-5">
                      <label for="">Bairro</label>
                      <input class="form-control form-control-sm" type="text" name="bairro" value="<?php echo $resultado['bairro'] ?>" maxlength="127" required>
                  </div>
                  <div class="col-md-5">
                    <label for="">Cidade</label>
                    <input class="form-control form-control-sm" type="text" name="cidade" value="<?php echo $resultado['cidade'] ?>" maxlength="127" required>
                  </div>
                  <div class="col-md-2">
                    <label for="">CEP</label>
                    <input class="form-control form-control-sm" type="text" name="cep" value="<?php echo $resultado['cep'] ?>" maxlength="9" required>
                  </div>
              </div>
              <fieldset class="container border">
              <legend>Selecione</legend>
              <div class="custom-control custom-radio">
                  <?php $loc = ($resultado['locat'] == "Locador" ? "checked" : "");
                        $loc2 = ($resultado['locat'] == "Locatário" ? "checked" : "");
                  ?>
                  <input type="radio" id="customRadio1" name="locat" value="Locador" class="custom-control-input" <?php echo $loc; ?>>
                  <label class="custom-control-label" for="customRadio1">Locador</label>
              </div>
              <div class="custom-control custom-radio">
                  <input type="radio" id="customRadio2" name="locat" value="Locatário" class="custom-control-input" <?php echo $loc2; ?>>
                  <label class="custom-control-label" for="customRadio2">Locatário</label>                
              </div>
              </fieldset>
                <input type="hidden" value="<?php echo $idregistro; ?>" name="id">
              <input type="submit" class="btn btn-primary mt-3" value="Editar Cadastro">
            </form>
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