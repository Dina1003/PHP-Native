<?php

$con = mysqli_connect("localhost", "root", "", "tadina");

function login($data)
{
    global $con;

    $username = $data['username'];
    $password = (md5($data['pass']));

    $login = mysqli_query($con, "SELECT * FROM login WHERE username = '$username' AND pass = '$password' ");

    return mysqli_affected_rows($con);
}

function query($query)
{

    global $con;

    $data = mysqli_query($con, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($data)) {
        $rows[] = $row;
    }
    return $rows;
}


// mencari ID kriteria
function getKriteriaID($no_urut)
{
    include('config.php');
    $query  = "SELECT id_kriteria FROM kriteria ORDER BY id_kriteria";
    $result = mysqli_query($mysqli, $query);

    while ($row = mysqli_fetch_array($result)) {
        $listID[] = $row['id_kriteria'];
    }

    return $listID[($no_urut)];
}

function getKelasID($no_urut)
{
    include('config.php');
    $query  = "SELECT id_kelas FROM kelas ORDER BY id_kelas";
    $result = mysqli_query($mysqli, $query);

    while ($row = mysqli_fetch_array($result)) {
        $listID[] = $row['id_kelas'];
    }

    return $listID[($no_urut)];
}

// mencari nama kriteria
function getKriteriaNama($no_urut)
{
    include('config.php');
    $query  = "SELECT nama_kriteria FROM kriteria ORDER BY id_kriteria";
    $result = mysqli_query($mysqli, $query);

    while ($row = mysqli_fetch_array($result)) {
        $nama[] = $row['nama_kriteria'];
    }

    return $nama[($no_urut)];
}


// mencari priority vector kriteria
function getKriteriaPV($id_pvkriteria)
{
    include('config.php');
    $query = "SELECT bobot_prioritas FROM pv WHERE id_pvkriteria=$id_pvkriteria";
    $result = mysqli_query($mysqli, $query);
    while ($row = mysqli_fetch_array($result)) {
        $bobot_prioritas = $row['bobot_prioritas'];
    }

    return $pv;
}

// mencari jumlah kriteria
function getJumlahKriteria()
{
    include('config.php');
    $query  = "SELECT count(*) FROM kriteria";
    $result = mysqli_query($mysqli, $query);
    while ($row = mysqli_fetch_array($result)) {
        $jmlData = $row[0];
    }

    return $jmlData;
}

// hapus kriteria
function deleteKriteria($id)
{
    include('config.php');

    // hapus record dari tabel kriteria
    $query     = "DELETE FROM kriteria WHERE id_kriteria=$id";
    mysqli_query($mysqli, $query);

    // hapus record dari tabel pv_kriteria
    $query     = "DELETE FROM pv_kriteria WHERE id_kriteria=$id";
    mysqli_query($mysqli, $query);

    //hapus record dari tabel detil kriteria
    $query     = "DELETE FROM detail_kriteria WHERE id_kriteria=$id";
    mysqli_query($mysqli, $query);
}


// memasukkan nilai priority vektor kriteria
function inputKriteriaPV($id_kriteria, $bobot_prioritas)
{
    include('config.php');

    $query = "SELECT id_kriteria,bobot_prioritas FROM kriteria WHERE id_kriteria=$id_kriteria";
    $result = mysqli_query($mysqli, $query);

    if (!$result) {
        echo "Error !!!";
        exit();
    }

    // jika result kosong maka masukkan data baru
    // jika telah ada maka diupdate
    if (mysqli_num_rows($result) == 0) {

        $query = "INSERT INTO kriteria (id_kriteria, bobot_prioritas) VALUES ($id_kriteria,$bobot_prioritas)";
    } else {
        $query = "UPDATE kriteria SET bobot_prioritas=$bobot_prioritas  WHERE id_kriteria=$id_kriteria";
    }


    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        echo "Gagal memasukkan / update nilai priority vector kriteria";
        exit();
    }
}


// memasukkan bobot nilai perbandingan kriteria
function inputDataPerbandinganKriteria($kriteria1, $kriteria2, $nilai_pembanding)
{
    include('config.php');

    $id_kriteria1 = getKriteriaID($kriteria1);
    $id_kriteria2 = getKriteriaID($kriteria2);

    $query  = "SELECT * FROM perbandingan_kriteria WHERE kriteria1 = $id_kriteria1 AND kriteria2 = $id_kriteria2";
    $result = mysqli_query($mysqli, $query);

    if (!$result) {
        echo "Error !!!";
        exit();
    }

    // jika result kosong maka masukkan data baru
    // jika telah ada maka diupdate
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO perbandingan_kriteria (kriteria1,kriteria2,nilai_pembanding) VALUES ($id_kriteria1,$id_kriteria2,$nilai_pembanding)";
    } else {
        $query = "UPDATE perbandingan_kriteria SET nilai_pembanding=$nilai_pembanding WHERE kriteria1=$id_kriteria1 AND kriteria2=$id_kriteria2";
    }

    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        echo "Gagal memasukkan data perbandingan";
        exit();
    }
}

