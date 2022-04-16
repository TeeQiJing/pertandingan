<!-- Pg 84 -->
<?php
    session_start();
    // Include database connection
    include('sambungan.php');

    // If user click Login button
    if(isset($_POST['submit'])){

        // Get user id and password
        $userid = $_POST['userid'];
        $password = $_POST['password'];
        $jumpa = FALSE;

        // Check whether user is peserta
        if($jumpa == FALSE){
            $sql = "SELECT * FROM peserta";
            $result = mysqli_query($sambungan, $sql);

            // Loop through all data/record in 'peserta' table
            while($peserta = mysqli_fetch_array($result)){

                // If user id and password same as data in 'peserta' table
                if($peserta['nokp'] == $userid && $peserta['password'] == $password){
                    $jumpa = TRUE;
                    $_SESSION['idpengguna'] = $peserta['nokp'];
                    $_SESSION['nama'] = $peserta['namapeserta'];
                    $_SESSION['status'] = 'peserta';
                    break;
                }
            }
        }

        // Check whether user is hakim
        if($jumpa == FALSE){
            $sql = "SELECT * FROM hakim";
            $result = mysqli_query($sambungan, $sql);

            // Loop through all data/record in 'hakim' table
            while($hakim = mysqli_fetch_array($result)){

                // If user id and password same as data in 'hakim' table
                if($hakim['idhakim'] == $userid && $hakim['password'] == $password){
                    $jumpa = TRUE;
                    $_SESSION['idpengguna'] = $hakim['idhakim'];
                    $_SESSION['nama'] = $hakim['namahakim'];
                    $_SESSION['status'] = 'hakim';
                    break;
                }
            }
        }
    
        // Check whether user is urusetia
        if($jumpa == FALSE){
            $sql = "SELECT * FROM urusetia";
            $result = mysqli_query($sambungan, $sql);

            // Loop through all data/record in 'urusetia' table
            while($urusetia = mysqli_fetch_array($result)){

                // If user id and password same as data in 'urusetia' table
                if($urusetia['idurusetia'] == $userid && $urusetia['password'] == $password){
                    $jumpa = TRUE;
                    $_SESSION['idpengguna'] = $urusetia['idurusetia'];
                    $_SESSION['nama'] = $urusetia['namaurusetia'];
                    $_SESSION['status'] = 'urusetia';
                    break;
                }
            }
        }

        // If successfully find any matched record in 'peserta' / 'hakim' / 'urusetia' tables
        if($jumpa == TRUE){

            // If user is peserta, transfer user to 'peserta_home.php' page
            if($_SESSION['status'] == 'peserta') header("Location: peserta_home.php");

            // If user is hakim, transfer user to 'hakim_home.php' page
            if($_SESSION['status'] == 'hakim') header("Location: hakim_home.php");

            // If user is urusetia, transfer user to 'urusetia_home.php' page
            if($_SESSION['status'] == 'urusetia') header("Location: urusetia_home.php");

        }else{

            // If unsuccessfully find any matched record in 'peserta' / 'hakim' / 'urusetia' tables
            echo "
                <script>
                    alert('Kesalahan pada userid atau password');
                    
                    // Transfer user to 'login.php' for user to login again
                    window.location = 'login.php'
                </script>
            ";
        }

    }

?>

<html>
<link rel="stylesheet" href="button.css">
<link rel="stylesheet" href="borang.css">
<body>
    <center>
        <img src="imej/tajuk1.png">
        <img src="imej/tajuk2.png">
    </center>
    <h3 class="pendek">LOG IN</h3>
    <form action="login.php" class="pendek" method="post">
        <table>
            <tr>
                <td><img src="imej/user.png"></td>
                <td><input type="text" name="userid" placeholder="userid" required></td>
            </tr>
            <tr>
                <td><img src="imej/lock.png"></td>
                <td><input type="password" name="password" placeholder="password" required></td>
            </tr>
        </table>
        <button class="login" type="submit" name="submit">Login</button>
        <button class="signup" type="button" onclick="window.location = 'signup.php'">Sign Up</button>
    </form>
</body>
</html>