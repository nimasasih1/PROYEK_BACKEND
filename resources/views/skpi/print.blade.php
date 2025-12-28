<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKPI - Diploma Supplement</title>
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
            gap: 30px;
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
            background: #1976D2;
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
            Name of applicant/ ID
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
        
        <!-- SECTION 01 -->
        <div class="section-number">
            01. INFORMASI TENTANG IDENTITAS DIRI PEMEGANG SKPI<br>
            01. INFORMATION IDENTIFYING THE HOLDER OF THE DIPLOMA SUPPLEMENT
        </div>
        
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
        <div class="section-number">
            02. INFORMASI TENTANG IDENTITAS PENYELENGGARA PROGRAM<br>
            02. INFORMATION IDENTIFYING THE INSTITUTION ADMINISTERING STUDIES
        </div>
        
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
        
        <div class="page-break"></div>
        
        <!-- HALAMAN 2 -->
        <div class="header">
            Name of applicant/ ID
        </div>
        
        <!-- SECTION 03 -->
        <div class="section-number">
            03. INFORMASI TENTANG CAPAIAN PEMBELAJARAN<br>
            03. INFORMATION ON LEARNING OUTCOMES
        </div>
        
        <div class="two-column">
            <div class="column">
                <div class="competency-title">KEMAMPUAN KERJA</div>
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
            </div>
            
            <div class="column">
                <div class="competency-title">SKILLS</div>
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
            </div>
        </div>
        
        <div class="page-break"></div>
        
        <!-- HALAMAN 3 -->
        <div class="header">
            Name of applicant/ ID
        </div>
        
        <div class="two-column" style="margin-top: 40px;">
            <div class="column">
                <div class="competency-title">AKTIVITAS, PRESTASI DAN PENGHARGAAN</div>
                <div style="min-height: 200px; border-bottom: 1px solid #ccc;"></div>
            </div>
            
            <div class="column">
                <div class="competency-title">ACTIVITIES, ACHIEVEMENT AND AWARDS</div>
                <div style="min-height: 200px; border-bottom: 1px solid #ccc;"></div>
            </div>
        </div>
        
        <div class="two-column" style="margin-top: 40px;">
            <div class="column">
                <div class="competency-title">MAGANG</div>
                <div style="min-height: 200px; border-bottom: 1px solid #ccc;"></div>
            </div>
            
            <div class="column">
                <div class="competency-title">INTERNSHIP</div>
                <div style="min-height: 200px; border-bottom: 1px solid #ccc;"></div>
            </div>
        </div>
        
        <div class="page-break"></div>
        
        <!-- HALAMAN 4 -->
        <div class="header">
            Name of applicant/ ID
        </div>
        
        <!-- SECTION 04 -->
        <div class="section-number">
            04. INFORMASI TENTANG SISTEM PENDIDIKAN TINGGI DI INDONESIA<br>
            04. INFORMATION ON INDONESIAN HIGHER EDUCATION SYSTEM
        </div>
        
        <div class="two-column" style="margin-top: 20px;">
            <div class="column">
                <div class="competency-title">Jenjang Pendidikan dan Syarat Belajar</div>
                <div style="min-height: 150px; border-bottom: 1px solid #ccc;"></div>
            </div>
            
            <div class="column">
                <div class="competency-title">SKS dan Lama Studi</div>
                <div style="min-height: 150px; border-bottom: 1px solid #ccc;"></div>
            </div>
        </div>
        
        <div class="two-column" style="margin-top: 20px;">
            <div class="column">
                <div class="competency-title">Levels of Education and Conditions of Learning</div>
                <div style="min-height: 150px; border-bottom: 1px solid #ccc;"></div>
            </div>
            
            <div class="column">
                <div class="competency-title">Semester Credit Unit and Duration of Study</div>
                <div style="min-height: 150px; border-bottom: 1px solid #ccc;"></div>
            </div>
        </div>
        
        <!-- SECTION 05 -->
        <div class="section-number" style="margin-top: 40px;">
            05. INFORMASI TENTANG KERANGKA KUALIFIKASI NASIONAL INDONESIA<br>
            05. INFORMATION ON INDONESIAN QUALIFICATION FRAMEWORK (KKNI)
        </div>
        
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
    </div>
</body>
</html>