<?php
    include("sambungan.php");

    if(isset($_GET['idpenilaian']))
        $idpenilaian = $_GET['idpenilaian'];
        $sql = "DELETE FROM penilaian WHERE idpenilaian = '$idpenilaian'";
        $result = mysqli_query($sambungan, $sql);

        if($result)
            echo "<script>alert('Berjaya padam')</script>";
        else
            echo "<script>alert('Tidak berjaya padam')</script>";
        echo "<script>window.location = 'penilaian_senarai.php';</script>";
        
?>