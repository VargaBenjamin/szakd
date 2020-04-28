<?php
//chartLoads.php
require "db.php";

$titles = array("Súly", "Testzsírszázalék", "Combbőség", "Derékbőség", "Csípőbőség", "Mellbőség", "Vállszélesség", "Karbőség", "12perc / m", "2300m / perc", "Felhúzás max", "Fekvenyomás max", "Gugolás max", "Felhúzás saját", "Fekvenyomás saját", "Gugolás saját" );
$units = array("kg", "%", "cm", "cm", "cm", "cm", "cm", "cm", "m", "p", "kg", "kg", "kg", "db", "db", "db" );



  if ($stmt = $con->prepare('SELECT selected, day FROM charts WHERE userid = ?'))
  {
    $stmt->bind_param('i', $_SESSION["id"]);
    $stmt->execute();
    $stmt->bind_result($selected, $day);
    $stmt->fetch();
    $select = explode(",", $selected);
    $stmt->close();
    if ($stmt = $con->prepare('SELECT * FROM workoutdata WHERE clientid = ? ORDER BY datum ASC LIMIT ?'))
    {
      $stmt->bind_param('ii', $_SESSION["id"], $day);
      $stmt->execute();
      $result = $stmt->get_result();
    	$output = array();
      $dates = array();
      $charts = "";
      while ($row = $result->fetch_row()) {
    	  $output[] = $row;
        array_push($dates, $row[1]);
      }
      $dbRows = count($dates);
      for ($i=0; $i < count($select); $i++) {
        $act = $select[$i];
        for ($y=0; $y < $dbRows; $y++) {
          $datarow[$y] = $output[$y][$act+2]; //mivel az output (teljes táblázat phpmyadminból) első 2 oszlopának értékei nem kellenek.
        }
        if (isset($datarow)) {
          $r = mt_rand(0,255);
          $g = mt_rand(0,255);
          $b = mt_rand(0,255);
          $charts .=
          '<div class="col-xl-6">
            <div class="card-header bg-success">' . $titles[$act] . '</div>
            <div class="card">
              <div class="card-body"><canvas id="' . $act . '"></canvas></div>
            </div>
          </div>
              <script>
              var ctx = document.getElementById("' . $act . '").getContext("2d");
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
                                      return value + " ' . $units[$act] . '";
                                  }
                              }
                          }]
                      }
                  }
              });
              </script>';
        }
      }
      echo $charts;
    }
  }



$con->close();
?>
