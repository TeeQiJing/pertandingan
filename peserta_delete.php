<?php
    include("sambungan.php");

    if(isset($_GET['nokp']))
        $nokp = $_GET['nokp'];
        $sql = "DELETE FROM peserta WHERE nokp = '$nokp'";
        $result = mysqli_query($sambungan, $sql);

        if($result)
            echo "<script>alert('Berjaya padam')</script>";
        else
            echo "<script>alert('Tidak berjaya padam')</script>";
        echo "<script>window.location = 'peserta_senarai.php';</script>";
        
?>