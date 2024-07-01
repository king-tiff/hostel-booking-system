<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f9;
        }
        .container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #4a4a4a;
        }
        .content {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #4a4a4a;
        }
        .value {
            margin-left: 10px;
            color: #6c757d;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #a0a0a0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('images/AppLogo.jpeg') }}" alt="Logo">
            <h1>Booking Details</h1>
        </div>
        <div class="content">
            <span class="label">Applicant Name:</span>
            <span class="value">{{ $booking->user->name }}</span>
        </div>
        <div class="content">
            <span class="label">Room Type:</span>
            <span class="value">{{ $booking->room->type }} Room</span>
        </div>
        <div class="content">
            <span class="label">Number of Beds in a Room:</span>
            <span class="value">{{ $booking->room->num_of_beds_per_room }}</span>
        </div>
        <div class="content">
            <span class="label">Room Price:</span>
            <span class="value">{{ $booking->room->price }}</span>
        </div>
        <div class="content">
            <span class="label">Duration:</span>
            <span class="value">{{ $booking->room->duration }}</span>
        </div>
        <div class="content">
            <span class="label">Hostel Name:</span>
            <span class="value">{{ $booking->room->hostel->name }}</span>
        </div>
        <div class="content">
            <span class="label">Hostel Location:</span>
            <span class="value">{{ $booking->room->hostel->location }}</span>
        </div>
        <div class="content">
            <span class="label">Check In Date:</span>
            <span class="value">{{ $booking->check_in_date }}</span>
        </div>
        <div class="content">
            <span class="label">Check Out Date:</span>
            <span class="value">{{ $booking->check_out_date }}</span>
        </div>
        <div class="content">
            <span class="label">Status:</span>
            <span class="value">{{ $booking->status }}</span>
        </div>
        <div class="content">
            <span class="label">Mobile Number:</span>
            <span class="value">{{ $booking->room->hostel->number }}</span>
        </div>
        @if($booking->status == 'Approved')
            <div class="content">
                <span class="label">Payment Method:</span>
                <span class="value">{{ $booking->room->hostel->payment_method }}</span>
            </div>
            <div class="content">
                <span class="label">Payment Number:</span>
                <span class="value">{{ $booking->room->hostel->payment_number }}</span>
            </div>
        @endif
        <div class="footer">
            © {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>
</html>
