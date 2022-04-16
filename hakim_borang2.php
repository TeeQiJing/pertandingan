<?php
    include("sambungan.php");
    $nokp = $_POST['nokp'];
    $jumlah_markah = $_POST['jumlah_markah'];

    $sql = "SELECT * FROM penilaian";
    $data = mysqli_query($sambungan, $sql);

    while($penilaian = mysqli_fetch_array($data)){
        $markah = $_POST["$penilaian[idpenilaian]"];
        $idpenilaian = $penilaian['idpenilaian'];

        $sql = "INSERT INTO keputusan VALUES('$nokp', '$idpenilaian', '$markah', '$jumlah_markah')";
        $result = mysqli_query($sambungan, $sql);

        if($result)
            echo "<script>alert('Berjaya tambah')</script>";
        else
            echo "<script>alert('Tidak berjaya tambah')</script>";
        echo "<script>window.location = 'hakim_borang.php';</script>";
    } // tamat while
?>