<?php
    include("sambungan.php");
    include("urusetia_menu.php");

    if(isset($_POST['submit'])){
        $idurusetia = $_POST['idurusetia'];
        $namaurusetia = $_POST['namaurusetia'];
        $password = $_POST['password'];

        $sql = "UPDATE urusetia SET namaurusetia = '$namaurusetia', password = '$password' 
        WHERE idurusetia = '$idurusetia'";

        $result = mysqli_query($sambungan, $sql);

        if($result)
            echo "<script>alert('Berjaya kemaskini');</script>";
        else
            echo "<script>alert('Tidak berjaya kemaskini');</script>";
        echo "<script>window.location = 'urusetia_senarai.php';</script>";
    }

    if(isset($_GET['idurusetia']))
        $idurusetia = $_GET['idurusetia'];

    $sql = "SELECT * FROM urusetia WHERE idurusetia = '$idurusetia'";
    $result = mysqli_query($sambungan, $sql);
    while($urusetia = mysqli_fetch_array($result)){
        $password = $urusetia['password'];
        $namaurusetia = $urusetia['namaurusetia'];
    }
    
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3 class="panjang">KEMASKINI URUSETIA</h3>
<form action="urusetia_update.php" method="post" class="panjang">
    <table>
        <tr>
            <td class="warna">ID urusetia</td>
            <td><input type="text" name="idurusetia" value="<?php echo $idurusetia;?>" readonly></td>
        </tr>
        <tr>
            <td class="warna">Nama urusetia</td>
            <td><input type="text" name="namaurusetia" value="<?php echo $namaurusetia;?>"></td>
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