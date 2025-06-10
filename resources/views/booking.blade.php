<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - El Barber</title>
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
            background: #292D33;
            color: #fff;
            padding: 2rem;
        }

        .booking-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .booking-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .booking-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .booking-form {
            background: rgba(157, 149, 112, 0.1);
            padding: 2rem;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #9D9570;
            border-radius: 5px;
            background: transparent;
            color: #fff;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #fff;
        }

        .form-control option {
            background-color: white;
            color: black;
        }

        /* Optional: Style the select element when opened */
        .form-control:focus option:checked {
            background: #9D9570;
            color: white;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .service-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .datetime-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .total-price {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #9D9570;
            text-align: right;
            font-size: 1.25rem;
        }

        .btn-book {
            width: 100%;
            padding: 1rem;
            background: #9D9570;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        .btn-book:hover {
            background: #817c5b;
        }

        @media (max-width: 768px) {
            .datetime-group {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <div class="booking-header">
            <h1>Book Your Appointment</h1>
            <p>Choose your preferred services and schedule</p>
        </div>

        <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
            </div>

            <div class="form-group">
                <label>Services</label>
                <div class="services-grid">
                    @foreach($pricing as $service)
                    <div class="service-item">
                        <input type="checkbox" name="services[]" value="{{ $service->id }}" 
                               id="service-{{ $service->id }}" data-price="{{ $service->harga }}">
                        <label for="service-{{ $service->id }}">
                            {{ $service->pricing_name }} - Rp {{ number_format($service->harga, 0, ',', '.') }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="barber_id">Choose Barber</label>
                <select class="form-control" id="barber_id" name="barber_id" required>
                    <option value="">Select a barber</option>
                    @foreach($barbers as $barber)
                    <option value="{{ $barber->id }}">{{ $barber->barber_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="datetime-group">
                <div class="form-group">
                    <label for="booking_date">Date</label>
                    <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                </div>

                <div class="form-group">
                    <label for="booking_time">Time</label>
                    <input type="time" class="form-control" id="booking_time" name="booking_time" required>
                </div>
            </div>

            <div class="total-price">
                Total: Rp <span id="total">0</span>
            </div>

            <button type="submit" class="btn-book">Book Now</button>
        </form>
    </div>

    <script>
        // Calculate total price when services are selected
        const serviceCheckboxes = document.querySelectorAll('input[name="services[]"]');
        const totalSpan = document.getElementById('total');

        function calculateTotal() {
            let total = 0;
            serviceCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.dataset.price);
                }
            });
            totalSpan.textContent = total.toLocaleString('id-ID');
        }

        serviceCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });
    </script>
</body>
</html>