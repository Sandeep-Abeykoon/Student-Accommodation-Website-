<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : Pending Accommodations</title>
    <style>
        /* Add your custom styles here */
    </style>
</head>

<!-- Header -->
<?php include 'includes/header.php'; ?>

<body class="bg-light">

    <div class="container my-5">
        <h2 class="fw-bold h-font text-center">Pending Accommodations</h2>

        <!-- List of Pending Accommodations -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            // Example loop for pending accommodations
            for ($i = 0; $i < 6; $i++) {
                echo '
        <div class="col">
            <div class="card h-100">
                <img src="https://www.thetimes.co.uk/imageserver/image/%2Fmethode%2Ftimes%2Fprod%2Fweb%2Fbin%2F5f40c35e-a438-11e7-8955-1ad2a9a7928d.jpg?crop=1900%2C1069%2C14%2C289&resize=1200" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Accommodation Name</h5>
                    <p class="card-text">Description</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">View Details</a>
                    <button class="btn btn-success">Accept</button>
                    <button class="btn btn-danger">Decline</button> <!-- Added Decline button -->
                </div>
            </div>
        </div>';
            }
            ?>
        </div>
    </div>

    <!-- Accommodation Details Modal -->
    <div class="modal fade" id="accommodationDetailsModal" tabindex="-1" aria-labelledby="accommodationDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accommodationDetailsModalLabel">Accommodation Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your accommodation details content here -->
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

</body>

</html>