
<script>
    function Aparecer(id){
        h=document.getElementById(id);
        
        if(h.getAttribute("hidden")===null){
            h.setAttribute("hidden","");
        }else if(h.getAttribute("hidden")===""){
            h.removeAttribute("hidden");
        }
        
    }
</script>

<?php
    function CriarBoleia($id){
        echo "<div  id=\"$id\" class=\"criarboleia container\" hidden >
                <table>
                    <tr><td>Condutor:</td><td>
                    <select>
                    <option>João</option>
                    </select></td></tr>
                    <tr><td>Destino:</td><td>
                    <input type='text' style='width:95%'/></td></tr>
                    <tr><td><button>OK</button></td><td><button onclick=Aparecer('$id')>Fechar</button></td></tr>
                </table>
              </div>";
    }
    
function ligacao($query){
$ligacao = mysql_connect("localhost", "root", "");
if (!$ligacao) {
    die("nao foi possivel ligar:" . mysql_error());
}
mysql_select_db("mydb");
$result = mysql_query($query, $ligacao);
return $result;
}

function BuscarMembros(){
    $bmembros= "select nome,cor from utilizadores";
    try {
    $result = ligacao($bmembros);
    if (!$result) {
        echo "<br/>Ocorreu um erro na query<br/>";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    $r="";
    while ($row = mysql_fetch_assoc($result)) {
        //echo "<br/>" . $row['Id_Login'] . ", " . $row['Nome'];
        $r.=$row['cor'].",".$row['nome'].",";
    }  
    return $r;
} catch (PDOException $e) {
    die($e);
}
}
    


