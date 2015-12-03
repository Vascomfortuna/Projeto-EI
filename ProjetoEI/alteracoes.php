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
include "./masterpage.php";
    $alteracoes = "select a.descricao,a.dataalteracao,a.nota,u.nome from alteracoes a join utilizadores u on a.idutilizador = u.idutilizador order by a.idalteracao desc limit 100";
    try {
        $result = ligacao($alteracoes);
        if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        $r = "";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {   
?>
        <table class="table table-bordered" style="margin-bottom: 10px; margin-top: 10px;">
            <tr><td width="150px"><b>Data: </b><?php echo $row['dataalteracao'];?></td><td><b> Descrição: </b><?php echo $row['nome'];echo $row['descricao'];?></td></tr>
        </table>
    <?php }
        
    } catch (PDOException $e) {
        die($e);
    }
        }?>
    </body>
</html>

