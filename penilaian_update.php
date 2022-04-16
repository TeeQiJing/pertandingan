<?php
    include("sambungan.php");
    include("urusetia_menu.php");

    if(isset($_POST['submit'])){
        $idpenilaian = $_POST['idpenilaian'];
        $aspek = $_POST['aspek'];
        $markahpenuh = $_POST['markahpenuh'];

        $sql = "UPDATE penilaian SET aspek = '$aspek', markahpenuh = '$markahpenuh'
                WHERE idpenilaian = '$idpenilaian'";

        $result = mysqli_query($sambungan, $sql);

        if($result)
            echo "<script>alert('Berjaya kemaskini');</script>";
        else
            echo "<script>alert('Tidak berjaya kemaskini');</script>";
        echo "<script>window.location = 'penilaian_senarai.php';</script>";
    }

    if(isset($_GET['idpenilaian']))
        $idpenilaian = $_GET['idpenilaian'];

    $sql = "SELECT * FROM penilaian WHERE idpenilaian = '$idpenilaian'";
    $result = mysqli_query($sambungan, $sql);
    while($nilai = mysqli_fetch_array($result)){
        $aspek = $nilai['aspek'];
        $markahpenuh = $nilai['markahpenuh'];
    }
    
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3 class="panjang">KEMASKINI PENILAIAN</h3>
<form action="penilaian_update.php" method="post" class="panjang">
    <table>
        <tr>
            <td class="warna">ID Penilaian</td>
            <td><input type="text" name="idpenilaian" value="<?php echo $idpenilaian;?>" readonly></td>
        </tr>
        <tr>
            <td class="warna">Aspek Penilaian</td>
            <td><input type="text" name="aspek" value="<?php echo $aspek;?>"></td>
        </tr>
        <tr>
            <td class="warna">Markah Penuh</td>
            <td><input type="number" style="width: 200px;" name="markahpenuh" min="1" max="40" value="<?php echo $markahpenuh;?>"></td>
        </tr>
    </table>
    <button type="submit" class="update" name="submit">Update</button>
</form>
<br>
<center>
    <button class="biru" onclick="tukar_warna(0)">Biru</button>
    <button class="hijau" onclick="tukar_warna(1)">Hijau</button>
    <button class="merah" onclick="tukar_warna(2)">Merah</button>
    <button class="hitam" onclick="tukar_warna(3)">Hitam</button>
    
</center>

<script>
    function tukar_warna(n){
        var warna = ["Blue", "Green", "Red", "Black"];
        var teks = document.getElementsByClassName("warna");
        for(var i = 0; i < teks.length; i++){
            teks[i].style.color = warna[n];
        }
    }
</script>