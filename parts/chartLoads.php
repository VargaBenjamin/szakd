<?php
//chartLoads.php
require "db.php";

$titles = array("Súly", "Testzsírszázalék", "Combbőség", "Derékbőség", "Csípőbőség", "Mellbőség", "Vállszélesség", "Karbőség", "12perc / m", "2300m / perc", "Felhúzás max", "Fekvenyomás max", "Gugolás max", "Felhúzás saját", "Fekvenyomás saját", "Gugolás saját" );
$units = array("ID", "Dátum", "kg", "%", "cm", "cm", "cm", "cm", "cm", "cm", "m", "p", "kg", "kg", "kg", "db", "db", "db" );

if ($stmt = $con->prepare('SELECT * FROM workoutdata WHERE clientid = "' . $_SESSION["id"]  . '" ORDER BY datum ASC LIMIT 30'))
{
  $stmt->execute();
  $result = $stmt->get_result();
	$output = array();
  $dates = array();
  $charts ="";
  while ($row = $result->fetch_row()) {
	  $output[] = $row;
    array_push($dates, $row[1]);
  }
  $z = -1;
  for ($x=2; $x < count($titles); $x++) {
    $z++;
    for ($y=0; $y < count($dates); $y++) {
      $datarow[$y] = $output[$y][$x];
    }
    $r = mt_rand(0,255);
    $g = mt_rand(0,255);
    $b = mt_rand(0,255);
    $charts .= '<div class="col-md-6">
                  <div class="card">
                    <div class="card-header">' . $titles[$x-2] . '</div>
                    <div class="card-body">
                      <canvas id="' . $z . '"></canvas>
                    </div>
                  </div>
                </div>
                      <script>
                      var ctx = document.getElementById("' . $z . '").getContext("2d");
                      var myChart = new Chart(ctx, {
                          type: "line",
                          data: {
                              labels: ' . json_encode($dates) . ',
                              datasets: [{
                                  label: "# of Votes",
                                  data: ' . json_encode($datarow) . ',
                                  backgroundColor: ["rgba('.$r.','.$g.','.$b.', 0.4)"],
                                  borderColor: [ "rgba('.$r.','.$g.','.$b.', 1)"],
                                  borderWidth: 3
                              }]
                          },
                          options: {
                              scales: {
                                  yAxes: [{
                                      ticks: {
                                          beginAtZero: false
                                      }
                                  }]
                              }
                          }
                      });
                      </script>
                      ';
  }
  echo $charts;
}
if ($stmt) {
	$stmt->close();
}
$con->close();
?>
