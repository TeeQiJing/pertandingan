<?php
    include("sambungan.php");
    include("urusetia_menu.php");

    if(isset($_POST['submit'])){
        $nokp = $_POST['nokp'];
        $namapeserta = $_POST['namapeserta'];
        $password = $_POST['password'];
        $telefon = $_POST['telefon'];
        $idhakim = $_POST['idhakim'];
        $idurusetia = $_POST['idurusetia'];

        $sql = "UPDATE peserta SET namapeserta = '$namapeserta', password = '$password', 
                telefon = '$telefon', idhakim = '$idhakim', idurusetia = '$idurusetia'
                WHERE nokp = '$nokp'";

        $result = mysqli_query($sambungan, $sql);

        if($result)
            echo "<script>alert('Berjaya kemaskini');</script>";
        else
            echo "<script>alert('Tidak berjaya kemaskini');</script>";
        echo "<script>window.location = 'peserta_senarai.php';</script>";
    }

    if(isset($_GET['nokp']))
        $nokp = $_GET['nokp'];

    $sql = "SELECT * FROM peserta WHERE nokp = '$nokp'";
    $result = mysqli_query($sambungan, $sql);
    while($peserta = mysqli_fetch_array($result)){
        $password = $peserta['password'];
        $namapeserta = $peserta['namapeserta'];
        $telefon = $peserta['telefon'];
        $idhakim = $peserta['idhakim'];
        $idurusetia = $peserta['idurusetia'];
    }
    
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3 class="panjang">KEMASKINI PESERTA</h3>
<form action="peserta_update.php" method="post" class="panjang">
    <table>
        <tr>
            <td class="warna">No KP</td>
            <td><input type="text" name="nokp" value="<?php echo $nokp;?>" readonly></td>
        </tr>
        <tr>
            <td class="warna">Nama Peserta</td>
            <td><input type="text" name="namapeserta" value="<?php echo $namapeserta;?>"></td>
        </tr>
        <tr>
            <td class="warna">No Telefon</td>
            <td><input type="text" name="telefon" value="<?php echo $telefon;?>"></td>
        </tr>
        <tr>
            <td class="warna">Password</td>
            <td><input type="text" name="password" value="<?php echo $password;?>"></td>
        </tr>
        <tr>
            <td class="warna">IDHakim</td>
            <td><input type="text" name="idhakim" value="<?php echo $idhakim;?>"></td>
        </tr>
        <tr>
            <td class="warna">IDUrusetia</td>
            <td><input type="text" name="idurusetia" value="<?php echo $idurusetia;?>"></td>
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