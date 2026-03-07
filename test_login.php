<?php

$conn = new mysqli("localhost", "root", "", "inventory_production");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = "admin";
$password = "admin.123";

// Fetch user
$stmt = $conn->prepare("SELECT password_hash FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password_hash'])) {
        echo "✅ Password is correct";
    } else {
        echo "❌ Password is wrong";
    }
} else {
    echo "User not found";
}

$conn->close();
?>