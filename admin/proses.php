<?php

include('../config.php');
include('../fungsi.php');


if (isset($_POST['submit'])) {
	$jenis = $_POST['jenis'];

	// jumlah kriteria
	if ($jenis == 'kriteria') {
		$n		= getJumlahKriteria();
	}

	// memetakan nilai ke dalam bentuk matrik
	// x = baris
	// y = kolom
	$matrik = array();
	$urut 	= 0;

	for ($x=0; $x <= ($n-2) ; $x++) {
		for ($y=($x+1); $y <= ($n-1) ; $y++) {
			$urut++;
			$pilih	= "pilih".$urut;
			$bobot 	= "bobot".$urut;
			if ($_POST[$pilih] == 1) {
				$matrik[$x][$y] = $_POST[$bobot];
				$matrik[$y][$x] = 1 / $_POST[$bobot];
			} else {
				$matrik[$x][$y] = 1 / $_POST[$bobot];
				$matrik[$y][$x] = $_POST[$bobot];
			}

			
			if ($jenis == 'kriteria') {
				inputDataPerbandinganKriteria($x,$y,$matrik[$x][$y]);
			}
		}
	}

	// diagonal --> bernilai 1
	for ($i = 0; $i <= ($n-1); $i++) {
		$matrik[$i][$i] = 1;
	}

	// inisialisasi jumlah tiap kolom dan baris kriteria
	$jmlmpb = array();
	$jmlmnk = array();
	for ($i=0; $i <= ($n-1); $i++) {
		$jmlmpb[$i] = 0;
		$jmlmnk[$i] = 0;
	}

	// menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
	for ($x=0; $x <= ($n-1) ; $x++) {
		for ($y=0; $y <= ($n-1) ; $y++) {
			$value		= $matrik[$x][$y];
			$jmlmpb[$y] += $value;
		}
	}


	// menghitung jumlah pada baris kriteria tabel nilai kriteria
	// matrikb merupakan matrik yang telah dinormalisasi
	for ($x=0; $x <= ($n-1) ; $x++) {
		for ($y=0; $y <= ($n-1) ; $y++) {
			$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
			$value	= $matrikb[$x][$y];
			$jmlmnk[$x] += $value;
		}

		// nilai priority vektor
		$bobot_prioritas[$x]	 = number_format($jmlmnk[$x] / $n, 5);

		// memasukkan nilai priority vektor ke dalam tabel pv_kriteria

		if ($jenis == 'kriteria') {
			$id_kriteria = getKriteriaID($x);
			inputKriteriaPV($id_kriteria,$bobot_prioritas[$x]);
		}

		// if ($jenis == 'kriteria') {
		// 	$id_pvkriteria = getKriteriaID($x);
		// 	$id_kriteria = $id_pvkriteria;
		// 	if ($id_pvkriteria > 0 & $id_kriteria > 0) {
		// 		$id_pvkriteria == $id_pvkriteria;
		// 		$id_kriteria == $id_pvkriteria;
		// 	}
		// 	inputKriteriaPV($id_pvkriteria, $id_kriteria, $bobot_prioritas[$x]);
		// }
	}

	// cek konsistensi
	$eigenvektor = getEigenVector($jmlmpb,$jmlmnk,$n);
	$consIndex   = getConsIndex($jmlmpb,$jmlmnk,$n);
	$consRatio   = getConsRatio($jmlmpb,$jmlmnk,$n);

	if ($jenis == 'kriteria') {
		include('../admin/output.php');
	} 
}


?>
