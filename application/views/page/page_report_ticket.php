<div class="span8">
<form class="form-inline" action="" method="post">
  <select name="departement_id" class="input-small span3">
  <?php foreach ($departement as $list) {
    if($dept_id == $list['departement_id'] ){
      echo "<option selected value=\" $list[departement_id]\">$list[departement_name]</option>";
    }else{
      echo "<option value=\" $list[departement_id]\">$list[departement_name]</option>";
    }

  } ?>
 </select>
<select name="bulan" class="input-small">
  <?php foreach($getbulan as $key => $val){
    if($key == $bulan){
      echo  "<option selected value='$key'>$value</option>";
    }else{
      echo  "<option value='$key'>$value</option>";
    }
  }
  ?>
 </select>
 <select name="tahun" class="input-small">
    <?php for($i=2015; $i <= (int) date("Y");$i++){
      if($i == $tahun){
        echo "<option selected value='$i'>'$i'</option>";
      }else{
        echo "<option value='$i'>'$i'</option>";
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
    <tr>
      <td><?=$jml_open + $jml_close ?></td>
      <td><?=$jml_open ?></td>
      <td><?=$jml_close ?></td>
    </tr>
  </tbody>
</table>
<hr>
<h3>Grafik Laporan Tiket</h3>
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
    labels: ["KRIMINAL"],
    datasets: [
        {
            label: "Open Ticket",
            fillColor: "rgba(44, 156, 105,1)",
            strokeColor: "rgba(44, 156, 105,0.8)",
            highlightFill: "rgba(44, 156, 105,0.75)",
            highlightStroke: "rgba(44, 156, 105,1)",
            data: [0, 0, 0, 0]
        },
        {
            label: "Close Ticket",
            fillColor: "rgba(198, 47, 41,1)",
            strokeColor: "rgba(198, 47, 41,0.8)",
            highlightFill: "rgba(198, 47, 41,0.75)",
            highlightStroke: "rgba(198, 47, 41,1)",
            data: [0, 0, 0, 0]
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
