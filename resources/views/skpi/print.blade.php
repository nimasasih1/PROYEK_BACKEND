<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>SKPI - Diploma Supplement</title>
=======
    <title>SKPI - {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }}</title>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
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
<<<<<<< HEAD
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }
        
        .info-label {
            width: 40%;
            font-weight: normal;
            padding-right: 10px;
        }
        
        .info-value {
            width: 60%;
            font-weight: normal;
=======
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
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
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
<<<<<<< HEAD
            gap: 30px;
=======
            gap: 40px;
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
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
<<<<<<< HEAD
            background: #1976D2;
        }
        
=======
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
        
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
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
<<<<<<< HEAD
            Name of applicant/ ID
=======
            {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }} / {{ $skpi->mahasiswa->nim ?? '' }}
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
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
        
<<<<<<< HEAD
        <!-- SECTION 01 -->
=======
        <!-- SECTION 01 - DENGAN TABEL KOTAK -->
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
        <div class="section-number">
            01. INFORMASI TENTANG IDENTITAS DIRI PEMEGANG SKPI<br>
            01. INFORMATION IDENTIFYING THE HOLDER OF THE DIPLOMA SUPPLEMENT
        </div>
        
<<<<<<< HEAD
        <div class="info-table">
            <div class="info-row">
                <div class="info-label">NAMA LENGKAP<br><i>Full Name</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">TAHUN LULUS<br><i>Year of completion</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">TEMPAT TANGGAL LAHIR<br><i>Date and Place Birth</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">NOMOR IJAZAH<br><i>Diploma Number</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">NOMOR INDUK MAHASISWA<br><i>Student Identification Number</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">GELAR<br><i>Name of Qualification</i></div>
                <div class="info-value">_______________________________</div>
            </div>
        </div>
        
        <!-- SECTION 02 -->
=======
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
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
        <div class="section-number">
            02. INFORMASI TENTANG IDENTITAS PENYELENGGARA PROGRAM<br>
            02. INFORMATION IDENTIFYING THE INSTITUTION ADMINISTERING STUDIES
        </div>
        
<<<<<<< HEAD
        <div class="info-table">
            <div class="info-row">
                <div class="info-label">SK PENDIRIAN PERGURUAN TINGGI<br><i>Higher Education Institution's License</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">PERSYARATAN PENERIMAAN<br><i>Entry Requirements</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">NAMA PERGURUAN TINGGI<br><i>Name of Institution Administering Studies</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">BAHASA PENGANTAR KULIAH<br><i>Language of Instruction</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">PROGRAM STUDI<br><i>Study Program</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">SISTEM PENILAIAN<br><i>Grading System</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">KELAS<br><i>Mode of Study</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">LAMA STUDI REGULER<br><i>Length of Study</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">JENIS & JENJANG PENDIDIKAN<br><i>Type & Level of Education</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">JENJANG PENDIDIKAN LANJUTAN<br><i>Access to Further Study</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">JENJANG KUALIFIKASI SESUAI KKNI<br><i>Level of Qualification in KKNI</i></div>
                <div class="info-value">_______________________________</div>
            </div>
            <div class="info-row">
                <div class="info-label">STATUS PROFESI (BILA ADA)<br><i>Professional Status (If Applicable)</i></div>
                <div class="info-value">_______________________________</div>
            </div>
        </div>
=======
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
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
        
        <div class="page-break"></div>
        
        <!-- HALAMAN 2 -->
        <div class="header">
<<<<<<< HEAD
            Name of applicant/ ID
=======
            {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }} / {{ $skpi->mahasiswa->nim ?? '' }}
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
        </div>
        
        <!-- SECTION 03 -->
        <div class="section-number">
            03. INFORMASI TENTANG CAPAIAN PEMBELAJARAN<br>
            03. INFORMATION ON LEARNING OUTCOMES
        </div>
        
        <div class="two-column">
            <div class="column">
                <div class="competency-title">KEMAMPUAN KERJA</div>
