<?php
include "./functions.php";
$form=  filter_input(INPUT_POST, "form");
if($form=="0"){?>
<table class="table table-bordered">
    <th>Adicionar membro</th>
         <tr>
            <td>Nome:</td><td><input id="nome" type="text" width="20px" maxlength="255"></td>
        </tr><tr>
            <td>Password:</td><td><input id="password" type="password" width="20px" maxlength="255"></td>
        </tr><tr>
            <td>Confirmar password:</td><td><input id="password2" type="password" width="20px" maxlength="255"></td>
        </tr><tr>
            <td>Email:</td><td><input id="email" type="email" width="20px" maxlength="255"></td>
        </tr><tr>
            <td>Contacto:</td><td><input id="contacto" type="text" width="20px"  ></td>
        </tr><tr>
            <td>Iniciais:</td><td><input id="iniciais" type="text" width="20px"></td>
        </tr><tr>
            <td>Cor:</td><td><input id="cor" type="color" width="20px"></td>
        </tr><tr>
            <td>VOIP:</td><td><input id="voip" type="text" width="20px" maxlength="4"></td>
        </tr><tr>
            <td>Número de lugares:</td><td><input id="nlugares" type="number" value="4"></td>
        </tr><tr>
            <td>Partida:</td><td><input id="partida" type="text" maxlength="255" width="20px"></td>
        </tr><tr>
            <td>Destino:</td><td><input id="destino" type="text" maxlength="255" width="20px"></td>
        </tr><tr>
            <td></td><td><button onclick="AdicionarUtilizador()">Adicionar</button></td>
        </tr><tr>
</table>
<?php } else if ($form == "1"){
    $opt=  OptionsMembros();?>
     <table  class="table table-bordered">
         <tr ><td colspan="2"><select id="altutilizador" onchange="PreencherAltUtilizador(document.getElementById('altutilizador').value)"><?php echo $opt;  ?></select></td></tr>
         <tr  ><td id="utilizadoralt"></td></tr>
        </table>

<?php } else if ($form == "2"){ 
    $opt=  OptionsMembros();?>
<table class="table table-bordered">
    <tr><td><select id="eliutilizador"><?php echo $opt;  ?></select></td></tr>
    <tr><td><button onclick="EliminarUtilizador(document.getElementById('eliutilizador').value,document.getElementById('eliutilizador').options[document.getElementById('eliutilizador').selectedIndex ].text)">Eliminar</button></td></tr>
</table>
<?php } ?>