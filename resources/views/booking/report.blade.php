<!DOCTYPE html>
<html>
<head>
    <title>Booking Report</title>
</head>
<body>
    <h1>Booking Report</h1>
    <p>Applicant Name: {{ $booking->user->name }}</p>
    <p>Room Type: {{ $booking->room->type }} Room</p>
    <p>Number of Beds in a Room: {{ $booking->room->num_of_beds_per_room }}</p>
    <p>Room Price: {{ $booking->room->price }}</p>
    <p>Duration: {{ $booking->room->duration }}</p>
    <p>Hostel Name: {{ $booking->room->hostel->name }}</p>
    <p>Hostel Location: {{ $booking->room->hostel->location }}</p>
    <p>Check In Date: {{ $booking->check_in_date }}</p>
    <p>Check Out Date: {{ $booking->check_out_date }}</p>
    <p>Status: {{ $booking->status }}</p>
</body>
</html>
