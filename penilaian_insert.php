<?php

    // Include database connection
    include('sambungan.php');
    include("urusetia_menu.php");
    if(isset($_POST['submit'])){

        // Get new user information
        $idpenilaian = $_POST['idpenilaian'];
        $aspek = $_POST['aspek'];
        $markahpenuh = $_POST['markahpenuh'];

        $checksql = "SELECT * FROM penilaian WHERE idpenilaian = '$idpenilaian'";
        $checkresult = mysqli_query($sambungan, $checksql);

        // If nokp already exists in 'penilaian' table
        if(mysqli_num_rows($checkresult)>=1){
            echo "
            <script>
                alert('Id Penilaian yang dimasukkan sudah ada, sila masukkan Id Penilaian yang lain!');
                window.location = 'penilaian_insert.php';
            </script>";
        }else{

            // If idpenilaian does not exists in 'penilaian' table
            // Key in all information of user into 'penilaian' table
            $sql = "INSERT INTO penilaian
            VALUES('$idpenilaian', '$aspek', '$markahpenuh')";

            $result = mysqli_query($sambungan, $sql);

            if($result)
                echo "<script>alert('Berjaya tambah')</script>";
            else
                echo "<script>alert('Tidak berjaya tambah')</script>";
            echo "<script>window.location = 'penilaian_insert.php'</script>";
        }
    }
?>


<html>
<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3 class="panjang">TAMBAH PENILAIAN</h3>
<form action="penilaian_insert.php" method="post" class="panjang">
    <table>
        <tr>
            <td class="warna">ID Penilaian</td>
            <td><input type="text" name="idpenilaian" placeholder="N01" pattern="N[0-9]{2}" 
            oninvalid="this.setCustomValidity('Sila masukkan N dengan 2 nombor')" oninput = "this.setCustomValidity('')" required></td>
        </tr>
        <tr>
            <td class="warna">Aspek Penilaian</td>
            <td><input type="text" name="aspek" placeholder="Warna" required></td>
        </tr>
        <tr>
            <td class="warna">Markah Penuh</td>
            <td><input style="width: 200px;" type="number" name="markahpenuh" min="1" max="40" value="20"
            oninvalid="this.setCustomValidity('Sila masukkan nombor')" oninput = "this.setCustomValidity('')" required></td>
        </tr>
    </table>

    <button type="submit" class="tambah" name="submit">Tambah</button>
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