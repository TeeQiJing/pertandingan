<?php
    include("sambungan.php");

    if(isset($_GET['idhakim']))
        $idhakim = $_GET['idhakim'];
        $sql = "DELETE FROM hakim WHERE idhakim = '$idhakim'";
        $result = mysqli_query($sambungan, $sql);

        if($result)
            echo "<script>alert('Berjaya padam')</script>";
        else
            echo "<script>alert('Tidak berjaya padam')</script>";
        echo "<script>window.location = 'hakim_senarai.php';</script>";
        
?>