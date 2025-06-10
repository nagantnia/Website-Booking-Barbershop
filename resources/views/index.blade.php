<!-- filepath: c:\laravel\barbershop\resources\views\index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EL BARBER - Premium Grooming</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <main>
        <header class="header">
            <div class="logo">EL BARBER</div>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a href="{{ route('about') }}">About</a></li>
                    <li class="nav-item active"><a href="#collections">Collection</a></li>
                    <li class="nav-item"><a href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a href="#services">Services</a></li>
                    <li class="nav-item"><a href="#barbers">Barbers</a></li>
                </ul>
            </nav>
            <div class="user-section">
                @auth
                    <div class="user-dropdown">
                        <button class="user-trigger" onclick="toggleDropdown()">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="User" class="user-image">
                        </button>
                        <div class="dropdown-menu" id="userDropdown">
                            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="logout-button">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <span class="user-name">Guest</span>
                    <img src="https://ui-avatars.com/api/?name=G" alt="User" class="user-image">
                @endauth
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero">
            <h1 class="hero-title">WE WILL MAKE YOU CONFIDENT</h1>
            <p class="hero-text">
                Selamat datang di El Barber - tempat di mana setiap potongan rambut dan perawatan dirancang untuk meningkatkan rasa percaya dirimu. Kami bukan sekadar memotong rambut, kami menciptakan gaya yang membuatmu bangkit dan siap menghadapi dunia dengan keyakinan penuh.
            </p>
            @guest
                <div class="hero-auth">
                    <div class="auth-text">WANT TO GET BEST OFFER?<br>JOIN OUR MEMBER</div>
                    <a href="{{ route('register') }}" class="register-link">Register</a>
                    <div class="login-text">already joined?</div>
                    <a href="{{ route('login') }}" class="login-link">Login</a>
                </div>
            @else
                <button class="cta-button">GET YOUR CUT RIGHT NOW</button>
            @endguest
        </section>

        <!-- Collection Section -->
        <section class="collection-section" id="collections">
            <h2 class="section-title">OUR COLLECTION</h2>
            <div class="gallery">
                @forelse($collections as $post)
                    <div class="gallery-item">
                        <div class="image-container">
                            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->haircut }}">
                        </div>
                        <h3 class="item-title">{{ $post->haircut }}<br>by<br>{{ $post->barber }}</h3>
                    </div>
                @empty
                    <p>No collections available</p>
                @endforelse
            </div>
        </section>

        <!-- Services Section -->
        <section class="services-section" id="services">
            <h2 class="section-title">OUR SERVICES</h2>
            <div class="services-grid">
                @foreach($services as $post)
                    <div class="service-card">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->service_name }}">
                        <div class="service-label">{{ $post->service_name }}</div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- barbers section -->
        <section class="collection-section" id="barbers">
            <h2 class="section-title">OUR BARBER'S</h2>
            <div class="gallery">
                @forelse($barbers as $post)
                    <div class="gallery-item">
                        <div class="image-container">
                            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->barber_name }}">
                        </div>
                        <h3 class="item-title">{{ $post->barber_name }}</h3>
                    </div>
                @empty
                    <p>No Barbers available</p>
                @endforelse
            </div>
        </section>

        <!-- Pricing Section -->
        <section class="pricing-section" id="pricing">
            <h2 class="section-title">OUR PRICING</h2>
            <div class="price-list">
                @foreach($pricing as $post)
                    <div class="price-item">
                        <div class="service-name">{{ $post->pricing_name }}</div>
                        <div class="service-price">Rp {{ number_format($post->harga, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Discount Banner Section -->
        <section class="banner">
            <div class="text">
                <div class="text-wrapper">10% DISCOUNT</div>
                <div class="description">Dapatkan diskon hingga 10% ketika booking secara online.</div>
                @auth
                    <a href="{{ route('booking.create') }}" class="button">
                        <span class="text-wrapper-2">BOOK NOW</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="button">
                        <span class="text-wrapper-2">LOGIN TO BOOK</span>
                    </a>
                @endauth
            </div>
            <img class="rectangle" src="{{ asset('images/barber-banner.jpg') }}" alt="Barber Banner">
        </section>

        <!-- Appointment Reminder Section -->
        @auth
            @if(isset($latestBooking) && $latestBooking)
                <div class="appointment-reminder" id="appointmentReminder">
                    <div class="reminder-content">
                        @if($latestBooking->status === 'confirmed')
                            <div class="reminder-success">
                                <i class="fas fa-calendar-check"></i>
                                Anda mempunyai appointment di tanggal {{ $latestBooking->booking_datetime->format('d M Y') }}
                            </div>
                        @elseif($latestBooking->status === 'cancelled')
                            <div class="reminder-danger">
                                <i class="fas fa-calendar-times"></i>
                                Appointment Anda dibatalkan
                            </div>
                        @elseif($latestBooking->status === 'pending')
                            <div class="reminder-warning">
                                <i class="fas fa-clock"></i>
                                Jadwal appointment Anda sedang di proses
                            </div>
                        @endif
                        <button onclick="closeReminder()" class="reminder-close">&times;</button>
                    </div>
                </div>
            @endif
        @endauth


    </main>
    
    <footer class="footer">
        <div class="text">
            <header>
                <h2 class="text-wrapper">CONTACT US</h2>
                <p class="description">
                    El Barber adalah platform reservasi barbershop yang membantu memudahkan perawatan rambut dan maskulinitas Anda
                </p>
            </header>
            
            <div class="cards">
                <div class="card">
                    <img src="{{ asset('images/icons/location.png') }}" alt="Location" class="card-icon">
                    <h3 class="card-title">ALAMAT</h3>
                    <address class="card-text">
                        Jalan Ketintang Madya no. 51,<br>
                        Gayungan, Surabaya
                    </address>
                </div>
                
                <div class="card">
                    <img src="{{ asset('images/icons/envelope.png') }}" alt="Email" class="card-icon">
                    <h3 class="card-title">EMAIL</h3>
                    <a href="mailto:elbarber@gmail.com" class="card-text">elbarber@gmail.com</a>
                </div>
                
                <div class="card">
                    <img src="{{ asset('images/icons/phone.png') }}" alt="Phone" class="card-icon">
                    <h3 class="card-title">KONTAK</h3>
                    <div class="card-text">
                        <a href="tel:+62895230740">(+62) 895 2307 4040</a><br>
                        <a href="tel:+62893245021">(+62) 893 2450 2140</a>
                    </div>
                </div>
                
                <div class="card">
                    <img src="{{ asset('images/icons/clock.png') }}" alt="Clock" class="card-icon">
                    <h3 class="card-title">JAM KERJA</h3>
                    <p class="card-text">
                        Senin - Jumat : 09.00 - 21.00<br>
                        Sabtu - Minggu : 10.00 - 20.00
                    </p>
                </div>
            </div>
        </div>
        
        <hr class="divider">
        <p class="copyright">© Copyright El Barber 2025</p>
    </footer>

    <nav class="navbar">
        <!-- ...existing nav items... -->
        @auth
            <div class="nav-item dropdown">
                <span class="welcome-text">Welcome, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        @endauth
    </nav>

    <style>
        .nav-item.dropdown {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .welcome-text {
            color: #fff;
            font-size: 0.9rem;
        }

        .logout-button {
            background: #9D9570;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background: #817c5b;
        }

        .logout-form {
            margin: 0;
        }

        .user-section {
            position: relative;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-dropdown {
            position: relative;
        }

        .user-trigger {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            color: white;
        }

        .user-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: #292D33;
            border-radius: 5px;
            padding: 0.5rem;
            min-width: 150px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .dropdown-menu.show {
            display: block;
        }

        .logout-button {
            width: 100%;
            background: #9D9570;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background: #817c5b;
        }

        .logout-form {
            margin: 0;
        }
    </style>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.user-trigger') && !event.target.matches('.user-image') && !event.target.matches('.user-name')) {
                const dropdowns = document.getElementsByClassName('dropdown-menu');
                for (let dropdown of dropdowns) {
                    if (dropdown.classList.contains('show')) {
                        dropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>