<html>
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
<?php
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
            <tr><td><b>Data: </b><?php echo $row['dataalteracao'];?></td><td><b>Nome: </b><?php echo $row['nome'];?></td></tr>
            <tr><td colspan="2"><b>Descrição: </b><?php echo $row['descricao'];?></td></tr>
        </table>
    <?php }
        
    } catch (PDOException $e) {
        die($e);
    }?>
    </body>
</html>
