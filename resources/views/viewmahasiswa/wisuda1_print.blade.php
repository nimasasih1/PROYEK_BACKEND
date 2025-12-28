@isset($data)
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permohonan Wisuda - {{ $data->mahasiswa->nama_mahasiswa }}</title>
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
        }

        .container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            padding: 15mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }

        .header h2 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 11px;
            font-style: italic;
        }

        .expected-date {
            margin: 20px 0;
            font-size: 12px;
        }

        .section-title {
            background: #e0e0e0;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 13px;
            margin: 20px 0 15px 0;
            border: 1px solid #999;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        table td {
            padding: 8px;
            border: 1px solid #000;
        }

        .label-cell {
            width: 35%;
            font-weight: normal;
            background: #f9f9f9;
        }

        .value-cell {
            width: 65%;
        }

        .course-table {
            margin: 15px 0;
        }

        .course-table th {
            background: #f0f0f0;
            padding: 8px;
            border: 1px solid #000;
            font-weight: bold;
            font-size: 11px;
            text-align: left;
        }

        .course-table td {
            padding: 8px;
            font-size: 11px;
        }

        .disclaimer {
            margin: 25px 0;
            padding: 15px;
            background: #fffef0;
            border: 1px solid #ddd;
            font-size: 11px;
            line-height: 1.6;
        }

        .disclaimer p {
            margin-bottom: 10px;
        }

        .disclaimer strong {
            font-weight: bold;
        }

        .signature-section {
            margin: 30px 0;
        }

        .signature-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 25px;
        }

        .signature-box {
            flex: 1;
            text-align: center;
            font-size: 11px;
        }

        .signature-label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .signature-space {
            height: 60px;
            border-bottom: 1px solid #000;
            margin: 10px 0;
        }

        .signature-name {
            font-weight: bold;
            margin-top: 5px;
        }

        .signature-date {
            margin-top: 5px;
            font-size: 10px;
        }

        .privacy-section {
            margin: 25px 0;
            font-size: 9px;
            line-height: 1.5;
            text-align: justify;
        }

        .privacy-section p {
            margin-bottom: 10px;
        }

        .final-signature {
            margin: 30px 0;
            text-align: center;
        }

        .final-signature-box {
            display: inline-block;
            width: 300px;
            font-size: 11px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #980517;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .print-button:hover {
            background: #980517;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .container {
                box-shadow: none;
                max-width: 100%;
            }

            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>APPLICATION FOR GRADUATION</h1>
            <h2>FORMULIR PERMOHONAN WISUDA</h2>
            <p>Please fill out the required information / Mohon lengkapi data yang diminta</p>
        </div>

        <div class="expected-date">
            <strong>Expected Date of Graduation / Tanggal perkiraan wisuda:</strong> {{ $data->tgl_pendaftaran ?? '-' }}
        </div>

        <div class="section-title">Student Information / Informasi Mahasiswa</div>
        <table>
            <tr>
                <td class="label-cell">Name / Nama:</td>
                <td class="value-cell">{{ $data->mahasiswa->nama_mahasiswa }}</td>
            </tr>
            <tr>
                <td class="label-cell">Student ID / NIM:</td>
                <td class="value-cell">{{ $data->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td class="label-cell">College / Fakultas:</td>
                <td class="value-cell">{{ $data->mahasiswa->fakultas ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Degree / Jenjang:</td>
                <td class="value-cell">{{ $data->mahasiswa->jenjang ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Major / Jurusan:</td>
                <td class="value-cell">{{ $data->mahasiswa->jurusan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Mobile Phone / No HP:</td>
                <td class="value-cell">{{ $data->mahasiswa->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Email:</td>
                <td class="value-cell">{{ $data->mahasiswa->email ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Address / Alamat:</td>
                <td class="value-cell">{{ $data->mahasiswa->alamat ?? '-' }}</td>
            </tr>
        </table>

        <div class="section-title">Last Curricular Load / Beban Studi Terakhir</div>
        <table class="course-table">
            <tr>
                <th style="width: 25%">PEN Code / Kode PEN</th>
                <th style="width: 40%">Descriptive Title / Judul Deskriptif</th>
                <th style="width: 20%">Faculty Signature / Tanda tangan Dosen</th>
                <th style="width: 15%">Final Grade / Nilai Akhir</th>
            </tr>
            @if($data->toga)
            <tr>
                <td>{{ $data->toga->kode_pen ?? '-' }}</td>
                <td>{{ $data->judul_skripsi ?? '-' }}</td>
                <td></td>
                <td>{{ $data->ipk ?? '-' }}</td>
            </tr>
            @else
            <tr>
                <td>-</td>
                <td>-</td>
                <td></td>
                <td>-</td>
            </tr>
            @endif
        </table>

        <div class="disclaimer">
            <p><strong>Only those students who have satisfied the academic and non-academic requirements of their degrees by the end of the term shall be allowed to graduate.</strong></p>
            <p>Hanya mahasiswa yang telah memenuhi seluruh persyaratan akademik dan non-akademik program studinya hingga akhir semester yang diperbolehkan untuk mengikuti proses kelulusan.</p>
        </div>

        <div class="section-title">Signature Name Printed / Tanda Tangan di atas Nama Jelas</div>
        <div class="signature-section">
            <div class="signature-row">
                <div class="signature-box">
                    <div class="signature-label">Student / Mahasiswa:</div>
                    <div class="signature-space"></div>
                    <div class="signature-name">{{ $data->mahasiswa->nama_mahasiswa }}</div>
                    <div class="signature-date">Date/Tanggal: {{ $data->tgl_pendaftaran ?? '-' }}</div>
                </div>

                <div class="signature-box">
                    <div class="signature-label">Program Head / Kepala program studi:</div>
                    <div class="signature-space"></div>
                    <div class="signature-name">_______________</div>
                    <div class="signature-date">Date/Tanggal: _________</div>
                </div>

                <div class="signature-box">
                    <div class="signature-label">Dean / Dekan:</div>
                    <div class="signature-space"></div>
                    <div class="signature-name">_______________</div>
                    <div class="signature-date">Date/Tanggal: _________</div>
                </div>
            </div>
        </div>

        <div class="privacy-section">
            <p>The personal data obtained from the data subject or an individual is entered and stored within the company authorized information and communication systems, for the purpose allowed under applicable laws and regulations and will only be accessed by the authorized personnel. (School) has instituted appropriate organizational, technical and physical security measures to ensure the protection of the collected personal data. Furthermore, the information collected will be shared and/or made available to CITED and/or any other interested parties in order to pursue lawful purposes and legitimate interest and comply with legal mandate, and only be used for the purpose of operations and will never be disclosed to anyone without prior authorization or consent.</p>
            <p>Data pribadi yang diperoleh dari subjek data atau individu akan dimasukkan dan disimpan dalam sistem informasi dan komunikasi yang diotorisasi oleh perusahaan (sekolah), sesuai dengan jangka waktu yang ditentukan berdasarkan peraturan perundang-undangan yang berlaku, dan hanya dapat diakses oleh personel yang berwenang. (Sekolah) telah menerapkan langkah-langkah pengamanan secara organisasi, teknis, dan fisik untuk melindungi data pribadi yang dikumpulkan. Selain itu, informasi yang dikumpulkan dapat dibagikan kepada dan tersedia bagi CITED dan/atau pihak terkait lainnya guna menjalankan tujuan yang sah, kepentingan yang sah, dan mematuhi amanat hukum. Data ini hanya akan digunakan untuk keperluan operasional dan tidak akan diungkapkan kepada pihak lain tanpa persetujuan terlebih dahulu.</p>
        </div>

        <div class="final-signature">
            <div class="final-signature-box">
                <div class="signature-label">Signature Name Printed / Tanda Tangan di atas Nama Jelas</div>
                <div class="signature-space"></div>
                <div class="signature-name">{{ $data->mahasiswa->nama_mahasiswa }}</div>
                <div class="signature-date">Date/Tanggal: {{ $data->tgl_pendaftaran ?? '-' }}</div>
            </div>
        </div>

        <div class="footer">
            <p>{{ $data->mahasiswa->alamat ?? '-' }}</p>
        </div>
    </div>
</body>

</html>
@endisset