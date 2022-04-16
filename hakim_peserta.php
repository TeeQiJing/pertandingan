<?php
    session_start();
    include("sambungan.php");
    include("hakim_menu.php");
?>

<html>
<link rel="stylesheet" href="senarai.css">
<link rel="stylesheet" href="button.css">
<body>
    <table>
        <caption>SENARAI PESERTA MENGIKUT HAKIM</caption>
        <?php
            $nama = $_SESSION['nama'];
            $idhakim = $_SESSION['idpengguna'];

            $kepala = "
            <tr>
                <th>Bil</th>
                <th>Nama</th>
            ";

            $sql = "SELECT * FROM penilaian ORDER BY idpenilaian ASC";

            $data = mysqli_query($sambungan, $sql);

            while($penilaian = mysqli_fetch_array($data)){
                $kepala = $kepala . "<th>" . $penilaian['aspek'] . "</th>";
            }

            $kepala = $kepala . "<th>Jumlah</th></tr>";

            echo $kepala;
            $bil = 1;
            $sql = "SELECT * FROM keputusan
                    JOIN peserta ON keputusan.nokp = peserta.nokp
                    JOIN penilaian ON keputusan.idpenilaian = penilaian.idpenilaian
                    JOIN hakim ON peserta.idhakim = hakim.idhakim
                    WHERE hakim.idhakim = '$idhakim'
                    ORDER BY keputusan.jumlah DESC, penilaian.idpenilaian ASC";

            $data = mysqli_query($sambungan, $sql);
            $a = 1;
            $bil = 1;

            while($keputusan = mysqli_fetch_array($data)){
                if($a == 1) 
                    echo "
                    <tr>
                        <td>" . $bil . "</td>
                        <td>" . $keputusan['namapeserta'] . "</td>
                    ";
                if($a < 6)
                    echo "
                        <td>" . $keputusan['markah'] . "</td>";
                
                $a = $a + 1;

                if($a == 6){
                    echo "
                        <td>" . $keputusan['jumlah'] . "</td>
                    </tr>
                    ";

                    $a = 1;
                    $bil = $bil + 1;
                } // tamat if
            } // tamat while
        ?>
    </table>
    <button class="cetak" onclick="window.print()">Print</button>
</body>
</html>