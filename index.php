Natasya Novita Prihatini_3337250046
<?php
// Data mata kuliah
$matkul = [
    [
        "nama" => "Aljabar Linear",
        "sks" => 3,
        "nilai" => 85
    ],
    [
        "nama" => "Struktur Data",
        "sks" => 3,
        "nilai" => 75
    ],
    [
        "nama" => "Bahasa Pemrograman",
        "sks" => 3,
        "nilai" => 65
    ],
    [
        "nama" => "Kalkululs",
        "sks" => 2,
        "nilai" => 45
    ],
    [
        "nama" => "Algoritma dan Pemrograman",
        "sks" => 3,
        "nilai" => 90
    ]
];

// Fungsi untuk menentukan nilai huruf dan bobot
function hitungBobot($nilai)
{
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

// Variabel perhitungan
$totalSKS = 0;
$totalMutu = 0;
$jumlahLulus = 0;
$jumlahMengulang = 0;

// Menghitung total SKS, total mutu, dan jumlah status
foreach ($matkul as $mk) {
    $hasil = hitungBobot($mk["nilai"]);

    $totalSKS += $mk["sks"];
    $totalMutu += $hasil["bobot"] * $mk["sks"];

    if ($hasil["bobot"] >= 2.0) {
        $jumlahLulus++;
    } else {
        $jumlahMengulang++;
    }
}

// Menghitung IPS
$ips = $totalSKS > 0 ? $totalMutu / $totalSKS : 0;

// Menentukan batas SKS semester depan
$batasSKS = $ips >= 3.00 ? 24 : 20;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Nilai Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #222;
            background-color: white;
            margin: 30px 45px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .deskripsi {
            color: #150107;
            margin-bottom: 25px;
        }

        .identitas {
            margin-bottom: 20px;
            line-height: 1.8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #bbb;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #e8e8e8;
            font-weight: bold;
        }

        td.nama {
            text-align: left;
        }

        tr.mengulang {
            background-color: #ffcccc;
            color: #6a0e0e;
        }

        tr.lulus {
            background-color: white;
        }

        .status {
            font-weight: bold;
        }

        h2 {
            font-size: 19px;
            margin-top: 30px;
            margin-bottom: 12px;
        }

        .ringkasan {
            margin-top: 25px;
            border: 1px solid #bbb;
            padding: 15px 20px;
        }

        .ringkasan p {
            margin: 10px 0;
            line-height: 1.5;
        }

        .ips {
            font-size: 20px;
            font-weight: bold;
        }

        .keterangan {
            margin-top: 25px;
            padding: 12px;
            border: 1px solid #ccc;
            background-color: #f7f7f7;
            line-height: 1.8;
        }

        @media (max-width: 700px) {
            body {
                margin: 15px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 7px;
            }

            .tabel-wrapper {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Data Nilai Mahasiswa</h1>

    <p class="deskripsi">
        hasil perhitungan
    </p>

    <div class="identitas">
        <strong>Mata Kuliah:</strong> Pemrograman Web<br>
        <strong>Semester:</strong> Semester 3
    </div>

    <h2>Daftar Nilai Mata Kuliah</h2>

    <div class="tabel-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Matkul</th>
                    <th>SKS</th>
                    <th>Nilai Angka</th>
                    <th>Nilai Huruf</th>
                    <th>Bobot</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($matkul as $index => $mk): ?>
                    <?php
                    $hasil = hitungBobot($mk["nilai"]);

                    $status = $hasil["bobot"] >= 2.0
                        ? "LULUS"
                        : "MENGULANG";

                    $kelas = $status === "MENGULANG"
                        ? "mengulang"
                        : "lulus";
                    ?>

                    <tr class="<?= $kelas ?>">
                        <td><?= $index + 1 ?></td>

                        <td class="nama">
                            <?= htmlspecialchars($mk["nama"]) ?>
                        </td>

                        <td><?= $mk["sks"] ?></td>

                        <td><?= $mk["nilai"] ?></td>

                        <td><?= $hasil["huruf"] ?></td>

                        <td>
                            <?= number_format($hasil["bobot"], 1, ',', '.') ?>
                        </td>

                        <td class="status"><?= $status ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="ringkasan">
        <h2>Ringkasan IPS</h2>

        <p>
            Jumlah mata kuliah:
            <strong><?= count($matkul) ?> mata kuliah</strong>
        </p>

        <p>
            Total SKS:
            <strong><?= $totalSKS ?> SKS</strong>
        </p>

        <p>
            Total nilai mutu:
            <strong><?= number_format($totalMutu, 2, ',', '.') ?></strong>
        </p>

        <p>
            Mata kuliah lulus:
            <strong><?= $jumlahLulus ?> mata kuliah</strong>
        </p>

        <p>
            Mata kuliah mengulang:
            <strong><?= $jumlahMengulang ?> mata kuliah</strong>
        </p>

        <p>Indeks Prestasi Semester (IPS):</p>

        <div class="ips">
            <?= number_format($ips, 2, ',', '.') ?>
        </div>

        <p>
            Batas maksimal SKS semester depan:
            <strong><?= $batasSKS ?> SKS</strong>
        </p>
    </div>

    <div class="keterangan">
        <strong>Keterangan Penilaian</strong><br>
        A = 80–100, bobot 4,0<br>
        B = 70–79, bobot 3,0<br>
        C = 60–69, bobot 2,0<br>
        D = 50–59, bobot 1,0<br>
        E = 0–49, bobot 0,0<br><br>

        <strong>Keterangan Status</strong><br>
        LULUS = Bobot minimal 2,0<br>
        MENGULANG = Bobot di bawah 2,0<br><br>

        <strong>Ketentuan SKS Semester Depan</strong><br>
        IPS >= 3,00: maksimal 24 SKS<br>
        IPS < 3,00: maksimal 20 SKS
    </div>

</div>
</body>
</html>