<?php
    include("sambungan.php");
    include("urusetia_menu.php");

    if(isset($_POST['submit'])){
        $idhakim = $_POST['idhakim'];
        $namahakim = $_POST['namahakim'];
        $password = $_POST['password'];

        $sql = "UPDATE hakim SET namahakim = '$namahakim', password = '$password' 
        WHERE idhakim = '$idhakim'";

        $result = mysqli_query($sambungan, $sql);

        if($result)
            echo "<script>alert('Berjaya kemaskini');</script>";
        else
            echo "<script>alert('Tidak berjaya kemaskini');</script>";
        echo "<script>window.location = 'hakim_senarai.php';</script>";
    }

    if(isset($_GET['idhakim']))
        $idhakim = $_GET['idhakim'];

    $sql = "SELECT * FROM hakim WHERE idhakim = '$idhakim'";
    $result = mysqli_query($sambungan, $sql);
    while($hakim = mysqli_fetch_array($result)){
        $password = $hakim['password'];
        $namahakim = $hakim['namahakim'];
    }
    
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3 class="panjang">KEMASKINI HAKIM</h3>
<form action="hakim_update.php" method="post" class="panjang">
    <table>
        <tr>
            <td class="warna">ID Hakim</td>
            <td><input type="text" name="idhakim" value="<?php echo $idhakim;?>" readonly></td>
        </tr>
        <tr>
            <td class="warna">Nama hakim</td>
            <td><input type="text" name="namahakim" value="<?php echo $namahakim;?>"></td>
        </tr>
        <tr>
            <td class="warna">Password</td>
            <td><input type="text" name="password" value="<?php echo $password;?>"></td>
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