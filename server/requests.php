<?php

session_start();

include '../common/db.php';

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = $_POST['address'];

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Email already exists. Please login or use another email.'); window.location.href = '../index.php?signup=true';</script>";
        exit;
    }

    $user = $conn->prepare("INSERT INTO `users` (name, email, password, address) VALUES (?, ?, ?, ?)");
    if (!$user) {
        die("Prepare failed: " . $conn->error);
    }

    $user->bind_param("ssss", $name, $email, $password, $address);

    if ($user->execute()) {
        echo "<script>alert('Registration successful. Please login.'); window.location.href = '../index.php?login=true';</script>";
        exit;
    } else {
        echo "Error: " . $user->error;
    }
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['name'] = ["id" => $user['id'], 'name' => $user['name'], 'email' => $user['email']];
        header("Location: ../index.php");
        exit;
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href = '../index.php?login=true';</script>";
    }
}

if (isset($_POST['ask'])) {
   echo $title = trim($_POST['title']);
   echo $description = trim($_POST['description']);
   echo $category_id = $_POST['category_id'];
   echo $user_id = $_SESSION['id'] ?? null;

   
    // if (empty($title) || empty($description) || empty($category_id)) {
    //     echo "<script>alert('All fields are required'); window.location.href = '../index.php?ask=true';</script>";
    //     exit;
    // }

    // // Now insert the question
    // $stmt = $conn->prepare("INSERT INTO questions (title, description, category_id, user_id) VALUES (?, ?, ?, ?)");
    // $stmt->bind_param("ssii", $title, $description, $category_id, $user_id);

    // if ($stmt->execute()) {
    //     echo "<script>alert('Question submitted successfully'); window.location.href = '../index.php';</script>";
    // } else {
    //     echo "<script>alert('Error: " . $stmt->error . "');</script>";
    // }
}