<<<<<<< HEAD
                <div class="competency-list">
                    <div class="competency-item">
                        <span class="competency-item-title">1. Pemrograman dan Pengembangan Perangkat Lunak:</span><br>
                        Mampu merancang, mengembangkan, menguji, dan memelihara perangkat lunak menggunakan berbagai bahasa pemrograman dan platform teknologi.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">2. Analisis dan Perancangan Sistem:</span><br>
                        Mampu melakukan analisis kebutuhan, merancang arsitektur sistem, serta membuat model dan diagram untuk pengembangan sistem dan teknologi informasi.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">3. Manajemen Basis Data:</span><br>
                        Mampu merancang, mengelola, dan mengoptimalkan sistem basis data serta menerapkan keamanan dan integritas data.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">4. Jaringan dan Komunikasi Data:</span><br>
                        Mampu merancang, mengimplementasikan, dan memelihara jaringan komputer yang aman dan efisien, termasuk konfigurasi perangkat keras dan perangkat lunak jaringan.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">5. Pengembangan Aplikasi Mobile dan Web:</span><br>
                        Mampu merancang dan mengembangkan aplikasi mobile dan web yang responsif, mudah digunakan, dan sesuai dengan standar industri.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">6. Manajemen Proyek Teknologi Informasi:</span><br>
                        Mampu merencanakan, mengelola, dan mengawasi proyek teknologi informasi dari awal hingga akhir, termasuk pengelolaan sumber daya, waktu, dan anggaran.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">7. Pemecahan Masalah dan Pengambilan Keputusan:</span><br>
                        Mampu menganalisis situasi, mengidentifikasi masalah, dan mengambil keputusan yang tepat berdasarkan data dan pengetahuan teknis.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">8. Komunikasi yang Efektif:</span><br>
                        Mampu menyampaikan ide dan hasil kerja dengan jelas dan efektif, baik secara lisan maupun tulisan, kepada berbagai pemangku kepentingan, termasuk teknisi dan non-teknisi.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">9. Kerja Sama dan Kolaborasi Tim:</span><br>
                        Mampu bekerja secara efektif dalam tim multidisiplin, berkontribusi pada penyelesaian tugas bersama, dan berkolaborasi dengan anggota tim lainnya.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">10. Adaptabilitas dan Pembelajaran Berkelanjutan:</span><br>
                        Mampu beradaptasi dengan cepat terhadap perkembangan teknologi baru dan terus belajar untuk meningkatkan keterampilan serta pengetahuan.
                    </div>
                </div>
                
                <div class="competency-title" style="margin-top: 25px;">PENGUASAAN PENGETAHUAN</div>
=======
                <div class="content-box">
                    {!! nl2br(e($skpi->kemampuan_kerja ?? 'Tidak ada data')) !!}
                </div>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </div>
            
            <div class="column">
                <div class="competency-title">SKILLS</div>
<<<<<<< HEAD
                <div class="competency-list">
                    <div class="competency-item">
                        <span class="competency-item-title">Informatics Study Program Work Competencies</span>
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">1. Software Programming and Development:</span> Able to design, develop, test, and maintain software using various programming languages and technology platforms.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">2. System Analysis and Design:</span> Able to conduct needs analysis, design system architecture, and create models and diagrams for the development of information systems and technology.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">3. Database Management:</span> Able to design, manage, and optimize database systems and implement data security and integrity.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">4. Network and Data Communication:</span> Able to design, implement, and maintain secure and efficient computer networks, including network hardware and software configurations.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">5. Mobile and Web Application Development:</span> Able to design and develop mobile and web applications that are responsive, user-friendly, and meet industry standards.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">6. IT Project Management:</span> Able to plan, manage, and supervise information technology projects from start to finish, including resource, time, and budget management.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">7. Problem Solving and Decision Making:</span> Able to analyze situations, identify problems, and make the right decisions based on data and technical knowledge.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">8. Effective Communication:</span> Able to convey ideas and work results clearly and effectively, both verbally and in writing, to various stakeholders, including technicians and non-technicians.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">9. Teamwork and Collaboration:</span> Able to work effectively in multidisciplinary teams, contribute to the completion of common tasks, and collaborate with other team members.
                    </div>
                    
                    <div class="competency-item">
                        <span class="competency-item-title">10. Adaptability and Continuous Learning:</span> Able to adapt quickly to new technological developments and continue learning to improve skills and knowledge.
                    </div>
                </div>
                
                <div class="competency-title" style="margin-top: 25px;">KNOWLEDGE</div>
=======
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
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </div>
        </div>
        
        <div class="page-break"></div>
        
        <!-- HALAMAN 3 -->
        <div class="header">
<<<<<<< HEAD
            Name of applicant/ ID
=======
            {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }} / {{ $skpi->mahasiswa->nim ?? '' }}
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
        </div>
        
        <div class="two-column" style="margin-top: 40px;">
            <div class="column">
                <div class="competency-title">AKTIVITAS, PRESTASI DAN PENGHARGAAN</div>
<<<<<<< HEAD
                <div style="min-height: 200px; border-bottom: 1px solid #ccc;"></div>
=======
                <div class="content-box">
                    {!! nl2br(e($skpi->aktiv_pres_penghargaan ?? 'Tidak ada data')) !!}
                </div>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </div>
            
            <div class="column">
                <div class="competency-title">ACTIVITIES, ACHIEVEMENT AND AWARDS</div>
