<html>
    <head>
        <meta charset="UTF-8">
        <script>
            function teste(){
                x = '<?php echo "lol";?>';
                document.getElementById("div").innerHTML=x;
            }
        </script>
    </head>
    <body>
        <?php include './masterpage.php'; 
              $utilizador=  split(",",BuscarMembros());
              $startdate = strtotime("Monday");
                if ($startdate > strtotime("today")){
                   $startdate = strtotime("-1 week", $startdate); 
                }
        ?>
        <div class="container" style="width:15%; float:left">
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
        <div class="container">
            <div class="container" id = "divmapa" style="width:100%; float:left">
                <script>mapaBoleia();</script>    
        </div> 
        </div>
    </body>
</html>