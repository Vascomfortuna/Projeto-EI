<html>
    <head>
        <meta charset="UTF-8">
        <title>Car Pooling</title>
    </head>
    <body>
<?php include './masterpage.php'; ?>
        <div class="container" style="float:left;">

            <h2>Opções</h2>
            <table class="table table-bordered table-condensed">
                <tr>
                    <th><button onclick="MudarForm(0)">Adicionar utilizador</button></th>
                    <th><button onclick="MudarForm(1);PreencherAltUtilizador('1')">Alterar utilizador</button></th>
                    <th><button onclick="MudarForm(2)">Eliminar utilizador</button></th>
                </tr>
            </table>
            <div id="adminmsg"></div>
        </div>
        <div id="adminform" class="container" style="vertical-align: bottom;float:left;">

        </div>
</html>