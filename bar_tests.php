<?php
include('koneksi_covid.php');
$data = mysqli_query($koneksi,"select * from tb_covid");
while($row = mysqli_fetch_array($data)){
	$country[] = $row['country'];
	$query = mysqli_query($koneksi,"select total_tests from tb_covid where id='".$row['id']."'");
	$row = $query->fetch_array();
	$total_tests[] = $row['total_tests'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Grafik Data 10 Negara Asia Covid-19</title>
<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>
	<script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?php echo json_encode($country); ?>,
			datasets: [{
				label: 'total_tests',
				data: <?php echo json_encode($total_tests);

			?>,

			backgroundColor: 'rgba(153, 102, 255, 0.2)',
			borderColor: 'rgba(153, 102, 255, 1)',
			borderWidth: 1
			}]
		},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
	});
	</script>
</body>
</html>