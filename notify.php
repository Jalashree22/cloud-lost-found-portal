<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit();
}

include 'config/aws.php';

$topicArn = $secrets['sns_topic_arn'];

try {

    $sns->publish([
        'TopicArn' => $topicArn,
        'Subject' => 'Lost & Found Portal - Possible Match Found',
        'Message' => "A possible match has been found for your lost item.\n\nPlease contact the Lost & Found Administrator for verification.\n\nThank you."
    ]);

} catch (Exception $e) {

    die("Error sending notification: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Email Notification Sent</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
    background:#f4f7fc;
}

.success-card{

    max-width:650px;

    margin:80px auto;

    background:#fff;

    padding:40px;

    border-radius:20px;

    box-shadow:0 10px 30px rgba(0,0,0,.15);

    text-align:center;
}

.success-icon{

    font-size:90px;

    color:#28a745;

    margin-bottom:20px;
}

.btn{

    margin-top:20px;
}

</style>

</head>

<body>

<div class="success-card">

<i class="fas fa-check-circle success-icon"></i>

<h2 class="text-success">
Email Notification Sent Successfully!
</h2>

<p class="lead mt-3">
A possible match notification has been sent successfully using
<strong>Amazon SNS</strong>.
</p>

<p class="text-muted">
The subscribed users will receive an email notification about the possible match.
</p>

<a href="dashboard.php" class="btn btn-success btn-lg">

<i class="fas fa-arrow-left"></i>

Back to Dashboard

</a>

</div>

<script>

setTimeout(function(){

    window.location.href="dashboard.php";

},3000);

</script>

</body>

</html>
