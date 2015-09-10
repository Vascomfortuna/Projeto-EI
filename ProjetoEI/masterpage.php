<html>
    <head>
        <?php include 'functions.php';?>
        
        <meta charset="UTF-8">
        
        <link rel="stylesheet" type="text/css" href="bootstrap.css">    
        <link rel="stylesheet" type="text/css" href="styles.css">    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Car Pooling</title>
    </head>
    <body>
        <div id="masterdiv" class="container">
            <div class="row">
                <form method="POST" action="">

                    <div class="col-xs-4 col-sm-2 text-center"><h1>Car Pooling</h1></div>
                    <div class="col-xs-10  col-sm-6"></div>
                   <!-- <div class="col-xs-6  col-sm-4 "><br/><input type="text" name="pesqText">
                        <select name="pesqOption">
                            <option value="m">Membros</option>
                            <option value="g" selected>Grupos</option>
                        </select>
                        <button type="submit">Pesquisar</button>
                    </div>-->
                </form>
            </div>
        </div>
        <div class="container" style="width:100%">
        <div id="login" class="row" > 
            <?php if(!(isset($_SESSION['idutilizador'])) || !(isset($_SESSION['nome']))){ ?>
            <div class="col-xs-10  col-sm-2 text-center"><a href="./login.php">Iniciar sessão</a></div>
            <?php } else { ?>
            <div class="col-xs-10 col-sm-2 text-center" style=""><a  href="#" onclick="Logout()">Logout</a></div>
            <div class="col-xs-10  col-sm-2 text-center"><a href="./mapaboleia.php">Mapa das boleias</a></div>
            <div class="col-xs-10  col-sm-2 text-center"><a href="./conf.php">Configuração</a></div>
            <div class="col-xs-10  col-sm-2 text-center"><a href="./alteracoes.php">Alterações</a></div>
            <div class="col-xs-10  col-sm-2 text-center"><a href="./estatisticas.php">Estatisticas</a></div>
            <?php } 
            if(!(empty($_SESSION['idutilizador']))&&$_SESSION['idutilizador']=='1'){?>
            <div  class="col-xs-10 col-sm-2 text-center"><a href="administracao.php" onclick="Aparecer('tl');" align="center">
                    Administração</a></div>
            <?php } ?>
        </div>
        </div>
        
    </body>
</html>
