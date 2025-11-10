<!DOCTYPE html>
<html>
<head>
    <title>Struktur Organisasi RSHP Unair</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        header div {
            text-align: center;
        }
        
        header img {
            margin-bottom: 10px;
        }
        
        header h1 {
            color: #004085;
            margin: 10px 0 5px 0;
            text-align: center;
        }
        
        header p {
            text-align: center;
            font-style: italic;
            color: #666;
        }

        /* NAVBAR */
        nav {
            background: #004085;
        }
        
        nav table {
            width: 100%;
            border-collapse: collapse;
        }
        
        nav td {
            text-align: center;
            padding: 15px;
            border-right: 1px solid rgba(255,255,255,0.2);
        }
        
        nav td:last-child {
            border-right: none;
        }
        
        nav a {
            text-decoration: none;
            font-weight: bold;
            color: white;
            transition: 0.3s;
        }
        
        nav a:hover {
            color: #ffc107;
        }

        /* MAIN SECTION */
        section {
            margin: 40px auto;
            max-width: 900px;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        section h2 {
            text-align: center;
            color: #004085;
            margin-bottom: 30px;
            font-size: 28px;
        }

        /* DIREKTUR SECTION */
        .direktur-section {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
        }

        .direktur-section h3 {
            color: #0056b3;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .direktur-section img {
            width: 160px;
            height: 200px;
            border: 3px solid #ddd;
            border-radius: 8px;
            margin: 15px 0;
            object-fit: cover;
        }

        .direktur-section p {
            font-weight: bold;
            color: #004085;
            font-size: 16px;
            margin-top: 10px;
        }

        /* WAKIL DIREKTUR GRID */
        .wakil-direktur-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 20px;
        }

        .wakil-direktur-card {
            text-align: center;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #0056b3;
            transition: all 0.3s ease;
        }

        .wakil-direktur-card:hover {
            box-shadow: 0 6px 15px rgba(0, 64, 133, 0.15);
            transform: translateY(-5px);
        }

        .wakil-direktur-card h4 {
            color: #004085;
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .wakil-direktur-card .deskripsi {
            color: #666;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .wakil-direktur-card img {
            width: 160px;
            height: 200px;
            border: 3px solid #ddd;
            border-radius: 8px;
            margin: 15px 0;
            object-fit: cover;
        }

        .wakil-direktur-card p {
            font-weight: bold;
            color: #004085;
            font-size: 15px;
            margin-top: 10px;
        }

        /* FOOTER */
        footer {
            background: #004085;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
            font-weight: bold;
        }

        footer ul {
            list-style-type: none;
            padding: 0;
            margin-top: 10px;
        }

        footer li {
            margin: 5px 0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            section {
                margin: 20px;
                padding: 20px;
            }

            .wakil-direktur-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            section h2 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header>
        <div>
            <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo RSHP UNAIR" width="400">
        </div>
        <h1>Rumah Sakit Hewan Pendidikan (RSHP) Universitas Airlangga</h1>
        <p>Pelayanan Kesehatan Hewan Terbaik untuk Hewan Kesayangan Anda</p>
    </header>

    <!-- NAVIGASI -->
    <nav>
        <table>
            <tr>
                <td><a href="/home">Home</a></td>
                <td><a href="/struktur_organisasi">Struktur Organisasi</a></td>
                <td><a href="/layanan_umum">Layanan Umum</a></td>
                <td><a href="/visi_misi_dan_tujuan">Visi Misi dan Tujuan</a></td>
                <td><a href="/login">Login</a></td>
            </tr>
        </table>
    </nav>

    <!-- STRUKTUR ORGANISASI SECTION -->
    <section>
        <h2>STRUKTUR ORGANISASI</h2>

        <!-- DIREKTUR -->
        <div class="direktur-section">
            <h3>DIREKTUR</h3>
            <img src="https://scholar.unair.ac.id/files-asset/27672044/WhatsApp_Image_2020_11_10_at_16.38.18.jpeg" alt="Direktur">
            <p>Dr. Ira Sari Yudaniayanti, M.P., drh.</p>
        </div>

        <!-- WAKIL DIREKTUR -->
        <h3 style="text-align: center; color: #004085; margin: 30px 0 25px 0; font-size: 22px;">WAKIL DIREKTUR</h3>
        
        <div class="wakil-direktur-container">
            <!-- WAKIL DIREKTUR 1 -->
            <div class="wakil-direktur-card">
                <h4>WAKIL DIREKTUR I</h4>
                <div class="deskripsi">
                    PELAYANAN MEDIS,<br>PENDIDIKAN DAN PENELITIAN
                </div>
                <img src="https://rshp.unair.ac.id/wp-content/uploads/2023/03/Wakil-Direktur-I-RSHP.png" alt="Wakil Direktur 1">
                <p>Dr. Nusdianto Triakoso, M.P., drh.</p>
            </div>

            <!-- WAKIL DIREKTUR 2 -->
            <div class="wakil-direktur-card">
                <h4>WAKIL DIREKTUR II</h4>
                <div class="deskripsi">
                    SUMBER DAYA MANUSIA,<br>SARANA PRASARANA DAN KEUANGAN
                </div>
                <img src="{{ asset('images/dr_miyayu.jpg') }}" alt="Wakil Direktur 2">
                <p>Dr. Miyayu Soneta S., M.Vet., drh.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>
            &copy; 2025 RSHP Universitas Airlangga | 
            <a href="https://rshp.unair.ac.id" target="_blank">RSHP Universitas Airlangga</a>
        </p>
        
        <ul>
            <li>GEDUNG RS HEWAN PENDIDIKAN UNAIR</li>
            <li>rshp@fkh.unair.ac.id</li>
            <li>Telp : 031 5927832</li>
            <li>Kampus C Universitas Airlangga</li>
            <li>Surabaya 60115, Jawa Timur</li>
        </ul>
    </footer>
</body>
</html>