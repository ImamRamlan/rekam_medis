<?php
session_start();
include 'koneksi.php';
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php'; // Sesuaikan dengan jalur yang sesuai

$title = "Detail Data Catatan | Rekam Medis";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Periksa apakah parameter id_catatan tersedia
if (isset($_GET['id'])) {
    // Ambil id_catatan dari parameter URL
    $id_catatan = $_GET['id'];

    // Query untuk mengambil detail catatan medis berdasarkan id_catatan
    $query = "SELECT catatan_medis.id_catatan, pasien.nama AS nama_pasien, dokter.nama AS nama_dokter, 
                      catatan_medis.tanggal_kunjungan, catatan_medis.keluhan, 
                      catatan_medis.diagnosa, catatan_medis.tindakan
              FROM catatan_medis
              INNER JOIN pasien ON catatan_medis.id_pasien = pasien.id_pasien
              INNER JOIN dokter ON catatan_medis.id_dokter = dokter.id_dokter
              WHERE catatan_medis.id_catatan = $id_catatan";
    $result = mysqli_query($db, $query);
    $catatan = mysqli_fetch_assoc($result);
} else {
    // Jika parameter id_catatan tidak tersedia, redirect ke halaman data_catatan.php
    header("Location: data_catatan.php");
    exit();
}

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set dokumen informasi
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Detail Data Catatan | Rekam Medis');
$pdf->SetSubject('Detail Catatan Medis');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetFont('dejavusans', '', 12);

$pdf->AddPage();

$html = '<h1>Detail Catatan Medis</h1>';
$html .= '<table>';
$html .= '<tr><th>Nama Pasien</th><td>' . $catatan['nama_pasien'] . '</td></tr>';
$html .= '<tr><th>Nama Dokter</th><td>' . $catatan['nama_dokter'] . '</td></tr>';
$html .= '<tr><th>Tanggal Kunjungan</th><td>' . $catatan['tanggal_kunjungan'] . '</td></tr>';
$html .= '<tr><th>Keluhan</th><td>' . $catatan['keluhan'] . '</td></tr>';
$html .= '<tr><th>Diagnosa</th><td>' . $catatan['diagnosa'] . '</td></tr>';
$html .= '<tr><th>Tindakan</th><td>' . $catatan['tindakan'] . '</td></tr>';
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('detail_catatan.pdf', 'I');
