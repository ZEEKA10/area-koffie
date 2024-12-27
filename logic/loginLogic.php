<?php
session_start();
require '../logic/koneksi.php';

// Retrieve form data
$email = $_POST["email"];
$pass = md5($_POST["password"]);
$nama = $_POST["nama"];

// Check if the email is empty and redirect if so
if (empty($email)) {
    header("Location: ../index.php");
    exit();
}

// Correct SQL query with column names matching the database schema
$queryDaftar = "INSERT INTO user (email, nama, password) VALUES ('$email', '$nama', '$pass')";

// Execute the query
if (mysqli_query($conn, $queryDaftar)) {
    // Redirect to login page with a success message if the query is successful
    echo "
    <script>
    alert('Selamat Datang');
    window.location.href = '../views/login.php';
    </script>
    ";
} else {
    // Display an error if the query fails
    echo "Error: " . mysqli_error($conn);
}
?>
