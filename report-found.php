<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header bg-success text-white p-4 rounded-top-4">

                    <h2 class="mb-0">
                        <i class="bi bi-check-circle"></i>
                        Report Found Item
                    </h2>

                    <p class="mb-0 mt-2">
                        Fill in the details below to report a found item.
                    </p>

                </div>

                <div class="card-body p-4">

                    <form action="submit-found.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">USN</label>
                            <input type="text" name="usn" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Item Name</label>
                            <input type="text" name="item_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Found Location</label>
                            <input type="text" name="location" class="form-control">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button class="btn btn-success px-4">
                            <i class="bi bi-upload"></i>
                            Submit Report
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
