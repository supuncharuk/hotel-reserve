<?php
    require_once('includes/tcpdf/tcpdf.php');

    require_once ("admin/includes/config.php");

    if (isset($_REQUEST['id'])){
        $booking_id = $_GET["id"];
    }

    $sql = "SELECT * FROM bookings WHERE booking_id = '$booking_id'";
    $result = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($result);
    // var_dump($record);

    // Create a new PDF instance
    $pdf = new TCPDF();

    // Set PDF metadata
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Hotel Reservation System');
    $pdf->SetTitle('Payment Details');
    $pdf->SetSubject('Room Payment Details');
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

    $checkin_date = strtotime($check_in);
    $checkout_date= strtotime($check_out);

    $diffInSeconds =  $checkout_date - $checkin_date;
    $diffInDays = $diffInSeconds / (60 * 60 * 24); // Convert seconds to days
    $ndays = $diffInDays;

    $vat = $record['vat'];
    $ssc_levy = $record['ssc_levy'];
    $discount = $record['discount'];
    $total_payment = $record['total_payment'];

    // PDF content
    $html = "
    <h2>Room Payment Details</h2>
    <p><strong>Customer Name:</strong> $customer_name</p>
    <p><strong>Room Number:</strong> $room_number</p>
    <p><strong>Check-In Date:</strong> $check_in</p>
    <p><strong>Check-Out Date:</strong> $check_out</p>
    <p><strong>Number of Days:</strong> $ndays</p>
    <hr>

    <p><strong>VAT:</strong> Rs. $vat</p>
    <p><strong>SSC_Levy:</strong> Rs. $ssc_levy</p>
    <p><strong>Discount:</strong> Rs. $discount</p>
    <p><strong>Total Payment:</strong> Rs. $total_payment</p>";

    // Write content to the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output PDF as a downloadable file
    $pdf->Output('Payment_Details.pdf', 'D');

    echo "<script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 3000); // Redirect after 3 seconds
    </script>";

?>