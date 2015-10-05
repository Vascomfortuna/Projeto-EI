<html>
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
        
        <?php  
        session_start();
        if(!isset($_SESSION['idutilizador'])){
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
        <div class="container" style="float:left; width:12%;margin-top: 10px;">
        <div >
            
            <table class=" table table-bordered" >
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
            <table class="table table-bordered">
                <tr><th><button onclick="f =getCookie('f');x=getCookie('d') - (7 * 24 * 60 * 60);MapaBoleia(x,f);">Semana Anterior</button></th></tr>
            <tr><th><button onclick="f =getCookie('f');x=Number(getCookie('d')) + (7 * 24 * 60 * 60);MapaBoleia(x,f);">Semana Seguinte</button></th></tr>
            <tr><th><button  onclick="y=Number(getCookie('d'));MapaBoleia(y,1);">Mostrar as minhas boleias</button></th></tr>
            <tr><th><button  onclick="y=Number(getCookie('d'));MapaBoleia(y,0);">Mostrar as boleias todas</button></th></tr>
            </table>
        </div>
            </div>
        <div class="container" style="margin-top: 10px;">
            <div class="container" id = "divmapa" style="width:100%; ">
                <script> f = getCookie("f");if(f=="")f=0;d = getCookie("d"); if (d=="")d=<?php echo $startdate;?>; MapaBoleia(d,f);</script>    
        </div> 
        </div>
        <?php } ?>
    </body>
</html>