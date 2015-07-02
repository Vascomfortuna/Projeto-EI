<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        
        <?php  
       include './masterpage.php';
       error_reporting(0);
       ?>
        <div class="container">
        <table class="table-condensed" align="center">
            <tr><td><div id="divmsg"></div></td></tr>
            <tr>
                <td>Nome:</td>
                <td><input id="nome" type="text" width="20px" value="<?php echo $_SESSION['nome']?>"/></td>
            </tr>
            <tr>
                <td>Iniciais:</td>
                <td><input id="iniciais" type="text" width="20px" maxlength="9" value="<?php echo $_SESSION['iniciais']?>"/></td>
            </tr>
            <tr>
                <td>Contacto(9 números):</td>
                <td><input id="contacto" type="text" width="20px" maxlength="9" value="<?php echo $_SESSION['contacto']?>"/></td>
            </tr>
            <tr>
                <td>VOIP:</td>
                <td><input id="voip" type="text" width="20px" maxlength="4" value="<?php echo $_SESSION['voip']?>"/></td>
            </tr>
            <tr>
                <td>Número de lugares(por omissão):</td>
                <td><input id="nlugares" type="number" width="20px" maxlength="2" value="<?php echo $_SESSION['nlugares']?>"/></td>
            </tr>
            <tr>
                <td>Partida(por omissão):</td>
                <td><input id="partida" type="text" width="20px" value="<?php echo $_SESSION['partida']?>"/></td>
            </tr>
            <tr>
                <td>Destino(por omissão):</td>
                <td><input id="destino" type="text" width="20px" value="<?php echo $_SESSION['destino']?>" /></td>
            </tr>
            <tr>
                <td>Cor:</td>
                <td><input id="cor" type="color" width="20px" value="<?php echo $_SESSION['cor']?>" /></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input id="password" type="password" width="20px"  /></td>
            </tr>
            <tr>
                
                <td colspan="2"><button onclick="AlterarUtilizador();">Alterar</button></td>
            </tr>
        </table>
        </div>
           </body>
</html>