<<<<<<< HEAD
                <div style="min-height: 200px; border-bottom: 1px solid #ccc;"></div>
=======
                <div class="content-box">
                    {!! nl2br(e($skpi->aktiv_pres_penghargaan ?? 'No data available')) !!}
                </div>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </div>
        </div>
        
        <div class="two-column" style="margin-top: 40px;">
            <div class="column">
                <div class="competency-title">MAGANG</div>
<<<<<<< HEAD
                <div style="min-height: 200px; border-bottom: 1px solid #ccc;"></div>
=======
                <div class="content-box">
                    {!! nl2br(e($skpi->magang ?? 'Tidak ada data')) !!}
                </div>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </div>
            
            <div class="column">
                <div class="competency-title">INTERNSHIP</div>
<<<<<<< HEAD
                <div style="min-height: 200px; border-bottom: 1px solid #ccc;"></div>
=======
                <div class="content-box">
                    {!! nl2br(e($skpi->magang ?? 'No data available')) !!}
                </div>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </div>
        </div>
        
        <div class="page-break"></div>
        
        <!-- HALAMAN 4 -->
        <div class="header">
<<<<<<< HEAD
            Name of applicant/ ID
=======
            {{ $skpi->mahasiswa->nama_mahasiswa ?? '' }} / {{ $skpi->mahasiswa->nim ?? '' }}
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
        </div>
        
        <!-- SECTION 04 -->
        <div class="section-number">
            04. INFORMASI TENTANG SISTEM PENDIDIKAN TINGGI DI INDONESIA<br>
            04. INFORMATION ON INDONESIAN HIGHER EDUCATION SYSTEM
        </div>
        
        <div class="two-column" style="margin-top: 20px;">
            <div class="column">
                <div class="competency-title">Jenjang Pendidikan dan Syarat Belajar</div>
<<<<<<< HEAD
                <div style="min-height: 150px; border-bottom: 1px solid #ccc;"></div>
            </div>
            
            <div class="column">
                <div class="competency-title">SKS dan Lama Studi</div>
                <div style="min-height: 150px; border-bottom: 1px solid #ccc;"></div>
=======
                <div class="content-box">
                    {!! nl2br(e($skpi->jenjangpend_syaratbelajar ?? 'Tidak ada data')) !!}
                </div>
            </div>
            
            <div class="column" style="margin-top: 23px;">
                <div class="competency-title">SKS dan Lama Studi</div>
                <div class="content-box">
                    {!! nl2br(e($skpi->sks_lamastudi ?? 'Tidak ada data')) !!}
                </div>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </div>
        </div>
        
        <div class="two-column" style="margin-top: 20px;">
            <div class="column">
                <div class="competency-title">Levels of Education and Conditions of Learning</div>
<<<<<<< HEAD
                <div style="min-height: 150px; border-bottom: 1px solid #ccc;"></div>
=======
                <div class="content-box">
                    {!! nl2br(e($skpi->jenjangpend_syaratbelajar ?? 'No data available')) !!}
                </div>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </div>
            
            <div class="column">
                <div class="competency-title">Semester Credit Unit and Duration of Study</div>
<<<<<<< HEAD
                <div style="min-height: 150px; border-bottom: 1px solid #ccc;"></div>
=======
                <div class="content-box">
                    {!! nl2br(e($skpi->sks_lamastudi ?? 'No data available')) !!}
                </div>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </div>
        </div>
        
        <!-- SECTION 05 -->
        <div class="section-number" style="margin-top: 40px;">
            05. INFORMASI TENTANG KERANGKA KUALIFIKASI NASIONAL INDONESIA<br>
            05. INFORMATION ON INDONESIAN QUALIFICATION FRAMEWORK (KKNI)
        </div>
        
<<<<<<< HEAD
        <div style="min-height: 150px; border-bottom: 1px solid #ccc; margin: 20px 0;"></div>
        
        <!-- SECTION 06 -->
        <div class="section-number" style="margin-top: 40px;">
            06. PENGESAHAN SKPI<br>
            06. CERTIFICATION OF THE SUPPLEMENT
        </div>
        
        <div class="signature-location">
            Cikarang, <i>Date, month, year</i>
        </div>
        
        <div class="signature-section">
            <div style="margin-bottom: 80px; border-bottom: 1px solid #000; width: 200px; margin-left: auto; margin-right: auto;"></div>
            <div class="signature-title">Dekan Fakultas</div>
        </div>
=======
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
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
    </div>
</body>
</html>