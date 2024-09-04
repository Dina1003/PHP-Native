<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../style/style.css">
	<title>SPK TA</title>
</head>

<body>
	<?php

	include('../header.php');
	?>

	<script>
		function toggleTable() {
			var tableB = document.getElementById("tableB");
			var nextButton = document.getElementById("nextButton");
			var button1 = document.getElementById("nextButton1");
			var judul = document.getElementById("judul");

			if (tableB.style.display === "none") {
				judul.style.display = "block";
				tableB.style.display = "table";
				button1.style.display = "inline-block"; // Menampilkan button1
				nextButton.style.display = "none"
			} else {
				tableB.style.display = "none";
				button1.style.display = "none"; // Menyembunyikan button1
				// nextButton.textContent = "Next";
				nextButton.style.display = "none"
			}
		}

		function toggleTable1() {
			var tableB = document.getElementById("konsistensi");
			var nextButton = document.getElementById("nextButton1");
			var button2 = document.getElementById("nextButton2");
			var judul = document.getElementById("judul1");

			if (tableB.style.display === "none") {
				judul.style.display = "block";
				tableB.style.display = "table";;
				button2.style.display = "inline-block"; // Menampilkan button2
				nextButton.style.display = "none"
			} else {
				tableB.style.display = "none";
				nextButton.style.display = "none"
			}
		}

		function toggleTable2() {
			var tableC = document.getElementById("hasil");
			var nextButton = document.getElementById("nextButton2");


			if (tableC.style.display === "none") {
				tableC.style.display = "block";
				// nextButton.textContent = "Previous";
				nextButton.style.display = "none"
			} else {
				tableC.style.display = "none";
				// nextButton.textContent = "Next";
				nextButton.style.display = "none"
			}
		}
	</script>


	<div class="isi">
		<a href="../admin/kelola-kriteria.php">Kriteria</a>
		<a href="../admin/kelola-subkriteria.php">/ Sub-Kriteria</a>
		<a href="../admin/perbandingan-bobot-kriteria.php">/ Nilai Perbandingan Kepentingan Kriteria</a>

		<section class="content">
			<h3 class="ui header">Matriks Perbandingan Berpasangan</h3>
			<table class="ui collapsing celled blue table">
				<thead>
					<tr>
						<th>Kriteria</th>
						<?php
						for ($i = 0; $i <= ($n - 1); $i++) {
							echo "<th>" . getKriteriaNama($i) . "</th>";
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					include('../config.php');
					$result = $mysqli->query("SELECT * FROM `kriteria`");
					if (!$result) {
						echo $mysqli->connect_errno . " gagal cuk.. sabar " . $mysqli->connect_error;
						exit();
					}

					for ($x = 0; $x <= ($n - 1); $x++) {
						echo "<tr>";
						echo "<td>" . getKriteriaNama($x) . "</td>";
						for ($y = 0; $y <= ($n - 1); $y++) {
							echo "<td>" . number_format($matrik[$x][$y], 5) . "</td>";
						}

						echo "</tr>";
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>Jumlah</th>
						<?php
						for ($i = 0; $i <= ($n - 1); $i++) {
							echo "<th>" . number_format($jmlmpb[$i], 5) . "</th>";
						}
						?>
					</tr>
				</tfoot>
			</table>


			<br>

			<button id="nextButton" onclick="toggleTable()">Next</button>

			<h3 class="ui header" id="judul" style="display:none;">Matriks Nilai Kriteria</h3>
			<table class="ui celled red table" id="tableB" style="display:none;">
				<thead>
					<tr>
						<th>Kriteria</th>
						<?php
						for ($i = 0; $i <= ($n - 1); $i++) {
							echo "<th>" . getKriteriaNama($i) . "</th>";
						}
						?>
						<th>Jumlah</th>
						<th>Priority Vector</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($x = 0; $x <= ($n - 1); $x++) {
						echo "<tr>";
						echo "<td>" . getKriteriaNama($x) . "</td>";
						for ($y = 0; $y <= ($n - 1); $y++) {
							echo "<td>" . number_format($matrikb[$x][$y], 5) . "</td>";
						}

						echo "<td>" . number_format($jmlmnk[$x], 5) . "</td>";
						echo "<td>" . number_format($bobot_prioritas[$x], 5) . "</td>";

						echo "</tr>";
					}
					?>

				</tbody>
			</table>
			<!-- <tfoot>
				<tr>
				<th colspan="<?php echo ($n + 2) ?>">Principe Eigen Vector (λ maks)</th>
				<th><?php echo (number_format($eigenvektor, 5)) ?></th>
			</tr>
				<tr>
					<th colspan="<?php echo ($n + 2) ?>">Consistency Index</th>
					<th><?php echo (number_format($consIndex, 5)) ?></th>
				</tr>
				<tr>
					<th colspan="<?php echo ($n + 2) ?>">Consistency Ratio</th>
					<th><?php echo (round(($consRatio * 100))) ?> %</th>
				</tr>
			</tfoot> -->


			<br><button id="nextButton1" style="display:none;" onclick="toggleTable1()">Next</button>
			<br>
			<h3 class="ui header" id="judul1" style="display:none;">Nilai Konsistensi</h3>
			<table class="ui celled red table" id="konsistensi" style="display:none;">
				<tr>
					<th colspan="<?php echo ($n + 2) ?>">Consistency Index</th>
					<th><?php echo (number_format($consIndex, 5)) ?></th>
				</tr>
				<tr>
					<th colspan="<?php echo ($n + 2) ?>">Consistency Ratio</th>
					<th><?php echo (round(($consRatio * 100))) ?> %</th>
				</tr>

			</table>

			<br><button id="nextButton2" style="display:none;" onclick="toggleTable2()">Next</button>

			<div id="hasil" style="display:none;">
				<?php
				if ($consRatio > 0.1) {
				?>
					<div class="ui icon red message">
						<i class="close icon"></i>
						<i class="warning circle icon"></i>
						<div class="content">
							<div class="header">
								Nilai Consistency Ratio melebihi 10% !!!
							</div>
							<p>Mohon input kembali tabel perbandingan...</p>
						</div>
					</div>

					<br>
				<?php
				} else {
				?>
				<p>Nilai Consistency Ratio Kecil Dari 10% ! Perhitungan Selesai !</p><br>
					<a href="../admin/kelola-kriteria.php">
						<button class="action_btn" style="
			margin-bottom: 10px;
             text-decoration: none;
             color: black;
             border: 1px solid #da7e1c;
             background: #deb887;
             padding: 5px 15px;
             font-weight: bold;
             border-radius: 3px;
             transition: 0.5s ease-in-out;
             font-size: medium;
            ">Selesai</button>
					</a>

				<?php
				}
				echo "</section>";
				?>
			</div>