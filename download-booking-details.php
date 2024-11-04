<?php
    require_once('includes/tcpdf/tcpdf.php');

    require_once ("admin/includes/config.php");

    $booking_id = 1;

    $sql = "SELECT * FROM bookings WHERE booking_id=1";
    $result = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($result);

    // Create a new PDF instance
    $pdf = new TCPDF();

    // Set PDF metadata
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Hotel Reservation System');
    $pdf->SetTitle('Booking Details');
    $pdf->SetSubject('Room Booking Details');
    $pdf->SetKeywords('Booking, PDF, Hotel');

    // Set margins and add a page
    $pdf->SetMargins(15, 15, 15);
    $pdf->AddPage();

    // Set font for the content
    $pdf->SetFont('helvetica', '', 12);

    // Fetch booking details (from previous step)
    $customer_name = $record['customer_name'];
    $room_number = $record['room_number'];
    // $room_type = $booking_details['room_type'];
    $check_in = $record['checking_date'];
    $check_out = $record['checkout_date'];

    // PDF content
    $html = "
    <h2>Room Booking Details</h2>
    <p><strong>Customer Name:</strong> $customer_name</p>
    <p><strong>Room Number:</strong> $room_number</p>
    <p><strong>Check-In Date:</strong> $check_in</p>
    <p><strong>Check-In Time:</strong>2:00 P.M.</p>
    <p><strong>Check-Out Date:</strong> $check_out</p>
    <p><strong>Check-Out Time:</strong>12.00 P.M.</p>
    ";

    // Write content to the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output PDF as a downloadable file
    $pdf->Output('Booking_Details.pdf', 'D');
    ?>

?>