<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="hero text-center">

<div class="container">

<h1>Cloud Lost & Found Portal</h1>

<p>
A Smart Lost & Found System powered by AWS Cloud Services
</p>

<div class="mt-4">

<a href="report-lost.php" class="btn btn-danger btn-lg btn-custom me-3">
<i class="bi bi-search"></i>
Report Lost
</a>

<a href="report-found.php" class="btn btn-success btn-lg btn-custom me-3">
<i class="bi bi-check-circle"></i>
Report Found
</a>

<a href="admin-login.php" class="btn btn-light btn-lg btn-custom">
<i class="bi bi-person-lock"></i>
Admin
</a>

</div>

</div>

</section>

<div class="container my-5">

<div class="row text-center g-4">

<div class="col-md-3">
<div class="card stats-card p-4">
<h2>150+</h2>
<p>Lost Items</p>
</div>
</div>

<div class="col-md-3">
<div class="card stats-card p-4">
<h2>120+</h2>
<p>Found Items</p>
</div>
</div>

<div class="col-md-3">
<div class="card stats-card p-4">
<h2>95+</h2>
<p>Returned</p>
</div>
</div>

<div class="col-md-3">
<div class="card stats-card p-4">
<h2>300+</h2>
<p>Users</p>
</div>
</div>

</div>

</div>

<div class="container my-5">

<h2 class="text-center mb-5">Why Choose Our Portal?</h2>

<div class="row g-4">

<div class="col-md-4">

<div class="feature-card text-center">

<i class="bi bi-cloud-fill"></i>

<h4 class="mt-3">Cloud Storage</h4>

<p>
Images are securely stored using Amazon S3.
</p>

</div>

</div>

<div class="col-md-4">

<div class="feature-card text-center">

<i class="bi bi-cpu-fill"></i>

<h4 class="mt-3">AI Recognition</h4>

<p>
Amazon Rekognition automatically identifies objects.
</p>

</div>

</div>

<div class="col-md-4">

<div class="feature-card text-center">

<i class="bi bi-bell-fill"></i>

<h4 class="mt-3">Instant Alerts</h4>

<p>
Amazon SNS notifies users when a match is found.
</p>

</div>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>
