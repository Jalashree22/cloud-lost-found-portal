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
$check = $conn->query("SELECT id FROM users WHERE usn='$usn'");

if ($check->num_rows > 0) {
    $row = $check->fetch_assoc();
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
   REKOGNITION
========================= */
$imageBytes = file_get_contents($image['tmp_name']);

$response = $rekognition->detectLabels([
    'Image' => [
        'Bytes' => $imageBytes
    ],
    'MaxLabels' => 10,
    'MinConfidence' => 70
]);

$labels = [];

foreach ($response['Labels'] as $label) {
    $labels[] = $label['Name'];
}

$labelsString = implode(", ", $labels);

/* =========================
   SAVE INTO DATABASE
========================= */
$conn->query("
INSERT INTO found_items
(user_id, item_name, description, location, image_url, labels)
VALUES
('$user_id','$item_name','$description','$location','$imageURL','$labelsString')
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
                        Found Item Submitted Successfully!
                    </h2>

                    <p class="text-muted">
                        We will match your item using AWS Rekognition.
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

                    <div class="d-flex justify-content-center gap-3 flex-wrap">

                        <a href="index.php" class="btn btn-primary">
                            Home
                        </a>

                        <a href="report-found.php" class="btn btn-success">
                            Report Another
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
