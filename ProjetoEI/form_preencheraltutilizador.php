<?php

include "./functions.php";
$idutilizador = filter_input(INPUT_POST, "idutilizador");
$u = explode(',', BuscarUtilizador($idutilizador), -1);
?>
<table class="table">
        <tr>
                <td>Email:</td>
                <td><input id="email" type="email" width="20px" value="<?php echo $u[0]?>"/></td>
            </tr>
         <tr>
                <td>Nome:</td>
                <td><input id="nome" type="text" width="20px" value="<?php echo $u[1]?>"/></td>
            </tr>
            <tr>
                <td>Iniciais:</td>
                <td><input id="iniciais" type="text" width="20px" maxlength="9" value="<?php echo $u[5]?>"/></td>
            </tr>
            <tr>
                <td>Contacto(9 números):</td>
                <td><input id="contacto" type="text" width="20px" maxlength="9" value="<?php echo $u[3]?>"/></td>
            </tr>
            <tr>
                <td>VOIP:</td>
                <td><input id="voip" type="text" width="20px" maxlength="4" value="<?php echo $u[4]?>"/></td>
            </tr>
            <tr>
                <td>Número de lugares(por omissão):</td>
                <td><input id="nlugares" type="number" width="20px" maxlength="2" value="<?php echo $u[6]?>"/></td>
            </tr>
            <tr>
                <td>Partida(por omissão):</td>
                <td><input id="partida" type="text" width="20px" value="<?php echo $u[7]?>"/></td>
            </tr>
            <tr>
                <td>Destino(por omissão):</td>
                <td><input id="destino" type="text" width="20px" value="<?php echo $u[8]?>" /></td>
            </tr>
            <tr>
                <td>Cor:</td>
                <td><input id="cor" type="color" width="20px" value="<?php echo $u[2]?>" /></td>
            </tr>
            <tr>
                <td colspan="2"><button onclick="AlterarUtilizadorAdmin(document.getElementById('altutilizador').value);">Alterar</button></td>
            </tr>
            </table>