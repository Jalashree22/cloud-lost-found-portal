<!doctype html>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header bg-danger text-white p-4 rounded-top-4">

                    <h2 class="mb-0">
                        <i class="bi bi-search"></i>
                        Report Lost Item
                    </h2>

                    <p class="mb-0 mt-2">
                        Fill in the details below to report your lost item.
                    </p>

                </div>

                <div class="card-body p-4">
<body>

<div class="container mt-5">

<h2 class="text-danger">
Report Lost Item
</h2>

<form action="submit-lost.php" method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>USN</label>
<input type="text" name="usn" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="mb-3">
<label>Item Name</label>
<input type="text" name="item_name" class="form-control" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control"></textarea>
</div>

<div class="mb-3">
<label>Lost Location</label>
<input type="text" name="location" class="form-control">
</div>

<div class="mb-3">
<label>Upload Image</label>
<input type="file" name="image" class="form-control">
</div>

<button class="btn btn-danger">
Submit
</button>

</form>

</div>

</body>

</html>
