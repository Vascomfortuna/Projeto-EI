<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php include './masterpage.php'; 
              $utilizador=  split(",",BuscarMembros());
              echo current($utilizador);
        ?>
        <div class="container" style="width:15%; float:left">
            <h2>Membros</h2>
            <table class="table">
                <tr>
                    <th>Nome</th>
                </tr>
               
                    <?php
                    for ($i=0;$i<(count($utilizador)/2);$i++){
                    
                    echo "<tr><td style=\"background-color:".current($utilizador)."\">".utf8_encode (next($utilizador))."</td></tr>";
                    next($utilizador);
                    }?>
                
            </table>
        </div>
        <div class="container">
        <div class="container" style="width:100%; float:left">
            <h2>Mapa</h2>
            <table class="table table-bordered table-condensed mapaboleia">
                <tr>
                    <th>Hora</th>
                    <th>Segunda</th>
                    <th>Terça</th>
                    <th>Quarta</th>
                    <th>Quinta</th>
                    <th>Sexta</th>
                    <th>Sábado</th>
                </tr>
                <?php
                $z=0;
                for ($x = 7; $x <= 23; $x++) {
                    
                    echo "<tr><th>$x:00-$x:30</th>";
                    for ($i = 0; $i < 6; $i++) {
                        echo"<td><a href=\"#\" onclick=\"Aparecer('hid$z')\" ontouchend=\"Aparecer('hid$z')\"><div></div></a>";     
                          CriarBoleia("hid$z");
                          echo "</td>";
                        $z++;
                    }
                    echo "</tr><tr><th>$x:30-" . ($x + 1) . ":00</th>";
                    for ($i = 0; $i < 6; $i++) {
                        echo"<td><a href='#' onclick=\"Aparecer(\"hid$z\")\" ontouchend=\"Aparecer(\"hid$z\")\"><div></div></a>";
                        CriarBoleia("hid$z");
                         echo "</td>";
                        $z++;
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div> 
        </div>
    </body>
</html>