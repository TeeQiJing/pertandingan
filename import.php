<?php
    include("sambungan.php");
    include("urusetia_menu.php");

    if(isset($_POST['submit'])){
        $namajadual = $_POST['namatable'];
        $namafail = $_FILES['namafail']['name'];

        // ambil data dari mana pun boleh
        $sementara = $_FILES['namafail']['tmp_name'];
        move_uploaded_file($sementara, $namafail);

        $fail = fopen($namafail, "r");
        while(!feof($fail)){
            $medan = explode(",", fgets($fail));

            $berjaya = false;

            if(strtolower($namajadual) === "peserta"){
                $nokp = trim($medan[0]);
                $password = trim($medan[1]);
                $namapeserta = trim($medan[2]);
                $telefon = trim($medan[3]);
                $idhakim = trim($medan[4]);
                $idurusetia = trim($medan[5]);

                $sql = "INSERT INTO peserta VALUES('$nokp', '$password', '$namapeserta', '$telefon', '$idhakim', '$idurusetia')";

                if(mysqli_query($sambungan, $sql))
                    echo "<script>alert('Berjaya import')</script>";
                else
                    echo "<script>alert('Tidak berjaya import')</script>";
                echo "<script>window.location = 'import.php';</script>";
                
            } // tamat if
            
            if(strtolower($namajadual) === "hakim"){
                $idhakim = trim($medan[0]);
                $namahakim = trim($medan[1]);
                $password = trim($medan[2]);

                $sql = "INSERT INTO hakim VALUES('$idhakim', '$namahakim', '$password')";

                if(mysqli_query($sambungan, $sql))
                    echo "<script>alert('Berjaya import')</script>";
                else
                    echo "<script>alert('Tidak berjaya import')</script>";
                echo "<script>window.location = 'import.php';</script>";
                
            } // tamat if
        } // tamat while
        mysqli_close($sambungan);
    } // tamat if
?>

<html>
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="borang.css">
    <body>
        <h3 class="panjang">IMPORT DATA</h3>
        <form action="import.php" method="post" class="panjang" enctype="multipart/form-data" class="import">
            <table>
                <tr>
                    <td>Jadual</td>
                    <td>
                        <select name="namatable">
                            <option>peserta</option>
                            <option>hakim</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nama fail</td>
                    <td><input type="file" name="namafail" accept=".txt" style="width: 200px;"></td>
                </tr>
            </table>
            <button type="submit" class="import" name="submit">Import</button>
        </form>
    </body>
</html>