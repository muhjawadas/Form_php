<?php
if(isset($_GET['id'])){
    require_once "koneksi.php";
    $query = "SELECT * FROM mahasiswa WHERE NIM = '".$_GET['id']."'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
}
?>
<html>
    <h3>FORM MAHASISWA</h3>
    <form method="POST" action="form.php">
        <input type="hidden" value="<?= isset($row['id']) ? $row['id'] : ''  ?>" name="action">
    <table>
        <tr>
            <td><b>NIM</b></td>
            <td>:</td>
            <td><input type="numeric" require value="<?= isset($row['NIM']) ? $row['NIM'] : '' ?>" name="NIM" /></td>
        </tr>
        <tr>
            <td><b>NAMA</b></td>
            <td>:</td>
            <td><input type="text"  require value="<?= isset($row['NAMA']) ? $row['NAMA'] : '' ?>" name="NAMA" /></td>
        </tr>
        <tr>
            <td><b>Telp</b></td>
            <td>:</td>
            <td><input type="text"  require value="<?= isset($row['TELP']) ? $row['TELP'] : '' ?>" name="TELP" /></td>
        </tr>
        <tr>
            <td><b>Alamat</b></td>
            <td>:</td>
            <td><textarea name="ALAMAT" style="min-width: 120; min-height: 100"><?= isset($row['ALAMAT']) ? $row['ALAMAT'] : '' ?> </textarea></td>
        </tr>
        <tr>
            <td><b></b></td>
            <td></td>
            <td><input type="submit"/> <input type="reset"/></td>
        </tr>
    </table>
    </form>
</html>

<?php

if($_POST){
    require_once "koneksi.php";

    if($_POST['NIM'] == '' || $_POST['NAMA'] == ''){
        echo "<script>alert('NIM / NAMA tidak boleh kosong !')</script>";
        die();
    }

    if($_POST['action'] == ''){
        //add
        $query = "SELECT NIM FROM mahasiswa WHERE NIM = '".$_POST['NIM']."'";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        if($row['NIM'] != ''){
            echo "<script>alert('Failed !, NIM sudah terdaftar pada sistem, silahkan inputkan yang lain !')</script>";
            die();
        }

        $sql = "INSERT INTO mahasiswa
        VALUES ('".$_POST['NIM']."', '".$_POST['NAMA']."', '".$_POST['TELP']."', '".$_POST['ALAMAT']."')";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script>alert('Success Add Data');location.href='index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
            echo "<script>alert('Error')</script>";
        }
    }else{
        //edit

        $sql = "UPDATE mahasiswa SET NIM='".$_POST['NIM']."', NAMA='".$_POST['NAMA']."', ALAMAT= '".$_POST['ALAMAT']."', TELP= '".$_POST['TELP']."' 
        WHERE id = ".$_POST['action'];
        if ($koneksi->query($sql) === TRUE) {
            echo "<script>alert('Success Edit Data');location.href='index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
            echo "<script>alert('Error')</script>";
        }
    }
}
?>