<html>
<link rel="stylesheet" href="senarai.css">
<link rel="stylesheet" href="button.css">
<body>
    <table>
        <?php
            include("sambungan.php");
            include("urusetia_menu.php");

            $pilihan = $_POST["pilihan"];
            $kepala = "
                <tr>
                    <th>Bil</th>
                    <th>Nama</th>
            ";

            $sql = "SELECT * FROM penilaian ORDER BY idpenilaian ASC";
            $data = mysqli_query($sambungan, $sql);

            while($penilaian = mysqli_fetch_array($data)){
                $kepala = $kepala."<th>" . $penilaian['aspek'] . "</th>";
            }
            $kepala = $kepala . "<th>Jumlah</th></tr>";

            switch($pilihan){
                case 1 : 
                    $syarat = " ";
                    $tajuk = "<caption>SENARAI MARKAH KESELURUHAN</caption>";
                    break;
                case 2 :
                    $idhakim = $_POST['idhakim'];
                    $syarat = "WHERE hakim.idhakim = '$idhakim'";
                    $tajuk = "<caption>SENARAI PESERTA MENGIKUT HAKIM</caption>";
                    break;
            } // tamat switch

            echo $kepala;
            $bil = 1;
            $sql = "SELECT * FROM keputusan
                    JOIN peserta ON keputusan.nokp = peserta.nokp
                    JOIN penilaian ON keputusan.idpenilaian = penilaian.idpenilaian
                    JOIN hakim ON peserta.idhakim = hakim.idhakim $syarat
                    ORDER BY keputusan.jumlah DESC, penilaian.idpenilaian ASC";

            $data = mysqli_query($sambungan, $sql);
            $a = 1;
            $bil = 1;

            while($keputusan = mysqli_fetch_array($data)){
                if($a == 1)
                    echo "
                        <tr>
                            <td>" . $bil . "</td>
                            <td class='nama'>" . $keputusan['namapeserta'] . "</td>
                    ";
                if($a < 6)
                    echo "<td>" . $keputusan['markah'] . "</td>";
                
                $a = $a + 1;
                if($a == 6){ 
                    echo "<td>" . $keputusan['jumlah'] . "</td></tr>";
                    $a = 1;
                    $bil = $bil + 1;
                } // tamat if
            } // tamat while

        ?>
        <caption><?php echo $tajuk;?></caption>
    </table>
    <center><button class="cetak" onclick="window.print()">Cetak</button></center>
</body>
</html>