<?php
    include("sambungan.php");

    if(isset($_GET['idurusetia']))
        $idurusetia = $_GET['idurusetia'];
        $sql = "DELETE FROM urusetia WHERE idurusetia = '$idurusetia'";
        $result = mysqli_query($sambungan, $sql);

        if($result)
            echo "<script>alert('Berjaya padam')</script>";
        else
            echo "<script>alert('Tidak berjaya padam')</script>";
        echo "<script>window.location = 'urusetia_senarai.php';</script>";
        
?>