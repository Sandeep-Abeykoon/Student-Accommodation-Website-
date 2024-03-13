<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9C3ZQP5xjNW21JgyEmpfXX5nCRASZ4XI&callback=initMap"></script>
    <?php include './includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : Accommodations</title>
    <style>
        /* Additional custom styles */
        .accommodation-card {
            margin-bottom: 20px;
        }

        /* Set map height to 70vh (70% of the viewport height) */
        #map {
            height: 70vh;
        }

        @media (max-width: 768px) {

            /* For smaller screens, increase map height to 90vh (90% of the viewport height) */
            #map {
                height: 90vh;
            }
        }
    </style>
</head>

<body class="bg-light">
    <!-- Header -->
    <?php include './includes/header.php'; ?>

    <div class="container">
        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Available Accommodations</h2>
        <div class="row">


            <!-- Map Section -->
            <div class="col-md-12">
                <div id="map"></div>
            </div>

        </div>
    </div>
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script>
        function initMap() {
            // Map options
            var options = {
                zoom: 10,
                center: {
                    lat: -34.397,
                    lng: 150.644
                } // Default center (update with actual center coordinates)
            };

            // Initialize the map
            var map = new google.maps.Map(document.getElementById('map'), options);

            // Accommodation markers
            var markers = [{
                    coords: {
                        lat: 7.001418,
                        lng: 79.949871,
                    }, // Example coordinates (update with actual coordinates)
                    title: 'Accommodation 1'
                },
                {
                    coords: {
                        lat: -34.397,
                        lng: 150.644
                    }, // Example coordinates (update with actual coordinates)
                    title: 'Accommodation 2'
                },
                {
                    coords: {
                        lat: -34.397,
                        lng: 150.644
                    }, // Example coordinates (update with actual coordinates)
                    title: 'Accommodation 3'
                }
            ];

            // Add markers to the map
            markers.forEach(function(marker) {
                new google.maps.Marker({
                    position: marker.coords,
                    map: map,
                    title: marker.title
                });
            });
        }
    </script>

</body>

</html>