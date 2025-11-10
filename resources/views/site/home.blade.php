<!DOCTYPE html>
<head>
    <title>RSHP Universitas Airlangga</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f8f9fa;
        color: #333;
    }

    header {
        background: #ffffff;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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

    /* SECTION */
    section {
        margin: 40px auto;
        max-width: 900px;
        background: #fff;
        padding: 20px 30px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    section h2 {
        text-align: center;
        color: #004085;
        margin-bottom: 15px;
    }
    section p {
        text-align: justify;
        line-height: 1.6;
    }
    .center {
        text-align: center;
    }
    iframe {
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
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
    </style>
</head>

<body>
    <header>
        <div style="text-align:center;">
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

    <!-- HOME -->
    <section id="home">
        <h2>Selamat Datang di RSHP Universitas Airlangga</h2>
        <p>
            <b>Rumah Sakit Hewan Pendidikan (RSHP) Universitas Airlangga</b> adalah pusat layanan kesehatan hewan 
            sekaligus fasilitas pendidikan untuk mahasiswa Fakultas Kedokteran Hewan Unair. 
            Kami menyediakan layanan terbaik untuk hewan kesayangan Anda ^_^
        </p>
    </section>
    <hr>

    <!--PROFILE YOUTUBE-->
    <section id="youtube">
        <h2>Yuk! Kunjungi Profil Kami di Kanal Youtube Resmi</h2>
        <div class="center">
            <iframe width="470" height="264" src="https://www.youtube.com/embed/rCfvZPECZvE" title="Profil RSHP" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </section>
    <hr>

    <!--MAPS-->
    <section id="maps">
        <h2>Kunjungi Kami di Sini, Ya!</h2>
        <div class="center">
           <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7915.482022032093!2d112.788135!3d-7.270285!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd40a9784f5%3A0xe756f6ae03eab99!2sAnimal%20Hospital%2C%20Universitas%20Airlangga!5e0!3m2!1sen!2sus!4v1755870698992!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    <hr>

    <!-- FOOTER -->
    <footer>
        <p>
            &copy; 2025 RSHP Universitas Airlangga | 
            <a href="https://rshp.unair.ac.id" target="0">RSHP Universitas Airlangga</a>
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
