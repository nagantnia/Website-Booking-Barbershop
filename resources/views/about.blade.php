<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - EL BARBER</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <main class="about">
        <header class="header">
            <div class="logo">EL BARBER</div>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item active"><a href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a href="#collections">Collection</a></li>
                    <li class="nav-item"><a href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a href="#services">Services</a></li>
                    <li class="nav-item"><a href="#barbers">Barbers</a></li>
                </ul>
            </nav>
            <div class="user-section">
                @auth
                    <span class="user-name">{{ Auth::user()->name }}</span>
                @else
                    <span class="user-name">Guest</span>
                @endauth
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'G' }}" alt="User" class="user-image">
            </div>
        </header>

        <section class="overlap-group-wrapper">
            <div class="overlap-group">
                <h1 class="text-wrapper">EL BARBER</h1>
                <article class="selamat-datang-di-EL">
                    <h2>Selamat datang di EL BARBER!</h2>
                    <p>
                        Kami adalah barbershop modern yang menggabungkan layanan potong rambut berkualitas dengan kemudahan teknologi. Di tengah kesibukan sehari-hari, kami tahu waktu Anda sangat berharga — karena itu, kami hadir dengan sistem booking online yang memudahkan Anda memesan jadwal cukur tanpa harus antre lama.
                    </p>
                    <p>
                        Dengan tim barber profesional dan berpengalaman, kami siap memberikan penampilan terbaik untuk Anda, mulai dari potongan klasik hingga gaya modern kekinian. Kenyamanan pelanggan adalah prioritas kami — mulai dari suasana tempat, pelayanan ramah, hingga hasil yang memuaskan.
                    </p>
                    <h3>Mengapa memilih kami?</h3>
                    <ul>
                        <li>Booking online mudah dan cepat</li>
                        <li>Barber berpengalaman & profesional</li>
                        <li>Tempat nyaman & higienis</li>
                        <li>Gaya rambut kekinian sesuai keinginan Anda</li>
                    </ul>
                    <p>
                        Temukan pengalaman cukur yang berbeda bersama kami di EL BARBER!. Kami percaya, potongan rambut yang tepat bisa mengubah harimu jadi lebih percaya diri!
                    </p>
                </article>
            </div>
        </section>
    </main>
</body>
</html>