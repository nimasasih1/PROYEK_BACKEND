<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulir Permohonan Wisuda</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 30px 35px;
            color: #000;
        }

        /* ── HEADER ── */
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-bottom: 6px;
        }
        .header img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }
        .header-text {
            text-align: left;
        }
        .header-text .univ-name {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            line-height: 1.2;
        }
        .header-text .univ-sub {
            font-size: 11px;
            letter-spacing: 3px;
        }
        .header-divider {
            border: none;
            border-top: 3px solid #000;
            margin: 4px 0 2px;
        }
        .header-divider-thin {
            border: none;
            border-top: 1px solid #000;
            margin: 2px 0 10px;
        }

        /* ── TITLE ── */
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            margin: 10px 0 4px;
            letter-spacing: 0.5px;
        }
        .title-sub {
            text-align: center;
            font-size: 11px;
            margin-bottom: 10px;
        }
        .title-divider {
            border: none;
            border-top: 1.5px solid #000;
            margin: 4px 0 8px;
        }

        /* ── TABLES ── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        table td, table th {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: top;
            line-height: 1.4;
        }
        table th {
            background: #f0f0f0;
            font-weight: bold;
            text-align: center;
            font-size: 10px;
        }

        .no-border td {
            border: none !important;
            padding: 2px 0;
        }

        .section-title td {
            font-weight: bold;
            background: #e8e8e8;
            text-align: center;
            padding: 5px 6px;
            font-size: 11px;
            border: 1px solid #000;
        }

        /* ── FIELD LABEL ── */
        .field-label {
            font-weight: bold;
            font-size: 10px;
        }
        .field-value {
            font-size: 11px;
            min-height: 16px;
        }

        /* ── SIGNATURE ── */
        .sig-area {
            height: 65px;
        }
        .sig-name {
            border-top: 1px solid #000;
            padding-top: 3px;
            font-size: 11px;
            margin-top: 4px;
        }

        /* ── SMALL TEXT ── */
        .small-text {
            font-size: 9px;
            text-align: justify;
            line-height: 1.5;
        }
        .note-text {
            font-size: 9.5px;
            text-align: justify;
            line-height: 1.5;
            font-style: italic;
        }

        /* ── FOOTER ── */
        .footer {
            text-align: center;
            font-size: 9px;
            margin-top: 14px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        /* ── IPK ROW ── */
        .ipk-row td {
            text-align: center;
        }

        @media print {
            body { margin: 20px 25px; }
        }
    </style>
</head>
<body>

    {{-- ── HEADER LOGO ── --}}
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo Universitas Horizon">
        <div class="header-text">
            <div class="univ-name">UNIVERSITAS HORIZON INDONESIA</div>
            <div class="univ-sub">K A R A W A N G</div>
        </div>
    </div>
    <hr class="header-divider">
    <hr class="header-divider-thin">

    {{-- ── TITLE ── --}}
    <div class="title">APLICATION FOR GRADUATION</div>
    <div class="title-sub">FORMULIR PERMOHONAN WISUDA</div>
    <hr class="title-divider">

    {{-- ── INSTRUCTION ── --}}
    <table class="no-border" style="margin-bottom:6px;">
        <tr>
            <td class="note-text">
                Please fill out the required information/ Mohon lengkapi data yang diminta
            </td>
        </tr>
    </table>

    {{-- ── EXPECTED GRADUATION DATE ── --}}
    <table style="margin-bottom:6px;">
        <tr>
            <td width="55%">
                <span class="field-label">Expected Date of Graduation / Tanggal perkiraan wisuda:</span>
            </td>
            <td>
                <span class="field-value">{{ $data->tgl_perkiraan_wisuda }}</span>
            </td>
        </tr>
    </table>

    {{-- ── STUDENT INFO ── --}}
    <table>
        <tr class="section-title">
            <td colspan="4">Student Information / Informasi Mahasiswa</td>
        </tr>
        <tr>
            <td width="40%" colspan="2" style="height:30px;">
                <div class="field-label">Name / Nama:</div>
                <div class="field-value">{{ $data->mahasiswa->nama_mahasiswa }}</div>
            </td>
            <td width="60%" colspan="2" style="height:30px;">
                <div class="field-label">Student ID / NIM:</div>
                <div class="field-value">{{ $data->mahasiswa->nim }}</div>
            </td>
        </tr>
        <tr>
            <td width="22%" style="height:38px;">
                <div class="field-label">College / Fakultas</div>
                <div class="field-value">{{ $data->mahasiswa->fakultas }}</div>
            </td>
            <td width="18%" style="height:38px;">
                <div class="field-label">Degree / Jenjang</div>
                <div class="field-value">{{ $data->mahasiswa->jenjang }}</div>
            </td>
            <td width="25%" style="height:38px;">
                <div class="field-label">Major / Jurusan</div>
                <div class="field-value">{{ $data->mahasiswa->prodi }}</div>
            </td>
            <td width="35%" style="height:38px;">
                <div class="field-label">Mobile Phone / No HP:</div>
                <div class="field-value">{{ $data->no_hp }}</div>
                <div class="field-label" style="margin-top:2px;">Email:</div>
                <div class="field-value">{{ $data->email ?? '' }}</div>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="height:28px;">
                <div class="field-label">Address / Alamat:</div>
                <div class="field-value">{{ $data->mahasiswa->alamat }}</div>
            </td>
        </tr>
    </table>

    {{-- ── LAST CURRICULAR LOAD ── --}}
    <table>
        <tr class="section-title">
            <td colspan="4">Last Curricular Load / Beban Studi Terakhir</td>
        </tr>
        <tr>
            <td width="50%" style="height:55px;" class="sig-area">
                <div class="field-label">Student's Signature / Tanda tangan mahasiswa</div>
                <br><br>
            </td>
            <td colspan="3">
                <div class="field-label">Date / Tanggal</div>
                <div class="field-value">{{ $data->tgl_pendaftaran }}</div>
            </td>
        </tr>
    </table>

    {{-- ── PEN TABLE ── --}}
    <table>
        <tr>
            <th width="15%">PEN Code / Kode PEN</th>
            <th width="42%">Descriptive Title / Judul Deskriptif</th>
            <th width="25%">Faculty Signature / Tanda tangan Dosen</th>
            <th width="18%">Final Grade / Nilai Akhir</th>
        </tr>
        <tr>
            <td style="height:80px; text-align:center;"></td>
            <td style="white-space: pre-line; vertical-align:top; padding: 6px;">{{ $data->judul_skripsi }}</td>
            <td style="height:80px;"></td>
            <td style="text-align:center; font-weight:bold; font-size:13px;">
                {{ $data->ipk ?? '' }}
            </td>
        </tr>
        <tr>
            <td style="height:22px;"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="height:22px;"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    {{-- ── WARNING ── --}}
    <table class="no-border" style="margin: 5px 0;">
        <tr>
            <td class="note-text">
                Only those students who have satisfied the academic and non-academic requirements of their degrees by the end of the term shall be allowed to graduate
            </td>
        </tr>
        <tr>
            <td class="note-text" style="margin-top:3px;">
                Hanya mahasiswa yang telah memenuhi seluruh persyaratan akademik dan non-akademik program studinya hingga akhir semester yang diperbolehkan untuk mengikuti proses kelulusan.
            </td>
        </tr>
    </table>

    {{-- ── SIGNATURE LABEL ── --}}
    <table style="margin-bottom:3px;">
        <tr>
            <td style="border:1px solid #000; padding: 3px 6px;">
                <span style="font-size:9.5px; font-style:italic;">
                    Signature Name Printed / Tanda Tangan di atas Nama Jelas
                </span>
            </td>
        </tr>
    </table>

    {{-- ── FINAL SIGNATURES ── --}}
    <table>
        <tr>
            <td width="33%" style="height:70px; vertical-align:bottom; padding: 6px;">
                <div class="field-label">Student / Mahasiswa:</div>
                <br><br><br>
                <div class="sig-name">{{ $data->mahasiswa->nama_mahasiswa }}</div>
            </td>
            <td width="33%" style="height:70px; vertical-align:bottom; padding: 6px;">
                <div class="field-label">Program Head / Kepala Program Studi:</div>
                <br><br><br>
                <div class="sig-name">&nbsp;</div>
            </td>
            <td width="34%" style="height:70px; vertical-align:bottom; padding: 6px;">
                <div class="field-label">Dean / Dekan:</div>
                <br><br><br>
                <div class="sig-name">&nbsp;</div>
            </td>
        </tr>
        <tr>
            <td style="padding: 4px 6px;">
                <span class="field-label">Date / Tanggal:</span><br>
                <span class="field-value">{{ $data->tgl_pendaftaran }}</span>
            </td>
            <td style="padding: 4px 6px;">
                <span class="field-label">Date / Tanggal:</span>
            </td>
            <td style="padding: 4px 6px;">
                <span class="field-label">Date / Tanggal:</span>
            </td>
        </tr>
    </table>

    {{-- ── PRIVACY DISCLAIMER ── --}}
    <table class="no-border" style="margin: 8px 0;">
        <tr>
            <td class="small-text">
                The personal data obtained from the data subject or an individual is entered and stored within the company authorized information and communication systems, for the purpose allowed under applicable laws and regulations and will only be accessed by the authorized personnel. (School) has instituted appropriate organizational, technical and physical security measures to ensure the protection of the collected personal data. Furthermore, the information collected will be shared and/or made available to CITED and/or any other interested parties in order to pursue lawful purposes and legitimate interest and comply with legal mandate, and only be used for the purpose of operations and will never be disclosed to anyone without prior authorization or consent
            </td>
        </tr>
        <tr>
            <td class="small-text" style="padding-top:4px;">
                Data pribadi yang diperoleh dari subjek data atau individu akan dimasukkan dan disimpan dalam sistem informasi dan komunikasi yang diotorisasi oleh perusahaan (sekolah), sesuai dengan jangka waktu yang ditentukan berdasarkan peraturan perundang-undangan yang berlaku, dan hanya dapat diakses oleh personel yang berwenang. (Sekolah) telah menerapkan langkah-langkah pengamanan secara organisasi, teknis, dan fisik untuk melindungi data pribadi yang dikumpulkan. Selain itu, informasi yang dikumpulkan dapat dibagikan kepada dan tersedia bagi CITED dan/atau pihak terkait lainnya guna menjalankan tujuan yang sah, kepentingan yang sah, dan mematuhi amanat hukum. Data ini hanya akan digunakan untuk keperluan operasional dan tidak akan diungkapkan kepada pihak lain tanpa persetujuan terlebih dahulu.
            </td>
        </tr>
    </table>

    {{-- ── FINAL SIGNATURE NAME ── --}}
    <table>
        <tr>
            <td width="50%" style="padding: 4px 6px;">
                <span style="font-size:9.5px; font-style:italic;">
                    Signature Name Printed / Tanda Tangan di atas Nama Jelas
                </span>
                <br><br><br>
                <span class="field-value">{{ $data->mahasiswa->nama_mahasiswa }}</span>
            </td>
            <td width="50%" style="padding: 4px 6px;">
                <span class="field-label">Date / Tanggal</span>
                <br><br><br>
                <span class="field-value">{{ $data->tgl_pendaftaran }}</span>
            </td>
        </tr>
    </table>

    {{-- ── FOOTER ── --}}
    <div class="footer">
        Jl. Pangkal Perjuangan KM 1, Tanjungpura, Karawang Barat, Kabupaten Karawang, Jawa Barat, Indonesia 41316
    </div>

</body>
</html>