<?php
    include("sambungan.php");
    include("urusetia_menu.php");
?>

<link rel="stylesheet" href="senarai.css">
<table>
    <caption>SENARAI URUSETIA</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Password</th>
        <th colspan="2">Tindakan</th>
    </tr>

    <?php
        $sql = "SELECT * FROM urusetia";
        $result = mysqli_query($sambungan, $sql);

        while($urusetia = mysqli_fetch_array($result)){
            echo "
            <tr>
                <td>$urusetia[idurusetia]</td>
                <td>$urusetia[namaurusetia]</td>
                <td>$urusetia[password]</td>
                <td><a class='choice' href='urusetia_update.php?idurusetia=$urusetia[idurusetia]'>update</a></td>
                <td><a class='choice' href='urusetia_delete.php?idurusetia=$urusetia[idurusetia]'>delete</a></td>
            </tr>
            ";
        }
    ?>
</table>