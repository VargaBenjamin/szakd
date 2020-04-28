<?php
//chartLoads.php
require "db.php";

$titles = array("Súly", "Testzsírszázalék", "Combbőség", "Derékbőség", "Csípőbőség", "Mellbőség", "Vállszélesség", "Karbőség", "12perc / m", "2300m / perc", "Felhúzás max", "Fekvenyomás max", "Gugolás max", "Felhúzás saját", "Fekvenyomás saját", "Gugolás saját" );
$units = array("kg", "%", "cm", "cm", "cm", "cm", "cm", "cm", "m", "p", "kg", "kg", "kg", "db", "db", "db" );

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
  $z = 0;
  $dbRows = count($dates);
  $dbColumns = count($titles);
  for ($x=2; $x < $dbColumns; $x++) {
    for ($y=0; $y < $dbRows; $y++) {
      $datarow[$y] = $output[$y][$x];
    }
    if (isset($datarow)) {
      $r = mt_rand(0,255);
      $g = mt_rand(0,255);
      $b = mt_rand(0,255);
      $charts .= '<div class="col-md-6">
                    <div class="card">
                      <div class="card-header">' . $titles[$z] . '</div>
                      <div class="card-body">
                        <canvas id="' . $z . '"></canvas>
                      </div>
                    </div>
                  </div>
                        <script>
                        var ctx = document.getElementById("' . $z . '").getContext("2d");
                        var myChart = new Chart(ctx, {
                            type: "bar",
                            data: {
                                labels: ' . json_encode($dates) . ',
                                datasets: [{
                                    data: ' . json_encode($datarow) . ',
                                    backgroundColor: "rgba('.$r.','.$g.','.$b.', 0.3)",
                                    barPercentage: 0.5
                                },
                                {
                                    data: ' . json_encode($datarow) . ',
                                    borderColor: "rgba('.$r.','.$g.','.$b.', 1)",
                                    backgroundColor: "rgba('.$r.','.$g.','.$b.', 0.1)",
                                    // fill: false,
                                    type: "line"
                                }
                              ]
                            },
                            options: {
                              legend: {
                                  display: false
                                },
                                tooltips: {
                                  callbacks: {
                                    label: function(tooltipItem) {
                                    // console.log(tooltipItem)
                                      return tooltipItem.yLabel;
                                    }
                                  }
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: false,
                                            callback: function(value, index, values) {
                                                return value + " ' . $units[$z] . '";
                                            }
                                        }
                                    }]
                                }
                            }
                        });
                        </script>
                        ';
    }
  $z++;
  }
  if ($charts == "") {
    echo 'Sajnos nincs mit megjeleníteni.. Vigyél fel eredményt a "Napló"-ban!';
  }
  else {
    echo $charts;
  }
}
$con->close();
?>
