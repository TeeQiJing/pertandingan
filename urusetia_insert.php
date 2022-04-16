<!-- Pg 51 -->
<?php
    include("urusetia_menu.php");
    include("sambungan.php");
    
    if(isset($_POST['submit'])){
        $idurusetia = $_POST["idurusetia"];
        $password = $_POST["password"];
        $namaurusetia = $_POST["namaurusetia"];

        $checksql = "SELECT * FROM urusetia WHERE idurusetia = '$idurusetia'";
        $checkresult = mysqli_query($sambungan, $checksql);

        if(mysqli_num_rows($checkresult)>=1){
            echo "
                <script>
                    alert('idurusetia yang dimasukkan sudah daftar, sila masukkan idurusetia yang lain');
                    window.location = 'urusetia_insert.php';
                </script>
            ";
        }else{
            $sql = "INSERT INTO urusetia(idurusetia, password, namaurusetia)
            VALUES('$idurusetia', '$password', '$namaurusetia')";
            $result = mysqli_query($sambungan, $sql);

            if($result)
                echo "<script>alert('Berjaya Tambah!')</script>";
            else
                echo "<script>alert('Tidak Berjaya Tambah!')</script>";
            echo "<script>window.location = 'urusetia_insert.php'</script>";
        }
    }
?>
<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">
<h3 class="panjang">TAMBAH URUSETIA</h3>
<form action="urusetia_insert.php" method="post" class="panjang">
    <table>
        <tr>
            <td class="warna">ID urusetia</td>
            <td><input type="text" name="idurusetia" pattern="U[0-9]{2}" title="U followed by 2 int" placeholder="U01" 
            oninvalid="this.setCustomValidity('Sila masukkan U dan 2 nombor')" oninput = "this.setCustomValidity('')" required></td>
        </tr>
        <tr>
            <td class="warna">Nama Urusetia</td>
            <td><input type="text" name="namaurusetia" placeholder="Ali bin Abu" required></td>
        </tr>
        <tr>
            <td class="warna">Password</td>
            <td><input type="password" name="password" pattern="[a-zA-Z0-9]{8}" placeholder="abcd1234" title="8 char" 
            oninvalid="this.setCustomValidity('Sila masukkan 8 char')" oninput = "this.setCustomValidity('')" required></td>
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