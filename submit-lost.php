<?php

error_reporting(0);
ini_set('display_errors', 0);

include 'config/db.php';
include 'config/aws.php';

/* =========================
   GET FORM DATA
========================= */
$name = $_POST['name'];
$usn = $_POST['usn'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$item_name = $_POST['item_name'];
$description = $_POST['description'];
$location = $_POST['location'];

/* =========================
   CHECK OR INSERT USER
   (ALLOW MULTIPLE ITEMS PER USN)
========================= */
$checkUser = $conn->query("SELECT id FROM users WHERE usn='$usn'");

if ($checkUser->num_rows > 0) {

    $row = $checkUser->fetch_assoc();
    $user_id = $row['id'];

} else {

    $conn->query("
        INSERT INTO users(name, usn, email, phone)
        VALUES('$name','$usn','$email','$phone')
    ");

    $user_id = $conn->insert_id;
}

/* =========================
   UPLOAD IMAGE TO S3
========================= */
$image = $_FILES['image'];
$fileName = time() . "-" . basename($image['name']);

$result = $s3->putObject([
    'Bucket' => $bucketName,
    'Key' => $fileName,
    'SourceFile' => $image['tmp_name']
]);

$imageURL = $result['ObjectURL'];

/* =========================
   AMAZON REKOGNITION
========================= */
$imageBytes = file_get_contents($image['tmp_name']);

$response = $rekognition->detectLabels([
    'Image' => [
        'Bytes' => $imageBytes
    ],
    'MaxLabels' => 10,
    'MinConfidence' => 75
]);

$labels = [];

foreach ($response['Labels'] as $label) {
    $labels[] = $label['Name'];
}

$labelsString = implode(", ", $labels);

/* =========================
   SAVE LOST ITEM
========================= */
$conn->query("
INSERT INTO lost_items
(user_id, item_name, description, location, image_url, labels)
VALUES
('$user_id',
'$item_name',
'$description',
'$location',
'$imageURL',
'$labelsString')
");

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body text-center p-5">

                    <div class="display-1 text-success mb-3">
                        ✅
                    </div>

                    <h2 class="fw-bold text-success">
                        Lost Item Reported Successfully!
                    </h2>

                    <p class="text-muted">
                        We are actively searching and matching your item using AWS Rekognition.
                    </p>

                    <hr>

                    <img src="<?php echo $imageURL; ?>"
                         class="img-fluid rounded-4 shadow mb-4"
                         style="max-height:350px;">

                    <h5 class="mb-3">Detected Labels</h5>

                    <?php
                    foreach ($labels as $label) {
                        echo "<span class='badge bg-primary me-2 mb-2 p-2'>$label</span>";
                    }
                    ?>

                    <hr class="my-4">

                    <a href="index.php" class="btn btn-primary me-2">
                        Home
                    </a>

                    <a href="report-lost.php" class="btn btn-danger">
                        Report Another
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
