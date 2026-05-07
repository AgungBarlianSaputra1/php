<?php
include 'koneksi.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Railway</title>

    <style>
        body{
            font-family: Arial;
            margin: 40px;
            background: #f4f4f4;
        }

        h2{
            color: #333;
        }

        form{
            background: white;
            padding: 20px;
            width: 300px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        button{
            padding: 10px 20px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }

        table{
            border-collapse: collapse;
            width: 100%;
            background: white;
        }

        table th,
        table td{
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        a{
            color: red;
            text-decoration: none;
        }
    </style>
</head>

<body>

<h2>Tambah Data User</h2>

<form method="POST">

    <input
        type="text"
        name="nama"
        placeholder="Masukkan Nama"
        required
    >

    <input
        type="password"
        name="sandi"
        placeholder="Masukkan Password"
        required
    >

    <button type="submit" name="tambah">
        Simpan
    </button>

</form>

<?php

// CREATE DATA
if(isset($_POST['tambah'])){

    $nama  = $_POST['nama'];
    $sandi = $_POST['sandi'];

    $query = mysqli_query(
        $koneksi,
        "INSERT INTO users(nama, sandi)
         VALUES('$nama','$sandi')"
    );

    if(!$query){
        die("INSERT ERROR : " . mysqli_error($koneksi));
    }

    echo "<p>Data berhasil ditambahkan</p>";
}

// DELETE DATA
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    $hapus = mysqli_query(
        $koneksi,
        "DELETE FROM users WHERE id='$id'"
    );

    if(!$hapus){
        die("DELETE ERROR : " . mysqli_error($koneksi));
    }

    header("Location: index.php");
    exit;
}

?>

<h2>Data Users</h2>

<table>

    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Password</th>
        <th>Aksi</th>
    </tr>

<?php

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM users"
);

if(!$data){
    die("SELECT ERROR : " . mysqli_error($koneksi));
}

while($d = mysqli_fetch_array($data)){

?>

<tr>

    <td>
        <?php echo $d['id']; ?>
    </td>

    <td>
        <?php echo $d['nama']; ?>
    </td>

    <td>
        <?php echo $d['sandi']; ?>
    </td>

    <td>
        <a href="index.php?hapus=<?php echo $d['id']; ?>">
            Hapus
        </a>
    </td>

</tr>

<?php
}
?>

</table>

</body>
</html>
