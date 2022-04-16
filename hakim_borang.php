<?php
    session_start();
    include("sambungan.php");
    include("hakim_menu.php");
    $nama = $_SESSION['nama'];
    $idhakim = $_SESSION['idpengguna'];
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<div class="kandungan">
    <h3 class="markah">BORANG PEMARKAHAN</h3>
    <form action="hakim_borang2.php" method="post" class="markah">
        <table>
            <tr>
                <td>Nama Hakim : </td>
                <td><?php echo $nama; ?></td>
            </tr>
            <tr>
                <td>Peserta</td>
                <td>
                    <select name="nokp" class="markah">
                        <?php
                            $sql = "SELECT * FROM peserta WHERE idhakim = '$idhakim'";
                            $data = mysqli_query($sambungan, $sql);

                            while($peserta = mysqli_fetch_array($data)){
                                echo "<option value='$peserta[nokp]'>$peserta[namapeserta]</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
        </table>

        <table class="markah">
            <tr>
                <th>Aspek Penilaian</th>
                <th>Markah Penuh</th>
                <th>Markah Diperoleh</th>
            </tr>
            <?php
                $sql = "SELECT * FROM penilaian";
                $data = mysqli_query($sambungan, $sql);

                while($penilaian = mysqli_fetch_array($data)){
                    echo"
                    <tr>
                        <td>$penilaian[aspek]</td>
                        <td>$penilaian[markahpenuh]</td>
                        <td><input oninput='kira_jumlah()' class='markah' type='text' 
                            id='$penilaian[idpenilaian]' name='$penilaian[idpenilaian]' value=0></td>
                    </tr>
                    ";
                } // tamat while
            ?>

            <tr class="markah_jumlah">
                <td></td>
                <td class="markah_jumlah">Jumlah Markah</td>
                <td><input type="text" class="markah" id="jumlah_markah" name="jumlah_markah"></td>
            </tr>
        </table>
        <button type="submit" class="tambah" name="submit">Tambah</button>
    </form>
</div>

<script type="text/javascript">
    function kira_jumlah(){
        var jum_semua = 0;

        <?php
            $sql = "SELECT * FROM penilaian";
            $data = mysqli_query($sambungan, $sql);

            while($penilaian = mysqli_fetch_array($data)){
                echo "
                    var markah = parseInt(document.getElementById('$penilaian[idpenilaian]').value);
                    jum_semua = jum_semua + markah;
                ";
            } // tamat while
        ?>
        document.getElementById("jumlah_markah").value = jum_semua;
    } // tamat function
</script>