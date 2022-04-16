<?php
    session_start();
    include("sambungan.php");
    include("peserta_menu.php");

    $nama = $_SESSION['nama'];
    $nokp = $_SESSION['idpengguna'];

    $kedudukan = 0;
    $sql = "SELECT * FROM keputusan 
            JOIN peserta ON keputusan.nokp = peserta.nokp
            JOIN penilaian ON keputusan.idpenilaian = penilaian.idpenilaian
            JOIN hakim ON peserta.idhakim = hakim.idhakim
            GROUP BY peserta.nokp ORDER BY keputusan.jumlah DESC";
    
    $data = mysqli_query($sambungan, $sql);
    $bil = 0;
    while($keputusan = mysqli_fetch_array($data)){
        $bil = $bil + 1;
        if($keputusan['nokp'] == $nokp)
            $kedudukan = $bil;
    } // tamat while
?>

<link rel="stylesheet" href="senarai.css">
<table>
    <caption>Nama Peserta : <?php echo $nama;?></caption>
    <tr>
        <th>Aspek Penilaian</th>
        <th>Markah Penuh</th>
        <th>Markah Diperoleh</th>
    </tr>
    <?php
        $sql = "SELECT * FROM keputusan
                JOIN penilaian ON keputusan.idpenilaian = penilaian.idpenilaian
                WHERE nokp = '$nokp'";
        $data = mysqli_query($sambungan, $sql);
        $bilrekod = mysqli_num_rows($data);

        if($bilrekod > 0){
            while($keputusan = mysqli_fetch_array($data)){
                echo"
                    <tr>
                        <td>$keputusan[aspek]</td>
                        <td>$keputusan[markahpenuh]</td>
                        <td>$keputusan[markah]</td>
                    </tr>
                ";
                $jumlah_markah = $keputusan['jumlah'];
            }
            echo "
                <tr class='markah_jumlah'>
                    <td></td>
                    <td class='markah_jumlah'>Kedudukan</td>
                    <td>$kedudukan/$bil</td>                    
                </tr>
                </table>
            ";
        } // tamat if
        else {
            echo "
                <tr>
                    <td>markah</td>
                    <td>belum</td>
                    <td>dinilai</td>
                </tr>
                </table>";
        } // tamat else
    ?>
</table>