// mencari nilai bobot perbandingan kriteria
function getNilaiPerbandinganKriteria($kriteria1, $kriteria2)
{
    include('config.php');

    $id_kriteria1 = getKriteriaID($kriteria1);
    $id_kriteria2 = getKriteriaID($kriteria2);

    $query  = "SELECT nilai_pembanding FROM perbandingan_kriteria WHERE kriteria1 = $id_kriteria1 AND kriteria2 = $id_kriteria2";
    $result = mysqli_query($mysqli, $query);

    if (!$result) {
        echo "Error !!!";
        exit();
    }

    if (mysqli_num_rows($result) == 0) {
        $nilai = 1;
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $nilai = $row['nilai_pembanding'];
        }
    }

    return $nilai;
}

// menampilkan nilai IR
function getNilaiIR($jmlKriteria)
{
    include('config.php');
    $query  = "SELECT nilai FROM ir WHERE ri=$jmlKriteria";
    $result = mysqli_query($mysqli, $query);
    while ($row = mysqli_fetch_array($result)) {
        $nilaiIR = $row['nilai'];
    }

    return $nilaiIR;
}

// mencari Principe Eigen Vector (λ maks)
function getEigenVector($matrik_a, $matrik_b, $n)
{
    $eigenvektor = 0;
    for ($i = 0; $i <= ($n - 1); $i++) {
        $eigenvektor += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
    }

    return $eigenvektor;
}

// mencari Cons Index
function getConsIndex($matrik_a, $matrik_b, $n)
{
    $eigenvektor = getEigenVector($matrik_a, $matrik_b, $n);
    $consindex = ($eigenvektor - $n) / ($n - 1);

    return $consindex;
}

// Mencari Consistency Ratio
function getConsRatio($matrik_a, $matrik_b, $n)
{
    $consindex = getConsIndex($matrik_a, $matrik_b, $n);
    $consratio = $consindex / getNilaiIR($n);

    return $consratio;
}

