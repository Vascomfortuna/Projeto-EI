<html>
    <head>
        <meta charset="UTF-8">
        <title>Car Pooling</title>
    </head>
    <body>
       <?php include './masterpage.php';?>
        <div class="container" style="margin-top: 10px;">
            <table class="table table-bordered">
                <tr><th>
                Estatísticas dos utilizadores por mês:</th></tr>              
      <tr><th>  
              <select id="EstUtiNome">
                  <?php echo OptionsMembros();?>
              </select>
              <select id="EstUtiMes">
            <option value="1">Janeiro</option>
            <option value="2">Fevereiro</option>
            <option value="3">Março</option>
            <option value="4">Abril</option>
            <option value="5">Maio</option>
            <option value="6">Junho</option>
            <option value="7">Julho</option>
            <option value="8">Agosto</option>
            <option value="9">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>
        <select id="EstUtiAno">
            <?php 
            $query = "select distinct year(mes) as m from estatisticas;";
            $result=  ligacao($query);
            $r="";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $r.="<option value='".$row['m']."'>".$row['m']."</option>";
        }
        echo $r;
            ?>
        </select>
              <button onclick="ColocarEstatisticaUtilizadorMes(document.getElementById('EstUtiNome').value,document.getElementById('EstUtiMes').value,document.getElementById('EstUtiAno').value,'divUtiMes')">Selecionar</button>
                    </th></tr>
      
                </table>
        </div>
        <div id="divUtiMes" class="container"></div>
    </body>
</html>