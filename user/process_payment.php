<?php
session_start();
include '../includes/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

// Get the property ID from URL
$property_id = isset($_GET['property_id']) ? $_GET['property_id'] : null;

if (!$property_id) {
    $_SESSION['error_message'] = "Invalid property ID.";
    header('Location: available_properties.php');
    exit();
}

if (isset($_GET['status'])) {
    $status = $_GET['status'];
    
    if ($status == 'successful') {
        $tx_ref = $_GET['tx_ref'];
        $transaction_id = $_GET['transaction_id'];

        // Verify the transaction
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/".$transaction_id."/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: FLWSECK_TEST-6f84d355a076139a05467c4750ed91cc-X" // Replace with your secret key
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);

        if ($result['status'] === 'success') {
            // Payment verified successfully
            $user_id = $_SESSION['user']['id'];
            $amount = $result['data']['amount'];
            $payment_date = date('Y-m-d H:i:s');

            // Insert payment record
            $payment_query = "INSERT INTO payments (user_id, property_id, amount_paid, transaction_id, payment_date) 
                            VALUES ('$user_id', '$property_id', '$amount', '$transaction_id', '$payment_date')";
            mysqli_query($conn, $payment_query);

            // Update property availability
            $update_query = "UPDATE properties SET available = 0 WHERE id = '$property_id'";
            mysqli_query($conn, $update_query);

            // Create rental record
            $rental_query = "INSERT INTO rentals (user_id, property_id, created_at) 
                           VALUES ('$user_id', '$property_id', '$payment_date')";
            mysqli_query($conn, $rental_query);

            $_SESSION['success_message'] = "Payment successful! Property has been rented.";
        } else {
            $_SESSION['error_message'] = "Payment verification failed.";
        }
    } else {
        $_SESSION['error_message'] = "Payment was not successful.";
    }
    
    // Always redirect back to property details
    header("Location: property_details.php?id=" . $property_id);
    exit();
}

// If no status parameter is set, redirect back to property details
header("Location: property_details.php?id=" . $property_id);
exit();
?> 