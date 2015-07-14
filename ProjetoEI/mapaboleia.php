<html>
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
        
        <?php  
       
        if(isset($_SESSION['idutilizador'])){
            include './login.php';
        }else{
              include './masterpage.php';
              $utilizador=  split(",",BuscarMembros());
              date_default_timezone_set("Portugal");
              $startdate = strtotime("Monday");
                if ($startdate > strtotime("today")){
                   $startdate = strtotime("-1 week", $startdate); 
                }
        ?>
        <div class="container" style="float:left; width:12%;">
        <div class="menumapa">
            <h2>Membros</h2>
            <table class="table">
                <tr>
                    <th>Nome</th>
                </tr>
                    <?php
                    for ($i=0;$i<(count($utilizador)/2);$i++){        
                    echo "<tr><td style=\"background-color:".current($utilizador)."\">"
                            . "<a onclick=\"teste();\" href=\"#\">".utf8_encode (next($utilizador))."</a></td></tr>";
                    next($utilizador);
                    }?>
            </table>
        </div>
        
        <div class=" menumapa" >
            <button onclick="var x=getCookie('d') - (7 * 24 * 60 * 60);MapaBoleia(x);">Semana Anterior</button>
            <button onclick="var y=Number(getCookie('d')) + (7 * 24 * 60 * 60);MapaBoleia(y);">Semana Seguinte</button>
        </div>
            </div>
        <div class="container">
            <div class="container" id = "divmapa" style="width:100%; ">
                <script> var d=<?php echo $startdate;?>; MapaBoleia(d);</script>    
        </div> 
        </div>
        <?php } ?>
    </body>
</html>