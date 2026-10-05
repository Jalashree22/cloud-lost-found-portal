<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit();
}

include 'config/db.php';

$lostItems = $conn->query("SELECT * FROM lost_items ORDER BY id DESC");
$foundItems = $conn->query("SELECT * FROM found_items ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#f4f6f9; }

        .card-box {
            background:#fff;
            padding:20px;
            border-radius:12px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
            margin-bottom:20px;
        }

        .img-thumb {
            width:90px;
            height:70px;
            object-fit:cover;
            border-radius:8px;
        }

        .match-row {
            background:#fff3cd;
        }

        .badge-label {
            background:#0d6efd;
            color:white;
            padding:4px 8px;
            border-radius:6px;
            font-size:12px;
        }
    </style>
</head>

<body>

<div class="container mt-4">

<h2 class="text-center mb-4">
Cloud Based Lost & Found Portal - Admin Dashboard
</h2>

<a href="index.php" class="btn btn-primary mb-3">Home</a>

<!-- LOST -->
<div class="card-box">
<h4 class="text-danger">Lost Items</h4>

<table class="table table-hover">
<tr class="table-dark">
<th>ID</th><th>Image</th><th>Item</th><th>Status</th>
</tr>

<?php while($l=$lostItems->fetch_assoc()) { ?>
<tr>
<td><?= $l['id'] ?></td>
<td><img src="<?= $l['image_url'] ?>" class="img-thumb"></td>
<td><?= $l['item_name'] ?></td>
<td><?= $l['status'] ?></td>
</tr>
<?php } ?>

</table>
</div>

<!-- FOUND -->
<div class="card-box">
<h4 class="text-success">Found Items</h4>

<table class="table table-hover">
<tr class="table-dark">
<th>ID</th><th>Image</th><th>Item</th><th>Status</th>
</tr>

<?php while($f=$foundItems->fetch_assoc()) { ?>
<tr>
<td><?= $f['id'] ?></td>
<td><img src="<?= $f['image_url'] ?>" class="img-thumb"></td>
<td><?= $f['item_name'] ?></td>
<td><?= $f['status'] ?></td>
</tr>
<?php } ?>

</table>
</div>

<!-- MATCHING -->
<div class="card-box">

<h4 class="text-primary">REAL Matches (Filtered)</h4>

<table class="table table-bordered">
<tr class="table-dark">
<th>Lost</th>
<th>Found</th>
<th>Common Labels</th>
<th>Notify</th>
</tr>

<?php
$lostItems = $conn->query("SELECT * FROM lost_items");

while ($lost = $lostItems->fetch_assoc()) {

    $foundItems = $conn->query("SELECT * FROM found_items");

    while ($found = $foundItems->fetch_assoc()) {

        $lostLabels = array_map('trim', explode(",", strtolower($lost['labels'])));
        $foundLabels = array_map('trim', explode(",", strtolower($found['labels'])));

        $common = array_intersect($lostLabels, $foundLabels);

        // ONLY REAL MATCHES (NO CARTESIAN OUTPUT)
        if (count($common) >= 2) {
?>

<tr class="match-row">

<td>
<img src="<?= $lost['image_url'] ?>" class="img-thumb"><br>
<?= $lost['item_name'] ?>
</td>

<td>
<img src="<?= $found['image_url'] ?>" class="img-thumb"><br>
<?= $found['item_name'] ?>
</td>

<td>
<span class="badge-label"><?= implode(", ", $common) ?></span>
</td>

<td>
<a href="notify.php?lost_id=<?= $lost['id'] ?>&found_id=<?= $found['id'] ?>" 
class="btn btn-success btn-sm">
Notify
</a>
</td>

</tr>

<?php
        }
    }
}
?>

</table>

</div>

</div>

</body>
</html>
