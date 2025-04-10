<?php
session_start();
require_once 'fb-config.php'; // Include the Facebook config file

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

try {
    // Get the access token from Facebook
    $accessToken = $helper->getAccessToken();
    
    if (isset($accessToken)) {
        // Store the access token in session
        $_SESSION['facebook_access_token'] = (string) $accessToken;

        // Get user info from Facebook
        $response = $fb->get('/me?fields=id,name,email', $accessToken);
        $user = $response->getGraphUser();

        // Output user data for testing
        echo 'Name: ' . $user['name'] . '<br>';
        echo 'Email: ' . $user['email'] . '<br>';

        // You can now use this data (e.g., save to your DB or auto-login the user)
        
        // For now, redirect to avoid the page showing any debug info
        header('Location: index.php');
        exit;
    }
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // Handle error if Facebook returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // Handle error if Facebook SDK returns an error
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
?>



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
        require_once 'fb-config.php';

        echo '<a href="' . htmlspecialchars($loginUrl) . '" class="btn btn-primary">Login with Facebook</a>';
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