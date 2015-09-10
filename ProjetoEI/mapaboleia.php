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
              $utilizador=  explode(",",BuscarMembros(),-1);
              date_default_timezone_set("Portugal");
              $startdate = strtotime("Monday");
                if ($startdate > strtotime("today")){
                   $startdate = strtotime("-1 week", $startdate); 
                }
        ?>
        <div class="container" style="float:left; width:12%;">
        <div >
            
            <table class=" table">
                <tr><td><h2>Membros</h2></td></tr>
                <tr>
                    <th>Nome</th>
                </tr>
                    <?php
                    $c=0;
                    for ($i=0;$i<(count($utilizador)/3);$i++){        
                    echo "<tr><td style=\"background-color:".current($utilizador)."\">"
                            . "<div style=\"color:".Contraste(current($utilizador))."\" onclick=\"Aparecer('m$c')\">".next($utilizador)."</div>";
                    CriarContacto(next($utilizador),"m$c");
                    $c++;
                    echo "</td></tr>";
                    next($utilizador);
                    
                    }?>
            </table>

            <button onclick="var x=getCookie('d') - (7 * 24 * 60 * 60);MapaBoleia(x);">Semana Anterior</button>
            <button onclick="var y=Number(getCookie('d')) + (7 * 24 * 60 * 60);MapaBoleia(y);">Semana Seguinte</button>
        </div>
            </div>
        <div class="container" >
            <div class="container" id = "divmapa" style="width:100%; ">
                <script> var d=<?php echo $startdate;?>; MapaBoleia(d);</script>    
        </div> 
        </div>
        <?php } ?>
    </body>
</html>