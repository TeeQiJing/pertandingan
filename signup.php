<!-- Pg 86 -->
<!-- This Sign Up only for peserta -->
<!-- Add pattern, required, oninput, oninvalid (Pg 67) -->
<!-- Add nokp exists in table, ask user to login (checksql)-->

<?php

    // Include database connection
    include('sambungan.php');
    
    // If user click Sign Up button
    if(isset($_POST['submit'])){

        // Get new user information
        $nokp = $_POST['nokp'];
        $password = $_POST['password'];
        $namapeserta = $_POST['namapeserta'];
        $telefon = $_POST['no_tel'];
        $idhakim = $_POST['idhakim'];
        $idurusetia = $_POST['idurusetia'];

        $checksql = "SELECT * FROM peserta WHERE nokp = '$nokp'";
        $checkresult = mysqli_query($sambungan, $checksql);

        // If nokp already exists in 'peserta' table
        if(mysqli_num_rows($checkresult)>=1){
            echo "
            <script>
                alert('No KP yang dimasukkan telah daftar, sila Log Masuk!');
                window.location = 'login.php';
            </script>";
        }else{

            // If nokp does not exists in 'peserta' table
            // Key in all information of user into 'peserta' table
            $sql = "INSERT INTO peserta(nokp, password, namapeserta, telefon, idhakim, idurusetia) 
            VALUES('$nokp', '$password', '$namapeserta', '$telefon', '$idhakim', '$idurusetia')";

            $result = mysqli_query($sambungan, $sql);

            if($result)
                echo "<script>alert('Berjaya signup')</script>";
            else
                echo "<script>alert('Tidak berjaya signup')</script>";
            echo "<script>window.location = 'login.php'</script>";
        }
    }
?>


<html>
<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">
<body>
    <center>
        <img src="imej/tajuk1.png">
        <img src="imej/tajuk2.png">
    </center>
    <h3 class="panjang">SIGN UP</h3>
    <form action="signup.php" method="post" class="panjang">
        <table>
            <tr>
                <td>No KP</td>
                <td><input type="text" name="nokp" placeholder="777777228888" pattern="[0-9]{12}" 
                oninvalid="this.setCustomValidity('Sila masukkan 12 nombor')" oninput = "this.setCustomValidity('')" required></td>
            </tr>
            <tr>
                <td>Nama Peserta</td>
                <td><input type="text" name="namapeserta" placeholder="Ali bin Abu" required></td>
            </tr>
            <tr>
                <td>No Telefon</td>
                <td><input type="text" name="no_tel" placeholder="0123456789" pattern="[0-9]{10,11}"
                oninvalid="this.setCustomValidity('Sila masukkan 10 atau 11 char')" oninput = "this.setCustomValidity('')" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="password" placeholder="abcd1234" pattern="[0-9a-zA-Z]{8}" 
                oninvalid="this.setCustomValidity('Sila masukkan 8 char')" oninput = "this.setCustomValidity('')" required></td>
            </tr>
            <tr>
                <td>Nama Hakim</td>
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

        <button type="submit" class="signup" name="submit">Daftar</button>
        <button type="button" class="login" onclick="window.location='login.php'">Login</button>
    </form>
</body>
</html>