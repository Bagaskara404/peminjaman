<?php
if (!isset($_SESSION["login_type"])) {
    echo '<script language="javascript" type="text/javascript">
        alert("Anda Tidak Berhak Memasuki Halaman Ini.!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=../index.php'>"; // Redirect ke halaman login jika tidak ada sesi
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Peminjaman Buku Perpustakaan | Data Admin</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?=BASEURL;?>/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=BASEURL;?>/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?=BASEURL;?>/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="<?=BASEURL;?>/assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?=BASEURL;?>/assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="<?=BASEURL;?>/home/index">
                    <span class="brand">Peminjaman
                        <span class="brand-tip">Buku</span>
                    </span>
                    <span class="brand-mini">AC</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <li>
                        <form class="navbar-search" action="javascript:;">
                            <div class="rel">
                                <span class="search-icon"><i class="ti-search"></i></span>
                                <input class="form-control" placeholder="Search here...">
                            </div>
                        </form>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li class="dropdown dropdown-notification">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span class="notify-signal"></span></i></a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                            <li class="dropdown-menu-header">
                                <div>
                                    <span><strong>5 New</strong> Notifications</span>
                                    <a class="pull-right" href="javascript:;">view all</a>
                                </div>
                            </li>
                            <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                                <div>
                                <?php 
                                    if ($data['notifikasi'] > 0) {
                                        foreach ($data['notifikasi'] as $notifikasi ) {
                                            $judul = $notifikasi['judul_buku'];
                                            $jumlah = $notifikasi['jumlah_pinjam'];
                                            $kelas = $notifikasi['nama_pinjam'];
                                            $status = $notifikasi['status_peminjaman'];
                                    
                                            // Tampilkan notifikasi
                                            if ($status == 1) {
                                                echo '<a class="list-group-item">';
                                                echo '<div class="media">';
                                                    echo '<div class="media-img">';
                                                        echo '<span class="badge badge-danger badge-big"><i class="fa fa-bell"></i></span>';
                                                    echo '</div>';
                                                    echo '<div class="media-body">';
                                                        echo '<div class="font-13">';
                                                        echo "Peminjaman buku $judul dari kelas $kelas telat dalam pengembalian. Jumlah: $jumlah buku.";
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                                echo '</a>';
                                            }elseif ($status == 3) {
                                                echo '<a class="list-group-item">';
                                                echo '<div class="media">';
                                                    echo '<div class="media-img">';
                                                        echo '<span class="badge badge-danger badge-big"><i class="fa fa-bell"></i></span>';
                                                    echo '</div>';
                                                    echo '<div class="media-body">';
                                                        echo '<div class="font-13">';
                                                        echo "Peminjaman buku $judul dari kelas $kelas telat dalam pengembalian. Jumlah: $jumlah buku.";
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</a>';
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="<?=BASEURL;?>/assets/img/admin-avatar.png" />
                            <span></span><?php echo $_SESSION['nama_admin']; ?><i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="keluar.php"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="<?=BASEURL;?>/<?php echo $data['admin']['foto']; ?>" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $_SESSION['nama_admin']; ?></div><small><?php echo $_SESSION['hak_akses']; ?></small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="<?=BASEURL;?>/home"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">Peminjaman Buku</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Master Data</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="<?=BASEURL;?>/anggota/index"><i class="fa fa-users"></i> Anggota</a>
                            </li>
                            <li>
                                <a href="<?=BASEURL;?>/buku/index"><i class="fa fa-book"></i> Buku</a>
                            </li>
                            <li>
                                <a href="<?=BASEURL;?>/kategori/index"><i class="fa fa-coffee"></i> Kategori</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?=BASEURL;?>/peminjaman/index"><i class="sidebar-item-icon fa fa-sticky-note"></i>
                            <span class="nav-label">Peminjaman Buku</span></a>
                    </li>
                    <li>
                        <a href="<?=BASEURL;?>/riwayat/index"><i class="sidebar-item-icon fa fa-history"></i>
                            <span class="nav-label">Riwayat</span></a>
                    </li>
                    <li>
                        <a href="<?=BASEURL;?>/admin/index"><i class="sidebar-item-icon fa fa-user"></i>
                            <span class="nav-label">Admin</span></a>
                    </li>
                    <li class="heading">Lainnya</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-file"></i>
                            <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="<?=BASEURL;?>/laporan/index"><i class="fa fa-file"></i> Laporan Peminjaman</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?=BASEURL;?>/login/keluar"><i class="sidebar-item-icon fa fa-sign-out"></i>
                            <span class="nav-label">Keluar</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h6 class="page-title">Data Admin</h6>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?=BASEURL;?>/home/index"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Admin</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Data Admin</div>
                        <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#formModal"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat</th>
                                    <th>No. Hp/Wa</th>
                                    <th>Hak Akses</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;
                                foreach ($data['semua_admin'] as $row) {
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['nama_lengkap']; ?></td>
                                    <td><?php echo $row['alamat']; ?></td>
                                    <td><?php echo $row['nomor_hp']; ?></td>
                                    <td><?php echo $row['hak_akses']; ?></td>
                                    <td>
                                        <img src="<?=BASEURL;?>/<?php echo $row['foto']; ?>" width="60px" height="60px">
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="" data-toggle="modal" data-target="#formeditModal<?php echo $row['id_admin']; ?>"><i class="fa fa-cog"></i></a>
                                        <a class="btn btn-sm btn-danger" href="<?=BASEURL;?>/admin/hapus_admin/<?php echo $row['id_admin']; ?>"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah-->
            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?=BASEURL;?>/admin/tambah_admin" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Kolom kiri -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama-lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama-lengkap" name="nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                    </div>
                                </div>
                                <!-- Kolom kanan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomor-hp">Nomor HP</label>
                                        <input type="text" class="form-control" id="nomor-hp" name="nomor">
                                    </div>
                                    <div class="form-group">
                                        <label for="hak-ases">Hak Akses</label>
                                        <select class="form-control" id="hak-ases" name="hakakses">
                                            <option selected disabled>Pilih Hak Akses</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="upload-foto">Upload Foto</label>
                                        <input type="file" class="form-control" id="upload-foto" name="foto">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit-->
            <?php 
            foreach ($data['semua_admin'] as $rowa){
            ?>
            <div class="modal fade" id="formeditModal<?php echo $rowa['id_admin']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?=BASEURL;?>/admin/update_admin" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $rowa['id_admin']; ?>">    
                            <div class="row">
                                <!-- Kolom kiri -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $rowa['username']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama-lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama-lengkap" name="nama" value="<?php echo $rowa['nama_lengkap']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo $rowa['alamat']; ?></textarea>
                                    </div>
                                </div>
                                <!-- Kolom kanan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomor-hp">Nomor HP</label>
                                        <input type="text" class="form-control" id="nomor-hp" name="nomor" value="<?php echo $rowa['nomor_hp']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="hak-ases">Hak Akses</label>
                                        <select class="form-control" id="hak-ases" name="hakakses">
                                            <option selected disabled>Pilih Hak Akses</option>
                                            <option <?php if($rowa['hak_akses'] == "admin"){echo "selected='selected'";} ?> value="admin">Admin</option>
                                            <option <?php if($rowa['hak_akses'] == "user"){echo "selected='selected'";} ?> value="user">User</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="upload-foto">Upload Foto</label>
                                        <input type="file" class="form-control" id="upload-foto" name="foto">
                                        <br>
                                        <img src="<?=BASEURL;?>/<?php echo $rowa['foto']; ?>" width="60px" height="60px">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2023 © <b>AANDANU</b> - All rights reserved.</div>
                <a class="px-4" href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589" target="_blank">BUY PREMIUM</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <div class="theme-config">
        <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
        <div class="theme-config-box">
            <div class="text-center font-18 m-b-20">SETTINGS</div>
            <div class="font-strong">LAYOUT OPTIONS</div>
            <div class="check-list m-b-20 m-t-10">
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedNavbar" type="checkbox" checked>
                    <span class="input-span"></span>Fixed navbar</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedlayout" type="checkbox">
                    <span class="input-span"></span>Fixed layout</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input class="js-sidebar-toggler" type="checkbox">
                    <span class="input-span"></span>Collapse sidebar</label>
            </div>
            <div class="font-strong">LAYOUT STYLE</div>
            <div class="m-t-10">
                <label class="ui-radio ui-radio-gray m-r-10">
                    <input type="radio" name="layout-style" value="" checked="">
                    <span class="input-span"></span>Fluid</label>
                <label class="ui-radio ui-radio-gray">
                    <input type="radio" name="layout-style" value="1">
                    <span class="input-span"></span>Boxed</label>
            </div>
            <div class="m-t-10 m-b-10 font-strong">THEME COLORS</div>
            <div class="d-flex m-b-20">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Default">
                    <label>
                        <input type="radio" name="setting-theme" value="default" checked="">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-white"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue">
                    <label>
                        <input type="radio" name="setting-theme" value="blue">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green">
                    <label>
                        <input type="radio" name="setting-theme" value="green">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple">
                    <label>
                        <input type="radio" name="setting-theme" value="purple">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange">
                    <label>
                        <input type="radio" name="setting-theme" value="orange">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink">
                    <label>
                        <input type="radio" name="setting-theme" value="pink">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="White">
                    <label>
                        <input type="radio" name="setting-theme" value="white">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue light">
                    <label>
                        <input type="radio" name="setting-theme" value="blue-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green light">
                    <label>
                        <input type="radio" name="setting-theme" value="green-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple light">
                    <label>
                        <input type="radio" name="setting-theme" value="purple-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange light">
                    <label>
                        <input type="radio" name="setting-theme" value="orange-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink light">
                    <label>
                        <input type="radio" name="setting-theme" value="pink-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="<?=BASEURL;?>/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="<?=BASEURL;?>/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="<?=BASEURL;?>/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=BASEURL;?>/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="<?=BASEURL;?>/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="<?=BASEURL;?>/assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?=BASEURL;?>/assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
                //"ajax": './assets/demo/data/table_data.json',
                /*"columns": [
                    { "data": "name" },
                    { "data": "office" },
                    { "data": "extn" },
                    { "data": "start_date" },
                    { "data": "salary" }
                ]*/
            });
        })
    </script>

    <script>
        var inactivityTimeout; // Timeout untuk aktivitas

        // Fungsi untuk mereset timeout
        function resetInactivityTimeout() {
            clearTimeout(inactivityTimeout);
            inactivityTimeout = setTimeout(function() {
                window.location.href = "<?=BASEURL;?>/lockscreen/index";
            }, 200000); // Mengarahkan ke lockscreen.php setelah 10 menit (600000 ms) tidak ada aktivitas
        }

        // Menambahkan event listener untuk mendeteksi aktivitas
        document.addEventListener("mousemove", resetInactivityTimeout);
        document.addEventListener("keydown", resetInactivityTimeout);
    </script>
</body>

</html>