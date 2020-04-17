<?php
//chartLoads.php
require "db.php";

if ($stmt = $con->prepare('SELECT id, type, title FROM charts'))
{
  $stmt->execute();
  $result = $stmt->get_result();
	$output = '';
  while ($row = $result->fetch_assoc()) {
	  $output.=
		'<div class="col-md-6">
      <div class="card">
        <div class="card-header">' . $row["title"] . '</div>
        <div class="card-body">
          <canvas id="' . $row["id"] . '"></canvas>
        </div>
      </div>
    </div>
    <script>
    var ctx = document.getElementById("' . $row["id"] . '").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "' . $row["type"] . '",
        data: {
            labels: ["yxvdg", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
              label: " of Votes",
              data: [12, 19, 3, 5, 2, 3],
              backgroundColor: [
                  "rgba(255, 99, 132, 0.2)",
                  "rgba(54, 162, 235, 0.2)",
                  "rgba(255, 206, 86, 0.2)",
                  "rgba(75, 192, 192, 0.2)",
                  "rgba(153, 102, 255, 0.2)",
                  "rgba(255, 159, 64, 0.2)"
              ],
              borderColor: [
                  "rgba(255, 99, 132, 1)",
                  "rgba(54, 162, 235, 1)",
                  "rgba(255, 206, 86, 1)",
                  "rgba(75, 192, 192, 1)",
                  "rgba(153, 102, 255, 1)",
                  "rgba(255, 159, 64, 1)"
              ],
              borderWidth: 1
              }]
              },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
    ';
  }
	echo $output;
}
if ($stmt) {
	$stmt->close();
}
$con->close();
?>
