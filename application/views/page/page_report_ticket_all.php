<div class="span8">
<form class="form-inline" action="<?=site_url("report_ticket/proses")?>" method="post">
<select name="bulan" class="input-small">
  <?php foreach($getbulan as $key => $val){
    if($key == $bulan){
      echo  "<option selected value='$key'>$val</option>";
    }else{
      echo  "<option value='$key'>$val</option>";
    }
  }
  ?>
 </select>
 <select name="tahun" class="input-small">
    <?php for($i=2015; $i <= (int) date("Y");$i++){
      if($i == $tahun){
        echo "<option selected value='$i'>$i</option>";
      }else{
        echo "<option value='$i'>$i</option>";
      }
    }
    ?>
 </select>
 <button type="submit" class="btn btn-primary">Proses</button>
</form>

<table class="table table-condensed table-hover table-striped">
  <thead>
    <tr>
      <th>TOTAL TIKET</th>
      <th>OPEN TIKET</th>
      <th>CLOSE TIKET</th>
      <th>DEPARTEMENT TIKET</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $ticket_open = array();
      $ticket_close = array();
      foreach ($proses['data'] as $key => $value) {
            $total = $value['open'] + $value['close'];
           echo "<tr>
                <td>$total</td>
                <td>".$value['open']."</td>
                <td>".$value['close']."</td>
                <td>".$key."</td>
                </tr>";
          $ticket_open[] = $value['open'];
          $ticket_close[] = $value['open'];
      }
    ?>
  </tbody>
</table>
<hr>
<h3>Grafik laporan Tiket <?=$proses_departement?></h3>
<canvas id="ctx" width="600" height="400"></canvas>
<div class="chart-legend">
        <ul>
            <li class="rework">Open</li>
            <li class="prod">Close</li>
        </ul>
    </div>
</div>
<script type="text/javascript">
 var charts = document.getElementById('ctx').getContext('2d');
 var data = {
    labels: [<?=$proses['label']?>],
    datasets: [
        {
            label: "Open Ticket",
            fillColor: "rgba(44, 156, 105,1)",
            strokeColor: "rgba(44, 156, 105,0.8)",
            highlightFill: "rgba(44, 156, 105,0.75)",
            highlightStroke: "rgba(44, 156, 105,1)",
            data: [<?=implode(",",$ticket_open)?>]
        },
        {
            label: "Close Ticket",
            fillColor: "rgba(198, 47, 41,1)",
            strokeColor: "rgba(198, 47, 41,0.8)",
            highlightFill: "rgba(198, 47, 41,0.75)",
            highlightStroke: "rgba(198, 47, 41,1)",
            data: [<?=implode(",",$ticket_close)?>]
        },

    ]
};
  var myChart = new Chart(charts).Bar(data);
</script>
<style type="text/css" media="screen">
  .chart-legend ul {
    list-style: none;
    width: 100%;
    margin: 30px auto 0;
}
.chart-legend li {
    text-indent: 25px;
    line-height: 24px;
    position: relative;
    font-weight: bold;
    display: block;
    float: left;
    color:#2B2927 !important;
    width: 20%;
    font-size: 1em;
}
.chart-legend  li:before {
    display: block;
    width: 20px;
    height: 16px;
    position: absolute;
    left: 0;
    top: 3px;
    content: "";
}
.ship:before { background-color: #637b85; }
.rework:before { background-color: #2c9c69; }
.admin:before { background-color: #dbba34; }
.prod:before { background-color: #c62f29; }
</style>
