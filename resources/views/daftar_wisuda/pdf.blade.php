<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulir Permohonan Wisuda</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 25px;
        }

        .header-logo {
            text-align: center;
            margin-bottom: 5px;
        }

        .header-logo img {
            width: 80px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        table td, table th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .no-border td {
            border: none !important;
        }

        .section-title {
            font-weight: bold;
            background: #eee;
            text-align: left;
            padding: 3px;
        }

        .signature-box {
            height: 60px;
            vertical-align: bottom;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
        }

        .small-text {
            font-size: 9px;
        }

        .info-row td {
            height: 30px;
        }
    </style>
</head>

<body>

    <!-- HEADER 
    <div class="header-logo">
        <img src="logo_horizon.png" alt="Logo">
    </div>-->

    <div class="title">
        APPLICATION FOR GRADUATION<br>
        <hr style="border: none; border-top: 1px solid #000; margin: 3px 0;">
        FORMULIR PERMOHONAN WISUDA
    </div>

    <!-- INSTRUCTION TEXT -->
    <table class="no-border">
        <tr>
            <td style="font-size: 9px; padding: 2px 0;">
                <i>Please fill out the required information/ Mohon lengkapi data yang diminta</i>
            </td>
        </tr>
    </table>

    <!-- EXPECTED GRADUATION DATE -->
    <table>
        <tr>
            <td width="60%"><b>Expected Date of Graduation / Tanggal perkiraan wisuda:</b></td>
            <td>{{ $data->tgl_perkiraan_wisuda }}</td>
        </tr>
    </table>

    <!-- STUDENT INFO -->
    <table>
        <tr>
            <td class="section-title" colspan="4">Student Information / Informasi Mahasiswa</td>
        </tr>

        <tr class="info-row">
            <td width="40%" colspan="2"><b>Name/ Nama:</b><br>{{ $data->mahasiswa->nama_mahasiswa }}</td>
            <td width="60%" colspan="2"><b>Student ID/NIM:</b><br>{{ $data->mahasiswa->nim }}</td>
        </tr>

        <tr class="info-row">
            <td width="25%"><b>College/Fakultas</b><br>{{ $data->mahasiswa->fakultas }}</td>
            <td width="25%"><b>Degree/Jenjang</b><br>{{ $data->mahasiswa->jenjang }}</td>
            <td width="25%"><b>Major/Jurusan</b><br>{{ $data->mahasiswa->prodi }}</td>
            <td width="25%"><b>Mobile Phone/No HP</b><br>{{ $data->no_hp }}<br><b>Email:</b><br>{{ $data->email ?? '' }}</td>
        </tr>

        <tr class="info-row">
            <td colspan="4"><b>Address/Alamat:</b><br>{{ $data->mahasiswa->alamat }}</td>
        </tr>
    </table>

    <!-- LAST CURRICULAR LOAD -->
    <table>
        <tr>
            <td class="section-title" colspan="4">Last Curricular Load / Beban Studi Terakhir</td>
        </tr>
        <tr>
            <td width="40%"><b>Student's Signature/ Tanda tangan mahasiswa</b><br><br><br></td>
            <td colspan="3"><b>Date/Tanggal</b><br>{{ $data->tgl_pendaftaran }}</td>
        </tr>
    </table>

    <!-- PEN TABLE -->
    <table>
        <tr>
            <th width="15%">PEN Code/ Kode PEN</th>
            <th width="40%">Descriptive Title/Judul Deskriptif</th>
            <th width="25%">Faculty Signature / Tanda tangan Dosen</th>
            <th width="20%">Final Grade/ Nilai Akhir</th>
        </tr>

        <tr>
            <td style="height:100px;"></td>
            <td style="white-space: pre-line; vertical-align: top;">{{ $data->judul_skripsi }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <!-- WARNING TEXT -->
    <table class="no-border">
        <tr>
            <td style="font-size: 9px; padding: 4px 0; text-align: justify;">
                Only those students who have satisfied the academic and non-academic requirements of their degrees by the end of the term shall be allowed to graduate
            </td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding: 4px 0; text-align: justify;">
                Hanya mahasiswa yang telah memenuhi seluruh persyaratan akademik dan non-akademik program studinya hingga akhir semester yang diperbolehkan untuk mengikuti proses kelulusan.
            </td>
        </tr>
    </table>

    <!-- SIGNATURE NAME PRINTED -->
    <table>
        <tr>
            <td style="font-size: 9px; padding: 2px 4px;"><i>Signature Name Printed/ Tanda Tangan di atas Nama Jelas</i></td>
        </tr>
    </table>

    <!-- FINAL SECTION -->
    <table>
        <tr>
            <td class="signature-box" width="33%">
                <b>Student/ Mahasiswa:</b><br><br><br><br>
                {{ $data->mahasiswa->nama_mahasiswa }}
            </td>

            <td class="signature-box" width="33%">
                <b>Program Head/Kepala program studi:</b><br><br><br><br>
            </td>

            <td class="signature-box" width="34%">
                <b>Dean/ Dekan:</b><br><br><br><br>
            </td>
        </tr>
        <tr>
            <td><b>Date/Tanggal:</b><br>{{ $data->tgl_pendaftaran }}</td>
            <td><b>Date/Tanggal:</b></td>
            <td><b>Date/Tanggal:</b></td>
        </tr>
    </table>

    <!-- PRIVACY DISCLAIMER -->
    <table class="no-border">
        <tr>
            <td class="small-text" style="text-align: justify; padding: 8px 0;">
                The personal data obtained from the data subject or an individual is entered and stored within the company authorized information and communication systems, for the purpose allowed under applicable laws and regulations and will only be accessed by the authorized personnel. (School) has instituted appropriate organizational, technical and physical security measures to ensure the protection of the collected personal data. Furthermore, the information collected will be shared and/or made available to CITED and/or any other interested parties in order to pursue lawful purposes and legitimate interest and comply with legal mandate, and only be used for the purpose of operations and will never be disclosed to anyone without prior authorization or consent
            </td>
        </tr>
        <tr>
            <td class="small-text" style="text-align: justify; padding: 0 0 8px 0;">
                Data pribadi yang diperoleh dari subjek data atau individu akan dimasukkan dan disimpan dalam sistem informasi dan komunikasi yang diotorisasi oleh perusahaan (sekolah), sesuai dengan jangka waktu yang ditentukan berdasarkan peraturan perundang-undangan yang berlaku, dan hanya dapat diakses oleh personel yang berwenang. (Sekolah) telah menerapkan langkah-langkah pengamanan secara organisasi, teknis, dan fisik untuk melindungi data pribadi yang dikumpulkan. Selain itu, informasi yang dikumpulkan dapat dibagikan kepada dan tersedia bagi CITED dan/atau pihak terkait lainnya guna menjalankan tujuan yang sah, kepentingan yang sah, dan mematuhi amanat hukum. Data ini hanya akan digunakan untuk keperluan operasional dan tidak akan diungkapkan kepada pihak lain tanpa persetujuan terlebih dahulu.
            </td>
        </tr>
    </table>

    <!-- FINAL SIGNATURE NAME PRINTED -->
    <table>
        <tr>
            <td width="50%"><i>Signature Name Printed/ Tanda Tangan di atas Nama Jelas</i><br><br><br>{{ $data->mahasiswa->nama_mahasiswa }}</td>
            <td width="50%"><b>Date/Tanggal</b><br><br><br>{{ $data->tgl_pendaftaran }}</td>
        </tr>
    </table>

    <div class="footer">
        Jl. Pangkal Perjuangan KM 1, Tanjungpura, Karawang Barat, Kabupaten Karawang, Jawa Barat, Indonesia 41316
    </div>

</body>
</html>