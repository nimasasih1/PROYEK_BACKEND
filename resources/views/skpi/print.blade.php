<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKPI - {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            background: #f5f5f5;
            padding: 20px;
            font-size: 11pt;
            line-height: 1.6;
        }
        
        .container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            padding: 20mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .header {
            text-align: right;
            margin-bottom: 20px;
            font-size: 10pt;
            color: #666;
        }
        
        .title-section {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .title-main {
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        
        .title-sub {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .description {
            font-size: 10pt;
            text-align: justify;
            margin-bottom: 10px;
            line-height: 1.5;
        }
        
        .description-en {
            font-style: italic;
            margin-bottom: 25px;
        }
        
        .section-number {
            font-size: 11pt;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }
        
        /* STYLE UNTUK TABEL KOTAK */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 2px solid #000;
        }
        
        .data-table tr {
            border-bottom: 1px solid #000;
        }
        
        .data-table tr:last-child {
            border-bottom: none;
        }
        
        .data-table td {
            padding: 8px 12px;
            vertical-align: top;
            border-right: 1px solid #000;
        }
        
        .data-table td:last-child {
            border-right: none;
        }
        
        .data-table .label-cell {
            width: 40%;
            font-size: 10pt;
            line-height: 1.4;
        }
        
        .data-table .label-id {
            display: block;
            margin-bottom: 2px;
        }
        
        .data-table .label-en {
            display: block;
            font-style: italic;
            font-size: 9pt;
        }
        
        .data-table .value-cell {
            width: 60%;
            font-weight: bold;
            font-size: 11pt;
        }
        
        .competency-section {
            margin: 20px 0;
        }
        
        .competency-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-size: 11pt;
        }
        
        .competency-list {
            margin-left: 0;
            padding-left: 0;
        }
        
        .competency-item {
            margin-bottom: 12px;
            text-align: justify;
        }
        
        .competency-item-title {
            font-weight: bold;
        }
        
        .two-column {
            display: flex;
            gap: 40px;
            margin-top: 20px;
        }
        
        .column {
            flex: 1;
        }
        
        .signature-section {
            margin-top: 40px;
            text-align: center;
        }
        
        .signature-location {
            text-align: right;
            margin-bottom: 80px;
            font-size: 11pt;
        }
        
        .signature-title {
            font-weight: bold;
            margin-top: 5px;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: #980517;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        
        .print-button:hover {
            background: #c41e2e;
        }
        
        .content-box {
    min-height: 50px;  /* ← LEBIH KECIL LAGI */
    padding: 6px;      
    border: 1px solid #ddd;
    background: #f9f9f9;
    text-align: justify;
    font-size: 8.5pt;  
    line-height: 1.4;
}
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .container {
                box-shadow: none;
                max-width: 100%;
                padding: 15mm;
            }
            
            .print-button {
                display: none;
            }
            
            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">🖨️ Cetak SKPI</button>
    
    <div class="container">
        <!-- HALAMAN 1 -->
        <div class="header">
            {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }} / {{ $skpi->mahasiswa->nim ?? '' }}
        </div>
        
        <div class="title-section">
            <div class="title-main">SURAT KETERANGAN PENDAMPING IJAZAH</div>
            <div class="title-sub">DIPLOMA SUPPLEMENT</div>
        </div>
        
        <div class="description">
            Surat Keterangan Pendamping Ijazah (SKPI) ini mengacu pada Kerangka Kualifikasi Nasional Indonesia (KKNI) dan Konvensi UNESCO tentang pengakuan studi, ijazah dan gelar pendidikan tinggi. Tujuan dari SKPI ini adalah menjadi dokumen yang memberikan data tambahan yang menjelaskan tentang capaian pembelajaran, kemampuan kerja, penguasaan pengetahuan, dan sikap pemegangnya.
        </div>
        
        <div class="description description-en">
            This Diploma Supplement was developed based on Indonesian National Qualification Framework (KKNI) and UNESCO Convention. The purpose of the supplement is to provide sufficient independent data describing the nature, level, context, content and status of the studies that were pursued and successfully completed by the individual named on the original qualification to which this supplement is appended.
        </div>
        
        <!-- SECTION 01 - DENGAN TABEL KOTAK -->
        <div class="section-number">
            01. INFORMASI TENTANG IDENTITAS DIRI PEMEGANG SKPI<br>
            01. INFORMATION IDENTIFYING THE HOLDER OF THE DIPLOMA SUPPLEMENT
        </div>
        
        <table class="data-table">
            <tr>
                <td class="label-cell">
                    <span class="label-id">NAMA LENGKAP</span>
                    <span class="label-en">Full Name</span>
                </td>
                <td class="value-cell">{{ $skpi->mahasiswa->nama_mahasiswa ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">TAHUN LULUS</span>
                    <span class="label-en">Year of completion</span>
                </td>
                <td class="value-cell">{{ $skpi->tahun_lulus ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">TEMPAT TANGGAL LAHIR</span>
                    <span class="label-en">Date and Place Birth</span>
                </td>
                <td class="value-cell">
                    {{ $skpi->tempat_lahir ?? '-' }}, 
                    {{ $skpi->mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($skpi->mahasiswa->tanggal_lahir)->format('d F Y') : '-' }}
                </td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">NOMOR IJAZAH</span>
                    <span class="label-en">Diploma Number</span>
                </td>
                <td class="value-cell">{{ $skpi->no_ijazah ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">NOMOR INDUK MAHASISWA</span>
                    <span class="label-en">Student Identification Number</span>
                </td>
                <td class="value-cell">{{ $skpi->mahasiswa->nim ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">GELAR</span>
                    <span class="label-en">Name of Qualification</span>
                </td>
                <td class="value-cell">{{ $skpi->gelar ?? '-' }}</td>
            </tr>
        </table>
        
        <!-- SECTION 02 - DENGAN TABEL KOTAK -->
        <div class="section-number">
            02. INFORMASI TENTANG IDENTITAS PENYELENGGARA PROGRAM<br>
            02. INFORMATION IDENTIFYING THE INSTITUTION ADMINISTERING STUDIES
        </div>
        
        <table class="data-table">
            <tr>
                <td class="label-cell">
                    <span class="label-id">SK PENDIRIAN PERGURUAN TINGGI</span>
                    <span class="label-en">Higher Education Institution's License</span>
                </td>
                <td class="value-cell">{{ $skpi->sk_pendirian_perti ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">PERSYARATAN PENERIMAAN</span>
                    <span class="label-en">Entry Requirements</span>
                </td>
                <td class="value-cell">{{ $skpi->persyaratan_penerimaan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">NAMA PERGURUAN TINGGI</span>
                    <span class="label-en">Name of Institution Administering Studies</span>
                </td>
                <td class="value-cell">{{ $skpi->nama_perti ?? 'Universitas Horizon Indonesia' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">BAHASA PENGANTAR KULIAH</span>
                    <span class="label-en">Language of Instruction</span>
                </td>
                <td class="value-cell">{{ $skpi->bahasa_pengantar_kuliah ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">PROGRAM STUDI</span>
                    <span class="label-en">Study Program</span>
                </td>
                <td class="value-cell">{{ $skpi->mahasiswa->prodi ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">SISTEM PENILAIAN</span>
                    <span class="label-en">Grading System</span>
                </td>
                <td class="value-cell">{{ $skpi->sistem_penilaian ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">KELAS</span>
                    <span class="label-en">Mode of Study</span>
                </td>
                <td class="value-cell">{{ $skpi->kelas ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">LAMA STUDI REGULER</span>
                    <span class="label-en">Length of Study</span>
                </td>
                <td class="value-cell">{{ $skpi->lama_studi_rg ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">JENIS & JENJANG PENDIDIKAN</span>
                    <span class="label-en">Type & Level of Education</span>
                </td>
                <td class="value-cell">{{ $skpi->mahasiswa->jenjang ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">JENJANG PENDIDIKAN LANJUTAN</span>
                    <span class="label-en">Access to Further Study</span>
                </td>
                <td class="value-cell">{{ $skpi->jenjang_pd_lanjutan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">JENJANG KUALIFIKASI SESUAI KKNI</span>
                    <span class="label-en">Level of Qualification in KKNI</span>
                </td>
                <td class="value-cell">{{ $skpi->jenjang_kualif_kkn1 ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">
                    <span class="label-id">STATUS PROFESI (BILA ADA)</span>
                    <span class="label-en">Professional Status (If Applicable)</span>
                </td>
                <td class="value-cell">{{ $skpi->status_profesi ?? '-' }}</td>
            </tr>
        </table>
        
        <div class="page-break"></div>
        
        <!-- HALAMAN 2 -->
        <div class="header">
            {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }} / {{ $skpi->mahasiswa->nim ?? '' }}
        </div>
        
        <!-- SECTION 03 -->
        <div class="section-number">
            03. INFORMASI TENTANG CAPAIAN PEMBELAJARAN<br>
            03. INFORMATION ON LEARNING OUTCOMES
        </div>
        
        <div class="two-column">
            <div class="column">
                <div class="competency-title">KEMAMPUAN KERJA</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->kemampuan_kerja ?? 'Tidak ada data')) !!}
                </div>
            </div>
            
            <div class="column">
                <div class="competency-title">SKILLS</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->kemampuan_kerja ?? 'No data available')) !!}
                </div>
            </div>
        </div>
        
        <div class="two-column" style="margin-top: 25px;">
            <div class="column">
                <div class="competency-title">PENGUASAAN PENGETAHUAN</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->penguasaan_pengetahuan ?? 'Tidak ada data')) !!}
                </div>
            </div>
            
            <div class="column">
                <div class="competency-title">KNOWLEDGE</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->penguasaan_pengetahuan ?? 'No data available')) !!}
                </div>
            </div>
        </div>
        
        <div class="page-break"></div>
        
        <!-- HALAMAN 3 -->
        <div class="header">
            {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }} / {{ $skpi->mahasiswa->nim ?? '' }}
        </div>
        
        <div class="two-column" style="margin-top: 40px;">
            <div class="column">
                <div class="competency-title">AKTIVITAS, PRESTASI DAN PENGHARGAAN</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->aktiv_pres_penghargaan ?? 'Tidak ada data')) !!}
                </div>
            </div>
            
            <div class="column">
                <div class="competency-title">ACTIVITIES, ACHIEVEMENT AND AWARDS</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->aktiv_pres_penghargaan ?? 'No data available')) !!}
                </div>
            </div>
        </div>
        
        <div class="two-column" style="margin-top: 40px;">
            <div class="column">
                <div class="competency-title">MAGANG</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->magang ?? 'Tidak ada data')) !!}
                </div>
            </div>
            
            <div class="column">
                <div class="competency-title">INTERNSHIP</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->magang ?? 'No data available')) !!}
                </div>
            </div>
        </div>
        
        <div class="page-break"></div>
        
        <!-- HALAMAN 4 -->
        <div class="header">
            {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }} / {{ $skpi->mahasiswa->nim ?? '' }}
        </div>
        
        <!-- SECTION 04 -->
        <div class="section-number">
            04. INFORMASI TENTANG SISTEM PENDIDIKAN TINGGI DI INDONESIA<br>
            04. INFORMATION ON INDONESIAN HIGHER EDUCATION SYSTEM
        </div>
        
        <div class="two-column" style="margin-top: 20px;">
            <div class="column">
                <div class="competency-title">Jenjang Pendidikan dan Syarat Belajar</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->jenjangpend_syaratbelajar ?? 'Tidak ada data')) !!}
                </div>
            </div>
            
            <div class="column" style="margin-top: 23px;">
                <div class="competency-title">SKS dan Lama Studi</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->sks_lamastudi ?? 'Tidak ada data')) !!}
                </div>
            </div>
        </div>
        
        <div class="two-column" style="margin-top: 20px;">
            <div class="column">
                <div class="competency-title">Levels of Education and Conditions of Learning</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->jenjangpend_syaratbelajar ?? 'No data available')) !!}
                </div>
            </div>
            
            <div class="column">
                <div class="competency-title">Semester Credit Unit and Duration of Study</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->sks_lamastudi ?? 'No data available')) !!}
                </div>
            </div>
        </div>
        
        <!-- SECTION 05 -->
        <div class="section-number" style="margin-top: 40px;">
            05. INFORMASI TENTANG KERANGKA KUALIFIKASI NASIONAL INDONESIA<br>
            05. INFORMATION ON INDONESIAN QUALIFICATION FRAMEWORK (KKNI)
        </div>
        
        <div class="content-box" style="margin: 20px 0;">
            {!! nl2br(e($skpi->info_kkni ?? 'Tidak ada data')) !!}
        </div>
        
        <!-- SECTION 06 -->
<div class="section-number" style="margin-top: 40px;">
    06. PENGESAHAN SKPI<br>
    06. CERTIFICATION OF THE SUPPLEMENT
</div>

<div class="signature-location" style="text-align: left;">
    {{ $skpi->kota ?? 'Cikarang' }}, 
    {{ $skpi->tanggal_skpi ? \Carbon\Carbon::parse($skpi->tanggal_skpi)->format('d F Y') : \Carbon\Carbon::now()->format('d F Y') }}
</div>

<div class="signature-section" style="text-align: left;">
    <div style="margin-bottom: 80px;"></div>
    <div style="border-bottom: 2px solid #000; width: 250px;"></div>
    <div class="signature-title" style="margin-top: 10px;">
        {{ $skpi->nama_dekan ?? 'Dekan Fakultas' }}
    </div>
</div>
    </div>
</body>
</html>