<?php
    include("sambungan.php");
    include("urusetia_menu.php");

    if(isset($_POST['submit'])){
        $idhakim = $_POST['idhakim'];
        $password = $_POST['password'];
        $namahakim = $_POST['namahakim'];

        $checksql = "SELECT * FROM hakim WHERE idhakim = '$idhakim'";
        $checkresult = mysqli_query($sambungan, $checksql);

        if(mysqli_num_rows($checkresult)>=1){
            echo "
                <script>
                    alert('idhakim yang dimasukkan sudah daftar, sila masukkan idhakim yang lain');
                    window.location = 'hakim_insert.php';
                </script>
            ";
        }else{

            $sql = "INSERT INTO hakim VALUES('$idhakim', '$password', '$namahakim')";

            $result = mysqli_query($sambungan, $sql);
            if($result) 
                echo "<script>alert('Berjaya tambah');</script>";
            else    
                echo "<script>alert('Tidak berjaya tambah');</script>";
            echo "<script>window.location = 'hakim_insert.php';</script>";
        }
    }
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">
<h3 class="panjang">TAMBAH HAKIM</h3>
<form action="hakim_insert.php" method="post" class="panjang">
    <table>
        <tr>
            <td class="warna">ID Hakim</td>
            <td><input type="text" name="idhakim" pattern="H[0-9]{2}" title="H followed by 2 int" placeholder="H01" 
            oninvalid="this.setCustomValidity('Sila masukkan H dan 2 nombor')" oninput = "this.setCustomValidity('')" required></td>
        </tr>
        <tr>
            <td class="warna">Password</td>
            <td><input type="password" name="password" pattern="[a-zA-Z0-9]{8}" placeholder="abcd1234" title="8 char" 
            oninvalid="this.setCustomValidity('Sila masukkan 8 char')" oninput = "this.setCustomValidity('')" required></td>
        </tr>
        <tr>
            <td class="warna">Nama Hakim</td>
            <td><input type="text" name="namahakim" placeholder="Ali bin Abu" required></td>
        </tr>
        
    </table>
    <button class="tambah" type="submit" name="submit">Tambah</button>
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