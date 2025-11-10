<!DOCTYPE html>
<head>
    <title>Visi, Misi, dan Tujuan RSHP Unair</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: #f8f9fa;
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
        max-width: 100%;
    }

    header h1 {
        color: #004085;
        margin: 10px 0 5px 0;
        text-align: center;
        font-size: 32px;
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
    .container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 0 20px;
    }

    .vmt-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .vmt-header h2 {
        font-size: 36px;
        color: #fff;
        font-weight: 800;
        letter-spacing: 1px;
        background: linear-gradient(135deg, #004085 0%, #0056b3 100%);
        padding: 25px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 64, 133, 0.3);
        display: inline-block;
    }

    /* CARD GRID */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border-top: 5px solid #004085;
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 64, 133, 0.05) 0%, transparent 100%);
        pointer-events: none;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 35px rgba(0, 64, 133, 0.25);
    }

    .card-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .card h3 {
        color: #004085;
        font-size: 24px;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .card p {
        color: #555;
        line-height: 1.8;
        font-size: 15px;
        text-align: justify;
    }

    .card ol {
        margin: 15px 0;
        padding-left: 25px;
        line-height: 1.9;
    }

    .card li {
        margin-bottom: 12px;
        color: #555;
        text-align: justify;
        font-size: 15px;
    }

    /* ACCENT LINE */
    .accent-line {
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #004085, #0056b3);
        margin: 10px 0 20px 0;
        border-radius: 2px;
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
        .vmt-header h2 {
            font-size: 28px;
            padding: 18px 25px;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }

        header h1 {
            font-size: 24px;
        }
    }
    </style>
</head>

<body>
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

    <div class="container">
        <!-- JUDUL VISI, MISI, TUJUAN -->
        <div class="vmt-header">
            <h2>VISI, MISI, DAN TUJUAN</h2>
        </div>

        <!-- CARDS -->
        <div class="cards-grid">
            <!-- VISI -->
            <div class="card">
                <div class="card-icon">🎯</div>
                <h3>Visi</h3>
                <div class="accent-line"></div>
                <p>Menjadi rumah sakit hewan pendidikan unggulan di tingkat nasional dan internasional.</p>
            </div>

            <!-- MISI -->
            <div class="card">
                <div class="card-icon">🚀</div>
                <h3>Misi</h3>
                <div class="accent-line"></div>
                <ol>
                    <li>Menyelenggarakan pelayanan kesehatan hewan yang bermutu.</li>
                    <li>Mendukung pendidikan kedokteran hewan.</li>
                    <li>Melakukan penelitian untuk pengembangan ilmu kedokteran hewan.</li>
                </ol>
            </div>

            <!-- TUJUAN -->
            <div class="card">
                <div class="card-icon">🏆</div>
                <h3>Tujuan</h3>
                <div class="accent-line"></div>
                <p>Meningkatkan kesehatan hewan peliharaan serta menunjang proses pembelajaran mahasiswa Fakultas Kedokteran Hewan UNAIR.</p>
            </div>
        </div>
    </div>

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