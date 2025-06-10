<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt - El Barber</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #9D9570;
        }

        .receipt-container {
            background: #292D33;
            padding: 3rem;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            color: white;
            text-align: center;
            margin: 2rem;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
        }

        .receipt-header {
            margin-bottom: 2rem;
        }

        .receipt-header h1 {
            color: #4CAF50;
            margin-bottom: 0.5rem;
        }

        .receipt-details {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 5px;
            text-align: left;
            margin-bottom: 2rem;
        }

        .detail-item {
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
        }

        .detail-label {
            font-weight: 500;
            color: #9D9570;
        }

        .contact-info {
            text-align: left;
            font-size: 0.9rem;
            color: #9D9570;
        }

        .contact-info p {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="success-icon">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M8 12l2 2 4-4"></path>
        </svg>
        
        <div class="receipt-header">
            <h1>✓ Booking Berhasil!</h1>
            <p>Terima kasih,<br>Booking Anda telah berhasil dilakukan. Berikut detailnya:</p>
        </div>

        <div class="receipt-details">
            <div class="detail-item">
                <span class="detail-label">Nama Lengkap:</span>
                <span>{{ $booking->full_name }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Services:</span>
                <span>
                    @foreach($booking->services as $service)
                        {{ $service->pricing_name }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                </span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Tanggal:</span>
                <span>{{ $booking->booking_datetime->format('d M Y') }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Waktu:</span>
                <span>{{ $booking->booking_datetime->format('H:i') }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Barber:</span>
                <span>{{ $booking->barber->barber_name }}</span>
            </div>
        </div>

        <div class="contact-info">
            <p>Silahkan kirim receipt booking ini ke Admin untuk di konfirmasi:</p>
            <p>WA : (+62) 895 2307 4040</p>
            <p>Email : elbarber@gmail.com</p>
        </div>
    </div>
</body>
</html>