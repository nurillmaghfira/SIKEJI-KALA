<?php

use Master\Menu;
use Master\Pegawai;
use Master\Penggajian;
use Master\Admin;

include 'autoload.php';
include 'Config/Database.php';

$menu = new Menu();
$pegawai = new Pegawai($dataKoneksi);
$penggajian = new Penggajian($dataKoneksi);
$admin = new Admin($dataKoneksi);
// $mahasiswa->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kenaikan Gaji</title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="">Kenaikan Gaji Berkala</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria- controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
foreach ($menu->topMenu() as $r) {
    ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['Link']; ?>" class="nav-link">
                                    <?php echo $r['Text']; ?>
                                </a>
                            </li>
                        <?php
}
?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>
            <?php
if (!isset($target) or $target == "home") {
    echo "Hai, Selamat Datang Di Beranda";
    // =========== start kontent pegawai ======================
} elseif ($target == "pegawai") {
    if ($act == "tambah_pegawai") {
        echo $pegawai->tambah();
    } elseif ($act == "simpan_pegawai") {
        if ($pegawai->simpan()) {
            echo "<script>
                            alert('data sukses disimpan');
                            window.location.href='?target=pegawai';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal disimpan');
                            window.location.href='?target=pegawai';
                        </script>";
        }
    } elseif ($act == "edit_pegawai") {
        $id = $_GET['id'];
        echo $pegawai->edit($id);
    } elseif ($act == "update_pegawai") {
        if ($pegawai->update()) {
            echo "<script>
                            alert('data sukses diubah');
                            window.location.href='?target=pegawai';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal diubah');
                            window.location.href='?target=pegawai';
                        </script>";
        }
    } elseif ($act == "delete_pegawai") {
        $id = $_GET['id'];
        if ($pegawai->delete($id)) {
            echo "<script>
                            alert('data sukses dihapus');
                            window.location.href='?target=pegawai';
                        </script>";
        } else {
            echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=pegawai';
                    </script>";
        }
    } else {
        echo $pegawai->index();
    }

    // penggajian
} elseif ($target == "penggajian") {
    if ($act == "tambah_penggajian") {
        echo $penggajian->tambah();
    } elseif ($act == "simpan_penggajian") {
        if ($penggajian->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=penggajian';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=penggajian';
                    </script>";
        }
    } elseif ($act == "edit_penggajian") {
        $id = $_GET['id'];
        echo $penggajian->edit($id);
    } elseif ($act == "update_penggajian") {
        if ($penggajian->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?target=penggajian';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=penggajian';
                    </script>";
        }
    } elseif ($act == "delete_penggajian") {
        $id = $_GET['id'];
        if ($penggajian->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=penggajian';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=penggajian';
                </script>";
        }
    } else {
        echo $penggajian->index();
    }

    // admin
} elseif ($target == "admin") {
    if ($act == "tambah_admin") {
        echo $admin->tambah();
    } elseif ($act == "simpan_admin") {
        if ($admin->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=admin';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=admin';
                    </script>";
        }
    } elseif ($act == "edit_admin") {
        $id = $_GET['id'];
        echo $admin->edit($id);
    } elseif ($act == "update_admin") {
        if ($admin->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?target=admin';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=admin';
                    </script>";
        }
    } elseif ($act == "delete_admin") {
        $id = $_GET['id'];
        if ($admin->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=admin';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=admin';
                </script>";
        }
    } else {
        echo $admin->index();
    }

    // no pengguna
} elseif ($target == 'pengguna') {

    echo "selamat datang di pengguna";
}
?>
    </div>
</div>
</body>
</html>