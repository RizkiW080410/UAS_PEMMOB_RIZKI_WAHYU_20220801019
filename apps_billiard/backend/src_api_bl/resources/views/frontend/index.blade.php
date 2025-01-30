<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page Billiard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" href="assets/style.css" />
  </head>
  <body>
    <div class="loader-wrapper">
      <div class="loader"></div>
    </div>
    <header>
      <div class="logo"><img src="assets/img/logo.png" alt=""></div>
      <nav>
        <ul>
          <li><a href="#tentang">Tentang Kami</a></li>
          <li><a href="#layanan">Layanan</a></li>
          <li><a href="#galeri">Galeri</a></li>
          <li><a href="#kontak">Kontak</a></li>
        </ul>
      </nav>
      <a href="#kontak" class="cta">Pesan Sekarang</a>
    </header>

    <section class="hero">
      <div class="hero-content">
        <h1>Selamat Datang di Billiard RizWah</h1>
        <p>Tempat Terbaik untuk Bermain Billiard dan Bersantai</p>
        <a href="#tentang" class="cta">Pelajari Lebih Lanjut</a>
      </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="about">
      <h2>Tentang Kami</h2>
      @foreach($abouts as $about)
      <div class="about-content">
        <div class="about-text">
          
            <p>{{ $about->description }}</p>
          
        </div>
        <div class="about-image">
          <img src="{{ asset('storage/' . $about->image) }}" alt="Tentang Kami" />
        </div>
      </div>
      @endforeach
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="services">
      <h2>Layanan Kami</h2>
      <div class="service-cards">
        @foreach($layanans as $layanan)
          <div class="card">
            <h3>{{ $layanan->name }}</h3>
            <p>{{ $layanan->description }}</p>
          </div>
        @endforeach
      </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="gallery">
      <h2>Galeri Kami</h2>
      <div class="gallery-grid">
        <img src="assets/img/galeri3.jpg" alt="Billiard Image 1" />
        <img src="assets/img/galeri7.jpg" alt="Billiard Image 2" />
        <img src="assets/img/galeri4.jpg" alt="Billiard Image 3" />
        <img src="assets/img/galeri6.jpg" alt="Billiard Image 4" />
      </div>
    </section>

    <!-- Events Section (Pertandingan) -->
    <section id="events" class="events">
      <h2>Upcoming Events</h2>
      @foreach($pertandingans as $pertandingan)
        <div class="event">
          <img src="{{ asset('storage/' . $pertandingan->image) }}" alt="Event Image">
          <div class="event-info">
            <h3>{{ $pertandingan->clientA->name }} vs {{ $pertandingan->clientB->name }}</h3>
            <p>{{ $pertandingan->category }} - {{ $pertandingan->start_time }}</p>
            <p><strong>{{ $pertandingan->start_time }}</strong> | {{ $pertandingan->status }}</p>
            <button id="registerBtn">Register</button>
          </div>
        </div>
      @endforeach
    </section>

    <footer>
      <div class="footer-content">
        <div class="footer-info">
          <h3>BilliardClub</h3>
          <p>
            Location: Ruko Paramount Dot Com Red, Jl. Boulevard Raya Gading
            Serpong No.5, RW.6, Kelapa Dua, Tangerang Regency, Banten 15810
          </p>
          <p>Phone: 0895-2555-9560</p>
          <p>Email: info@billiardclub.com</p>
        </div>
        <div class="footer-social">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
      <p>
        Created by
        <a href="https://www.instagram.com/galihls_/">Angga Muhammad Galih</a>
        And Mocci. &copy; 2024 BilliardClub. All rights reserved.
      </p>
    </footer>

    <script src="assets/script.js"></script>
  </body>
</html>
