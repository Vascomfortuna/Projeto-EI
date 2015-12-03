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
              $nPara = 5;
              $utilizador=  explode(",",BuscarMembros(),-1);
              $leng = (count($utilizador)/$nPara);
              date_default_timezone_set("Portugal");
              $startdate = strtotime("Monday");
                if ($startdate > strtotime("today")){
                   $startdate = strtotime("-1 week", $startdate); 
                }
        ?>
        <div class="container" style="width:100%">
        <div class="row " >
        <div  class="col-xs-12 col-sm-12 col-md-2" style="float:left; margin-top: 10px;">
            <div id="membrosMapaBoleia">
            <table class=" table table-bordered" style ="width:100%;">
                <tr><td><h2>Membros</h2></td></tr>
                <tr>
                    <th>Nome</th>
                </tr>
                    <?php
                    $c=0;
                    for ($i=0;$i<$leng;$i++){        
                    echo "<tr><td style=\"background-color:".$utilizador[($nPara*$i)]."\">"
                            . "<div style=\"color:".Contraste($utilizador[($nPara*$i)])."\" onclick=\"Aparecer('m$c')\">".
                            $utilizador[($nPara*$i)+3].": ".$utilizador[($nPara*$i)+1]."</br>Número:".$utilizador[($nPara*$i)+4]."</div>";
                    CriarContacto($utilizador[($nPara*$i)+2],"m$c");
                    $c++;
                    echo "</td></tr>";
                    }?>
            </table>
            </div>
            <div>
            <table class="table table-bordered" style ="width:100%;">
                <tr><th><button style ="width:31%;" onclick="f =getCookie('f');x=getCookie('d') - (7 * 24 * 60 * 60);MapaBoleia(x,f);"><</button>
            <button  style ="width:31%;" onclick="f =getCookie('f');x=<?php echo $startdate;?>;MapaBoleia(x,f);">Hoje</button>
            <button style ="width:31%;" onclick="f =getCookie('f');x=Number(getCookie('d')) + (7 * 24 * 60 * 60);MapaBoleia(x,f);">></button>
             </th></tr>
            <tr><th><button  style ="width:100%;" onclick="y=Number(getCookie('d'));MapaBoleia(y,1);">Mostrar as minhas boleias</button></th></tr>
            <tr><th><button style ="width:100%;" onclick="y=Number(getCookie('d'));MapaBoleia(y,0);">Mostrar as boleias todas</button></th></tr>
            <tr><td id="filtro"></td></tr>
            </table>
            </div>
            </div>
            
            <div class=" col-xs-11 col-sm-12 col-md-9" id ="divmapa" style="float:right; margin:10px; ">
                <script> f = getCookie("f");if(f=="")f=0;d = getCookie("d"); if (d=="")d=<?php echo $startdate;?>; MapaBoleia(d,f);</script>    
                </div>
        </div>
        </div>    
        <?php } ?>
    </body>
</html>