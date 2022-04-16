<?php

    // Include database connection
    include('sambungan.php');
    include("urusetia_menu.php");
    if(isset($_POST['submit'])){

        // Get new user information
        $nokp = $_POST['nokp'];
        $password = $_POST['password'];
        $namapeserta = $_POST['namapeserta'];
        $telefon = $_POST['telefon'];
        $idhakim = $_POST['idhakim'];
        $idurusetia = $_POST['idurusetia'];

        $checksql = "SELECT * FROM peserta WHERE nokp = '$nokp'";
        $checkresult = mysqli_query($sambungan, $checksql);

        // If nokp already exists in 'peserta' table
        if(mysqli_num_rows($checkresult)>=1){
            echo "
            <script>
                alert('No KP yang dimasukkan sudah ada, sila masukkan No KP yang lain!');
                window.location = 'peserta_insert.php';
            </script>";
        }else{

            // If nokp does not exists in 'peserta' table
            // Key in all information of user into 'peserta' table
            $sql = "INSERT INTO peserta(nokp, password, namapeserta, telefon, idhakim, idurusetia) 
            VALUES('$nokp', '$password', '$namapeserta', '$telefon', '$idhakim', '$idurusetia')";

            $result = mysqli_query($sambungan, $sql);

            if($result)
                echo "<script>alert('Berjaya tambah')</script>";
            else
                echo "<script>alert('Tidak berjaya tambah')</script>";
            echo "<script>window.location = 'peserta_insert.php'</script>";
        }
    }
?>


<html>
<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3 class="panjang">TAMBAH PESERTA</h3>
<form action="peserta_insert.php" method="post" class="panjang">
    <table>
        <tr>
            <td class="warna">No KP</td>
            <td><input type="text" name="nokp" placeholder="777777228888" pattern="[0-9]{12}" 
            oninvalid="this.setCustomValidity('Sila masukkan 12 nombor')" oninput = "this.setCustomValidity('')" required></td>
        </tr>
        <tr>
            <td class="warna">Nama Peserta</td>
            <td><input type="text" name="namapeserta" placeholder="Ali bin Abu" required></td>
        </tr>
        <tr>
            <td class="warna">No Telefon</td>
            <td><input type="text" name="telefon" placeholder="0123456789" pattern="[0-9]{10,11}"
            oninvalid="this.setCustomValidity('Sila masukkan 10 atau 11 char')" oninput = "this.setCustomValidity('')" required></td>
        </tr>
        <tr>
            <td class="warna">Password</td>
            <td><input type="text" name="password" placeholder="abcd1234" pattern="[0-9a-zA-Z]{8}" 
            oninvalid="this.setCustomValidity('Sila masukkan 8 char')" oninput = "this.setCustomValidity('')" required></td>
        </tr>
        <tr>
            <td class="warna">Nama Hakim</td>
            <td>
                <select name="idhakim">
                    <?php
                        $sql = "SELECT * FROM hakim";
                        $data = mysqli_query($sambungan, $sql);

                        // Print all hakim in 'hakim' table as options
                        while($hakim = mysqli_fetch_array($data)){
                            echo "<option value='$hakim[idhakim]'>$hakim[idhakim] - $hakim[namahakim]</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="warna">Nama Urusetia</td>
            <td>
                <select name="idurusetia">
                    <?php
                        $sql = "SELECT * FROM urusetia";
                        $data = mysqli_query($sambungan, $sql);

                        // Print all urusetia in 'urusetia' table as options
                        while($urusetia = mysqli_fetch_array($data)){
                            echo "<option value='$urusetia[idurusetia]'>$urusetia[idurusetia] - $urusetia[namaurusetia]</option>";
                        }
                    ?>
                </select>
            </td>
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