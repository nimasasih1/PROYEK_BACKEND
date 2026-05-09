<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SKPI - {{ $data->mahasiswa->nama_mahasiswa ?? 'Diploma Supplement' }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Times New Roman', Times, serif;
            background: #e8e8e8;
            padding: 30px 20px;
            font-size: 10.5pt;
            line-height: 1.55;
            color: #111;
        }

        /* ===== TOMBOL PRINT ===== */
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 22px;
            background: #980517;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-family: Arial, sans-serif;
            box-shadow: 0 2px 8px rgba(0,0,0,0.25);
            z-index: 9999;
        }
        .print-button:hover { background: #c0061e; }

        /* ===== HALAMAN ===== */
        .page {
            max-width: 210mm;
            margin: 0 auto 30px auto;
            background: white;
            padding: 14mm 18mm 22mm 18mm;
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
            position: relative;
            min-height: 270mm;
        }

        /* ===== HEADER UNIVERSITAS ===== */
        .univ-header {
            display: table;
            width: 100%;
            padding-bottom: 10px;
            border-bottom: 3px solid #980517;
            margin-bottom: 6px;
        }
        .univ-header-logo {
            display: table-cell;
            width: 75px;
            vertical-align: middle;
        }
        .univ-header-logo img {
            width: 65px;
            height: 65px;
            object-fit: contain;
        }
        .univ-header-text {
            display: table-cell;
            vertical-align: middle;
            padding-left: 12px;
        }
        .univ-name {
            font-size: 16pt;
            font-weight: bold;
            letter-spacing: 1px;
            color: #111;
            line-height: 1.2;
        }
        .univ-sub {
            font-size: 10pt;
            letter-spacing: 4px;
            color: #555;
            margin-top: 3px;
        }
        .univ-divider {
            border: none;
            border-top: 1px solid #bbb;
            margin: 6px 0 12px 0;
        }

        /* ===== NAMA PEMOHON ===== */
        .applicant-tag {
            text-align: right;
            font-size: 9pt;
            color: #555;
            font-style: italic;
            margin-bottom: 14px;
        }

        /* ===== JUDUL ===== */
        .title-wrap { text-align: center; margin-bottom: 16px; }
        .title-main { font-size: 14pt; font-weight: bold; letter-spacing: 0.5px; }
        .title-sub  { font-size: 12pt; font-weight: bold; font-style: italic; margin-top: 3px; color: #222; }

        /* ===== PARAGRAF PENGANTAR ===== */
        .intro { font-size: 10pt; text-align: justify; margin-bottom: 7px; line-height: 1.6; }
        .intro.italic { font-style: italic; margin-bottom: 18px; color: #333; }

        /* ===== JUDUL SECTION ===== */
        .section-title {
            font-size: 10pt;
            font-weight: bold;
            margin: 18px 0 8px 0;
            line-height: 1.5;
        }
        .section-title .en {
            font-style: italic;
            font-weight: normal;
            display: block;
        }

        /* ===== TABEL INFO 2x2 (BAAK style) ===== */
        .info-grid {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            margin-bottom: 4px;
        }
        .info-grid td {
            padding: 5px 9px;
            vertical-align: top;
            border: 1px solid #bbb;
            width: 25%;
        }
        .info-grid td.lbl {
            background: #f7f7f7;
            font-size: 9.5pt;
        }
        .info-grid td.lbl em {
            display: block;
            font-style: italic;
            color: #777;
            font-size: 8.5pt;
            margin-top: 1px;
        }
        .info-grid td.val {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 9.5pt;
        }

        /* ===== DUA KOLOM KONTEN ===== */
        .two-col {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 0;
            margin-bottom: 14px;
        }
        .two-col td { width: 50%; vertical-align: top; }
        .col-title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9.5pt;
            margin-bottom: 5px;
            padding-bottom: 3px;
            border-bottom: 1.5px solid #980517;
            color: #111;
        }
        .col-content {
            font-size: 9.5pt;
            white-space: pre-wrap;
            word-break: break-word;
            text-align: justify;
            min-height: 120px;
            border: 1px solid #ccc;
            padding: 8px 10px;
            line-height: 1.6;
            text-transform: uppercase;
            background: #fefefe;
        }

        /* ===== TANDA TANGAN ===== */
        .signature-wrap { margin-top: 32px; text-align: right; }
        .city-date { margin-bottom: 60px; font-size: 10.5pt; }
        .sig-line {
            display: inline-block;
            width: 220px;
            border-top: 1px solid #111;
            padding-top: 5px;
            text-align: center;
        }
        .sig-name { font-weight: bold; font-size: 10.5pt; text-transform: uppercase; }
        .sig-role { font-size: 9.5pt; color: #444; }

        /* ===== FOOTER TIAP HALAMAN ===== */
        .page-footer {
            position: absolute;
            bottom: 8mm;
            left: 18mm;
            right: 18mm;
            text-align: center;
            font-size: 9pt;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 5px;
            font-style: italic;
        }

        /* ===== PRINT ===== */
        @media print {
            body { background: white; padding: 0; }
            .page {
                box-shadow: none;
                margin: 0;
                padding: 14mm 18mm 22mm 18mm;
                max-width: 100%;
                min-height: auto;
                page-break-after: always;
            }
            .page:last-child { page-break-after: auto; }
            .print-button { display: none; }
        }
    </style>
</head>
<body>

<button class="print-button" onclick="window.print()">🖨️ Cetak SKPI</button>

{{-- ========================= HALAMAN 1 ========================= --}}
<div class="page">

    {{-- HEADER UNIVERSITAS --}}
    <div class="univ-header">
        <div class="univ-header-logo">
            <img
                src="{{ public_path('images/logoh.png') }}"
                onerror="this.src='{{ asset('images/logoh.png') }}'"
                alt="Logo Universitas Horizon Indonesia"
            >
        </div>
        <div class="univ-header-text">
            <div class="univ-name">HORIZON UNIVERSITY INDONESIA</div>
            <div class="univ-sub">K A R A W A N G</div>
        </div>
    </div>
    <hr class="univ-divider">

    <div class="applicant-tag">
        Name of applicant / ID :
        <strong>{{ $data->mahasiswa->nama_mahasiswa ?? '-' }}</strong> /
        {{ $data->mahasiswa->nim ?? '-' }}
    </div>

    <div class="title-wrap">
        <div class="title-main">SURAT KETERANGAN PENDAMPING IJAZAH</div>
        <div class="title-sub">DIPLOMA SUPPLEMENT</div>
    </div>

    <p class="intro">
        Surat Keterangan Pendamping Ijazah (SKPI) ini mengacu pada Kerangka Kualifikasi Nasional Indonesia (KKNI)
        dan Konvensi UNESCO tentang pengakuan studi, ijazah dan gelar pendidikan tinggi. Tujuan dari SKPI ini
        adalah menjadi dokumen yang memberikan data tambahan yang menjelaskan tentang capaian pembelajaran,
        kemampuan kerja, penguasaan pengetahuan, dan sikap pemegangnya.
    </p>
    <p class="intro italic">
        This Diploma Supplement was developed based on Indonesian National Qualification Framework (KKNI) and
        UNESCO Convention. The purpose of the supplement is to provide sufficient independent data describing
        the nature, level, context, content and status of the studies that were pursued and successfully
        completed by the individual named on the original qualification to which this supplement is appended.
    </p>

    <div class="section-title">
        01. INFORMASI TENTANG IDENTITAS DIRI PEMEGANG SKPI
        <span class="en">01. INFORMATION IDENTIFYING THE HOLDER OF THE DIPLOMA SUPPLEMENT</span>
    </div>

    <table class="info-grid">
        <tr>
            <td class="lbl">NAMA LENGKAP <em>Full Name</em></td>
            <td class="val">{{ $data->mahasiswa->nama_mahasiswa ?? '-' }}</td>
            <td class="lbl">TAHUN LULUS <em>Year of Completion</em></td>
            <td class="val">{{ $data->tahun_lulus ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">TEMPAT TANGGAL LAHIR <em>Date and Place of Birth</em></td>
            <td class="val">{{ $data->tempat_lahir ?? '-' }}, {{ $data->mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($data->mahasiswa->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</td>
            <td class="lbl">NOMOR IJAZAH <em>Diploma Number</em></td>
            <td class="val">{{ $data->no_ijazah ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">NOMOR INDUK MAHASISWA <em>Student Identification Number</em></td>
            <td class="val">{{ $data->mahasiswa->nim ?? '-' }}</td>
            <td class="lbl">GELAR <em>Name of Qualification</em></td>
            <td class="val">{{ $data->gelar ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title" style="margin-top:16px;">
        02. INFORMASI TENTANG IDENTITAS PENYELENGGARA PROGRAM
        <span class="en">02. INFORMATION IDENTIFYING THE INSTITUTION ADMINISTERING STUDIES</span>
    </div>

    <table class="info-grid">
        <tr>
            <td class="lbl">SK PENDIRIAN PERGURUAN TINGGI <em>Higher Education Institution's License</em></td>
            <td class="val">{{ $data->sk_pendirian_perti ?? '-' }}</td>
            <td class="lbl">PERSYARATAN PENERIMAAN <em>Entry Requirements</em></td>
            <td class="val">{{ $data->persyaratan_penerimaan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">NAMA PERGURUAN TINGGI <em>Name of Institution Administering Studies</em></td>
            <td class="val">{{ $data->nama_perti ?? 'UNIVERSITAS HORIZON INDONESIA' }}</td>
            <td class="lbl">BAHASA PENGANTAR KULIAH <em>Language of Instruction</em></td>
            <td class="val">{{ $data->bahasa_pengantar_kuliah ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">PROGRAM STUDI <em>Study Program</em></td>
            <td class="val">{{ $data->mahasiswa->prodi ?? '-' }}</td>
            <td class="lbl">SISTEM PENILAIAN <em>Grading System</em></td>
            <td class="val">{{ $data->sistem_penilaian ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">KELAS <em>Mode of Study</em></td>
            <td class="val">{{ $data->kelas ?? '-' }}</td>
            <td class="lbl">LAMA STUDI REGULER <em>Length of Study</em></td>
            <td class="val">{{ $data->lama_studi_rg ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">JENIS & JENJANG PENDIDIKAN <em>Type & Level of Education</em></td>
            <td class="val">{{ $data->mahasiswa->jenjang ?? '-' }}</td>
            <td class="lbl">JENJANG PENDIDIKAN LANJUTAN <em>Access to Further Study</em></td>
            <td class="val">{{ $data->jenjang_pd_lanjutan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">JENJANG KUALIFIKASI SESUAI KKNI <em>Level of Qualification in KKNI</em></td>
            <td class="val">{{ $data->jenjang_kualif_kkn1 ?? '-' }}</td>
            <td class="lbl">STATUS PROFESI (BILA ADA) <em>Professional Status (If Applicable)</em></td>
            <td class="val">{{ $data->status_profesi ?? '-' }}</td>
        </tr>
    </table>

    <div class="page-footer">
        Name of applicant / ID : {{ $data->mahasiswa->nama_mahasiswa ?? '-' }} / {{ $data->mahasiswa->nim ?? '-' }}
    </div>
</div>

{{-- ========================= HALAMAN 2 ========================= --}}
<div class="page">

    <div class="univ-header">
        <div class="univ-header-logo">
            <img src="{{ asset('images/logoh.png') }}" alt="Logo">
        </div>
        <div class="univ-header-text">
            <div class="univ-name">HORIZON UNIVERSITY INDONESIA</div>
            <div class="univ-sub">K A R A W A N G</div>
        </div>
    </div>
    <hr class="univ-divider">

    <div class="section-title">
        03. INFORMASI TENTANG CAPAIAN PEMBELAJARAN
        <span class="en">03. INFORMATION ON LEARNING OUTCOMES</span>
    </div>

    <table class="two-col">
        <tr>
            <td>
                <div class="col-title">Kemampuan Kerja</div>
                <div class="col-content">{{ $data->kemampuan_kerja ?? '-' }}</div>
            </td>
            <td>
                <div class="col-title">Skills</div>
                <div class="col-content">{{ $data->kemampuan_kerja ?? '-' }}</div>
            </td>
        </tr>
    </table>

    <table class="two-col" style="margin-top:14px;">
        <tr>
            <td>
                <div class="col-title">Penguasaan Pengetahuan</div>
                <div class="col-content">{{ $data->penguasaan_pengetahuan ?? '-' }}</div>
            </td>
            <td>
                <div class="col-title">Knowledge</div>
                <div class="col-content">{{ $data->penguasaan_pengetahuan ?? '-' }}</div>
            </td>
        </tr>
    </table>

    <div class="page-footer">
        Name of applicant / ID : {{ $data->mahasiswa->nama_mahasiswa ?? '-' }} / {{ $data->mahasiswa->nim ?? '-' }}
    </div>
</div>

{{-- ========================= HALAMAN 3 ========================= --}}
<div class="page">

    <div class="univ-header">
        <div class="univ-header-logo">
            <img src="{{ asset('images/logoh.png') }}" alt="Logo">
        </div>
        <div class="univ-header-text">
            <div class="univ-name">HORIZON UNIVERSITY INDONESIA</div>
            <div class="univ-sub">K A R A W A N G</div>
        </div>
    </div>
    <hr class="univ-divider">

    <table class="two-col">
        <tr>
            <td>
                <div class="col-title">Aktivitas, Prestasi dan Penghargaan</div>
                <div class="col-content">{{ $data->aktiv_pres_penghargaan ?? '-' }}</div>
            </td>
            <td>
                <div class="col-title">Activities, Achievement and Awards</div>
                <div class="col-content">{{ $data->aktiv_pres_penghargaan ?? '-' }}</div>
            </td>
        </tr>
    </table>

    <table class="two-col" style="margin-top:22px;">
        <tr>
            <td>
                <div class="col-title">Magang</div>
                <div class="col-content">{{ $data->magang ?? '-' }}</div>
            </td>
            <td>
                <div class="col-title">Internship</div>
                <div class="col-content">{{ $data->magang ?? '-' }}</div>
            </td>
        </tr>
    </table>

    <div class="page-footer">
        Name of applicant / ID : {{ $data->mahasiswa->nama_mahasiswa ?? '-' }} / {{ $data->mahasiswa->nim ?? '-' }}
    </div>
</div>

{{-- ========================= HALAMAN 4 ========================= --}}
<div class="page">

    <div class="univ-header">
        <div class="univ-header-logo">
            <img src="{{ asset('images/logoh.png') }}" alt="Logo">
        </div>
        <div class="univ-header-text">
            <div class="univ-name">HORIZON UNIVERSITY INDONESIA</div>
            <div class="univ-sub">K A R A W A N G</div>
        </div>
    </div>
    <hr class="univ-divider">

    <div class="section-title">
        04. INFORMASI TENTANG SISTEM PENDIDIKAN TINGGI DI INDONESIA
        <span class="en">04. INFORMATION ON INDONESIAN HIGHER EDUCATION SYSTEM</span>
    </div>

    <table class="info-grid">
        <tr>
            <td class="lbl">Jenjang Pendidikan dan Syarat Belajar <em>Levels of Education and Conditions of Learning</em></td>
            <td class="val" style="text-transform:none; font-weight:normal;">{{ $data->jenjangpend_syaratbelajar ?? '-' }}</td>
            <td class="lbl">SKS dan Lama Studi <em>Semester Credit Unit and Duration of Study</em></td>
            <td class="val" style="text-transform:none; font-weight:normal;">{{ $data->sks_lamastudi ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title" style="margin-top:20px;">
        05. INFORMASI TENTANG KERANGKA KUALIFIKASI NASIONAL INDONESIA
        <span class="en">05. INFORMATION ON INDONESIAN QUALIFICATION FRAMEWORK (KKNI)</span>
    </div>

    <div style="border:1px solid #bbb; padding:10px 12px; min-height:70px; font-size:10pt; line-height:1.6; background:#fefefe;">
        {{ $data->info_kkni ?? '-' }}
    </div>

    <div class="section-title" style="margin-top:20px;">
        06. PENGESAHAN SKPI &nbsp;/&nbsp; 06. CERTIFICATION OF THE SUPPLEMENT
        <span class="en">06. CERTIFICATION OF THE SUPPLEMENT</span>
    </div>

    <div class="signature-wrap">
        <div class="city-date">
            {{ $data->kota ?? 'Cikarang' }},
            {{ $data->tanggal_skpi
                ? \Carbon\Carbon::parse($data->tanggal_skpi)->translatedFormat('d F Y')
                : date('d F Y') }}
        </div>
        <div class="sig-line">
            <div class="sig-name">{{ $data->nama_dekan ?? '_______________________' }}</div>
            <div class="sig-role">Dekan Fakultas</div>
        </div>
    </div>

    <div class="page-footer">
        Name of applicant / ID : {{ $data->mahasiswa->nama_mahasiswa ?? '-' }} / {{ $data->mahasiswa->nim ?? '-' }}
    </div>
</div>

</body>
</html>