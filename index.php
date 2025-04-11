<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./public/3593455.png">
    <title>Discuss</title>

    <?php include './client/commonFiles.php'; ?>
</head>

<body>
    <?php
    include './client/header.php';

    if (isset($_GET['signup']) && empty($_SESSION['name']['name'])) {
        include './client/signUp.php';
    } elseif (isset($_GET['login']) && empty($_SESSION['name']['name'])) {
        include './client/login.php';
    } elseif (!empty($_SESSION['name']['name']) && (isset($_GET['signup']) || isset($_GET['login']))) {
        echo "<div class='container mt-5'><h3>You are already logged in.</h3></div>";
    } elseif (isset($_GET['ask'])) {
        include './client/ask.php';
    } elseif (isset($_GET['category'])) {
        include './client/add_category.php';
    } elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
        include './client/question_details.php';
    } elseif (isset($_GET['myquestions'])) {
        include './client/my_questions.php';
    } elseif (isset($_GET['latest'])) {
        include './client/questions.php';
    } elseif (isset($_GET['search'])) {
        include './client/questions.php';
    } else {
        include './client/questions.php';
    }

    ?>



</body>

</html>