// menampilkan tabel perbandingan bobot
function showTabelPerbandingan($jenis, $kriteria)
{
    include('config.php');

    if ($kriteria == 'kriteria') {
        $n = getJumlahKriteria();
    }

    $query = "SELECT nama_kriteria FROM $kriteria ORDER BY id_kriteria";
    $result    = mysqli_query($mysqli, $query);
    if (!$result) {
        echo "Error koneksi database!!!";
        exit();
    }

    // buat list nama pilihan
    while ($row = mysqli_fetch_array($result)) {
        $pilihan[] = $row['nama_kriteria'];
    }

    // tampilkan tabel
?>

    <form class="ui form" action="proses.php" method="post">
        <table class="perbandingan" style="float: left; margin-right: 50px;">
            <thead>
                <tr>
                    <th> Kriteria 1</th>
                    <th> Kriteria 2</th>
                    <th> Nilai Kepentingan</th>
                </tr>
            </thead>
            <tbody>

                <?php

                //inisialisasi
                $urut = 0;

                for ($x = 0; $x <= ($n - 2); $x++) {
                    for ($y = ($x + 1); $y <= ($n - 1); $y++) {

                        $urut++;

                ?>
                        <tr>
                            <td>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input name="pilih<?php echo $urut ?>" value="1" checked="" class="hidden" type="radio">
                                        <label><?php echo $pilihan[$x]; ?></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input name="pilih<?php echo $urut ?>" value="2" class="hidden" type="radio">
                                        <label><?php echo $pilihan[$y]; ?></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="field">

                                    <?php
                                    if ($kriteria == 'kriteria') {
                                        $nilai = getNilaiPerbandinganKriteria($x, $y);
                                    }
                                    ?>
                                    <input type="text" name="bobot<?php echo $urut ?>" value="<?php echo $nilai ?>" required>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }

                ?>
            </tbody>
        </table>

        <table class="table2">
            <thead>
                <tr>
                    <th> Nilai Pembanding</th>
                    <th> Keterangan Pembanding</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>Setara</td>
                <tr>
                    <td>2</td>
                    <td>Setara menuju cukup diutamakan</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Cukup diutamakan</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Cukup diutamakan menuju diutamakan</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Diutamakan</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Diutamakan menuju lebih diutamakan</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Lebih diutamakan</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Lebih diutamakan menuju sangat diutamakan</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Sangat diutamakan</td>
                </tr>
            </tbody>
        </table>

        <input type="text" name="jenis" value="<?php echo $jenis; ?>" hidden>

        <br><br><input class="action_btn" type="submit" name="submit" value="BANDINGKAN" style="
             text-decoration: none;
             color: black;
             border: 1px solid #da7e1c;
             background: #deb887;
             padding: 5px 15px;
             font-weight: bold;
             border-radius: 3px;
             transition: 0.5s ease-in-out;
             font-size: medium;
            ">
    </form>
<?php
}




//menampilkan alternatif
function tampilalternatif($query)
{

    global $con;

    $data = mysqli_query($con, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($data)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_alternatif($data)
{

    // Sambungkan ke database
    $koneksi = new mysqli("localhost", "root", "", "tadina");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi ke database gagal: " . $koneksi->connect_error);
    }

    global $con;
    $nama_alternatif = $data['nama_alternatif'];
    $c1 = $data['K1'];
    $c2 = $data['K2'];
    $c3 = $data['K3'];
    $c4 = $data['K4'];
    $c5 = $data['K5'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $nama = $_POST['nama_alternatif'];

        // Query untuk memeriksa apakah data sudah ada di database
        $check_query = "SELECT * FROM alternatif WHERE nama = '$nama'";
        $check_result = $koneksi->query($check_query);

        if ($check_result->num_rows > 0) {
            // Jika data sudah ada di database, tampilkan pesan
            echo "<script>
          alert ('Maaf, Data Sudah Tersedia')
          document.location.href='../user/kelola-alternatif.php'
          </script>";
        } else {

            mysqli_query($con, "INSERT INTO alternatif VALUES ('','$nama_alternatif','$c1','$c2','$c3','$c4','$c5') ");

            return mysqli_affected_rows($con);
        }
    }

    // Tutup koneksi database
    $koneksi->close();


    // mysqli_query($con, "INSERT INTO alternatif VALUES ('','$nama_alternatif','$c1','$c2','$c3','$c4','$c5') ");

    // return mysqli_affected_rows($con);
}



function edit_alternatif($data)
{


    global $con;
    $id_alternatif = $_GET['id_alternatif'];
    $nama_alternatif = $data['nama_alternatif'];
    $c1 = $data['K1'];
    $c2 = $data['K2'];
    $c3 = $data['K3'];
    $c4 = $data['K4'];
    $c5 = $data['K5'];

            mysqli_query($con, "UPDATE alternatif SET
            nama = '$nama_alternatif',
            K1 = '$c1',
            K2 = '$c2',
            K3 = '$c3',
            K4 = '$c4',
            K5 = '$c5'
            WHERE id_alternatif = $id_alternatif 
             ");

            return mysqli_affected_rows($con);


    // mysqli_query($con, "UPDATE alternatif SET
    // 				 nama = '$nama_alternatif',
    // 				 K1 = '$c1',
    // 				 K2 = '$c2',
    // 				 K3 = '$c3',
    // 				 K4 = '$c4',
    //                  K5 = '$c5'
    // 				 WHERE id_alternatif = $id_alternatif 
    // 				  ");

    // return mysqli_affected_rows($con);

}



function hapus_alternatif($id_alternatif)
{
    global $con;

    mysqli_query($con, "DELETE FROM detail_keputusan WHERE id_alternatif = '$id_alternatif' ");
    mysqli_query($con, "DELETE FROM alternatif WHERE id_alternatif = '$id_alternatif' ");

    return mysqli_affected_rows($con);
}


function insert_hasil_perankingan($data)
{
	date_default_timezone_set('Asia/Jakarta');
	global $con;

    include('config.php');

	$kode = $data['kode'];
	$id_alternatif = $data['id_alternatif'];
	$nama_alternatif = $data['nama_alternatif'];
	$total_hasil = $data['total_hasil'];
    $kelas =  $data['id_kelas'];

	$tanggal = date('Y-m-d H:i:s');
    
    $input = mysqli_query($con, "INSERT INTO keputusan VALUES('','$kode','$tanggal') ");
    if (!$input) {
        echo mysqli_errno($con) . " - " . mysqli_error($con);
        exit();
    }

    $keputusan = mysqli_query($con, "SELECT id_keputusan FROM keputusan WHERE kode = '$kode' ");
    if (!$keputusan) {
        echo mysqli_errno($con) . " - " . mysqli_error($con);
        exit();
    }
    $row = mysqli_fetch_array($keputusan);
    $id_keputusan = $row['id_keputusan'];

    
    for ($x = 0; $x < count($nama_alternatif); $x++)  
    {
        $id_alternatif_current = $id_alternatif[$x];
        $nama_alternatif_current = $nama_alternatif[$x];
        $total_hasil_current = $total_hasil[$x];
        $id_keputusan_current = $id_keputusan;
        $id_kelas_current =  $kelas[$x];
        
		$insert_detail = mysqli_query($con, "INSERT INTO detail_keputusan VALUES('','$kode','$id_alternatif_current','$nama_alternatif_current','$total_hasil_current', '$id_keputusan_current', '$id_kelas_current') ");
		if (!$insert_detail) {
			echo mysqli_errno($con) . " - " . mysqli_error($con);
			exit();
		}
    }

    return mysqli_affected_rows($con);
}


function hapus_laporan($id_keputusan)
{
    global $con;

    mysqli_query($con, "DELETE FROM keputusan WHERE id_keputusan = '$id_keputusan' ");
    mysqli_query($con, "DELETE FROM detail_keputusan WHERE id_keputusan = '$id_keputusan' ");

    return mysqli_affected_rows($con);
}


?>