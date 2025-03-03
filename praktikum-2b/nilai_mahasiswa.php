<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_siswa = $_POST['nama'];
    $mata_kuliah = $_POST['matkul'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];
    $nilai_tugas = $_POST['nilai_tugas'];

    if (!is_numeric($nilai_uts) || !is_numeric($nilai_uas) || !is_numeric($nilai_tugas)) {
        echo "<div class='alert alert-danger mt-4'>Input nilai harus berupa angka.</div>";
        exit;
    }

    $nilai_akhir = ($nilai_uts * 0.30) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);
    $status = ($nilai_akhir > 55) ? "Lulus" : "Tidak Lulus";

    if ($nilai_akhir >= 85) {
        $grade = "A";
    } elseif ($nilai_akhir >= 70) {
        $grade = "B";
    } elseif ($nilai_akhir >= 56) {
        $grade = "C";
    } elseif ($nilai_akhir >= 36) {
        $grade = "D";
    } else {
        $grade = "E";
    }

    switch ($grade) {
        case "A":
            $predikat = "Sangat Memuaskan";
            break;
        case "B":
            $predikat = "Memuaskan";
            break;
        case "C":
            $predikat = "Cukup";
            break;
        case "D":
            $predikat = "Kurang";
            break;
        case "E":
            $predikat = "Sangat Kurang";
            break;
        default:
            $predikat = "Tidak Ada";
            break;
    }

    echo "
    <div style='width: 500px; margin: 50px auto; padding: 20px; background-color: #1c8a5e; color: white; border-radius: 10px; text-align: left; font-family: Arial, sans-serif;'>
        <h2 style='text-align: center;'>Hasil Penilaian Mata Kuliah</h2>
        <table style='width: 100%; margin-top: 20px;'>
            <tr>
                <td>Nama</td><td>:</td><td>$nama_siswa</td>
            </tr>
            <tr>
                <td>Mata Kuliah</td><td>:</td><td>$mata_kuliah</td>
            </tr>
            <tr>
                <td>Nilai UTS</td><td>:</td><td>$nilai_uts</td>
            </tr>
            <tr>
                <td>Nilai UAS</td><td>:</td><td>$nilai_uas</td>
            </tr>
            <tr>
                <td>Nilai Tugas</td><td>:</td><td>$nilai_tugas</td>
            </tr>
            <tr>
                <td>Nilai Akhir</td><td>:</td><td>" . number_format($nilai_akhir, 2, ',', '.') . "</td>
            </tr>
            <tr>
                <td>Grade</td><td>:</td><td>$grade</td>
            </tr>
            <tr>
                <td>Predikat</td><td>:</td><td>$predikat</td>
            </tr>
            <tr>
                <td>Status</td><td>:</td><td>$status</td>
            </tr>
        </table>
        <div style='text-align: center; margin-top: 20px;'>
            <a href='form_nilai.php' style='text-decoration: none; padding: 10px 20px; background-color: gold; color: black; border-radius: 5px;'>Kembali</a>
        </div>
    </div>
    ";
}
?>