<?php
$tgl_pinjam = $data['kwitansi']['tgl_peminjaman'];
$tglA = $data ['kwitansi']['tgl_pengembalian_a'];
setlocale(LC_TIME, 'id_ID'); // Setel lokal ke bahasa Indonesia
$tanggalp = strftime('%d %B %Y', strtotime($tgl_pinjam));
setlocale(LC_TIME, 'id_ID'); // Setel lokal ke bahasa Indonesia
$tanggala = strftime('%d %B %Y', strtotime($tglA));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Peminjaman Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 22px;
            margin-bottom: 0;
        }

        .info {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .info hr {
            border-top: 2px solid #333;
        }

        .info table {
            width: 100%;
            border-collapse: collapse;
        }

        .info table th, .info table td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            font-size: 13px;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container info">
        <hr>
        <div class="header">
            <h1>Nama Sekolah</h1>
            <p class="mb-0">Nama Perpustakaan</p>
            <p>Nomor HP</p>
        </div>
        <div class="info">
            <hr>
            <table>
                <tr>
                    <th>Nama Anggota</th>
                    <td><?php echo $data['kwitansi']['nama_anggota']; ?></td>
                </tr>
                <tr>
                    <th>Tgl. Peminjaman</th>
                    <td><?php echo $tanggalp; ?></td>
                </tr>
                <tr>
                    <th>Tgl. Pengembalian Aktual</th>
                    <td><?php echo $tanggala; ?></td>
                </tr>
            </table>
            <hr>
            <table>
                <tr>
                    <th><em>Kelas</em></th>
                    <td><?php echo $data ['kwitansi']['nama_pinjam']; ?></td>
                </tr>
                <tr>
                    <th><em>Judul Buku</em></th>
                    <td><?php echo $data ['kwitansi']['judul_buku']; ?></td>
                </tr>
                <tr>
                    <th><em>Jumlah Pinjam</em></th>
                    <td><?php echo $data ['kwitansi']['jumlah_pinjam']; ?> Jumlah Buku</td>
                </tr>
            </table>
            <hr class="mb-0">
            <p style="color: red; font-size: 12px; text-align: left;"><em>*<?php echo $data['kwitansi']['catatan']; ?></em></p>
        </div>
        <div class="footer">
            <div class="col-md-12">
                Dicetak oleh,
                <br/><br>
                <br><b><u><?php echo $_SESSION['nama_admin']; ?></u></b>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>