<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : Accommodations</title>
    <style>
        #map {
            height: 100%;
            width: 100%;
            border-radius: 10px;
        }

        @media (min-width: 992px) {}
    </style>
</head>

<!-- Header -->
<?php include 'includes/header.php'; ?>

<body class="bg-light">
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Accommodations</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card mb-3">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Accommodation 1</h5>
                        <p class="card-text">Description of accommodation 1.</p>
                    </div>
                </div>
                <div class="card mb-3">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Accommodation 2</h5>
                        <p class="card-text">Description of accommodation 2.</p>
                    </div>
                </div>
                <!-- Add more cards for other accommodations -->
            </div>
            <div class="col-lg-9">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <?php include 'includes/scripts.php'; ?>

    <!-- Google Maps JavaScript API -->
    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8,
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
</body>

</html>