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

    <!---Tab Menu--->
    <div class="container w-auto text-dark bg-white border border-dark p-1 rounded" style="box-shadow: 2px 2px 25px black;">

    <?php include("menu.php"); ?>
    
      <!--- Table ---->
      <fieldset>
        <legend>Listar Contratos</legend>
      
          <div class="container w-auto mt-2">
            <table class="table table-sm table-responsive table-hover table-bordered border border-dark p-4">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Locador</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Locatário</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Imóvel</th>
                  <th scope="col">Status do Contrato</th>
                  <th scope="col">(R$)/mês</th>
                  <th scope="col">Mensalidades</th>
                  <th scope="col">Excluir</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    // Fazendo query da tabela contratos com INNER JOIN com locador, locatario, imovel.
                    $queryContratos = $pdo->query("select b.nome,
                                                          b.cpf,
                                                          a.nome,
                                                          a.cpf , 
                                                          i.designacao,
                                                          i.status,
                                                          c.valor,
                                                          i.id
                                                      from locats a, 
                                                           locats b,
                                                           contratos c,
                                                            imoveis i 
                                                       where a.id =c.id_locatario   
                                                       and b.id =c.id_locador 
                                                       and c.id_imovel = i.id");

                    foreach($queryContratos as $contrato){ ?>
                      <tr>
                        <th scope="row"><?php echo $contrato[0] ?></th>
                        <td><?php echo $contrato[1] ?></td>
                        <td><a data-toggle="tooltip" data-placement="top" title="Editar Contrato" href="#"><?php echo $contrato[2] ?></a></td>
                        <td><?php echo $contrato[3] ?></td>
                        <td><?php echo $contrato[4] ?></td>
                        <td><?php $status = ($contrato[5]) ? "Vigente":""; echo $status; ?></td>
                        <td><?php $num = number_format($contrato[6], 2, ",", "."); echo $num; ?></td>
                        <td class="text-center"><a data-toggle="tooltip" data-placement="top" title="Cadastrar/Editar/Pagar Parcelas" href="./vencimentosParcelas.php?id=<?php echo $contrato[7] ?>">Parcelas</a></td>
                        <td class="text-center"><a href="#" onclick="return confirm('Você deseja realmente excluir este contrato?')"><img src="./css/trash-fill.svg" width="20px"></a></td>
                     
                      </tr>
            <?php   } ?>
              </tbody>
            </table>
          </div>
      </fieldset>
      <?php if($_SESSION['msg']){?>
          <p class="alert alert-primary text-center"><?php echo $_SESSION['msg'];?></p>
      <?php unset($_SESSION['msg']); ?>
    <?php   }?>

    <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
    <?php  } ?>
    </div>
    
    <?php include("rodape.php"); ?>

</body>
</html>