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
            transition: all;
        }

        .card:hover {
            border: 1px solid gray;
        }

        @media (min-width: 992px) {}
    </style>
</head>

<!-- Header -->
<?php include 'includes/header.php'; ?>

<body class="bg-light">
    <button class="btn btn-primary position-fixed translate-middle-y m-3" style="z-index: 1000; top: 110px; right: 0px">Add +</button>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Accommodations</h2>
    </div>
    <div class="container">
        <div class="row mb-5 bg-white rounded shadow p-4 mb-5">
            <div class="col-12 col-md-5 col-lg-4 col-xl-3 mb-3" style="overflow-y: auto; height: 400px;">

                <div class="card mb-3 shadow-sm" style="max-width: 540px; cursor:pointer;">
                    <div class="row g-0">
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This</p>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="https://www.thetimes.co.uk/imageserver/image/%2Fmethode%2Ftimes%2Fprod%2Fweb%2Fbin%2F5f40c35e-a438-11e7-8955-1ad2a9a7928d.jpg?crop=1900%2C1069%2C14%2C289&resize=1200" style="height: 100px;" alt="...">
                        </div>
                    </div>
                </div>

                <div class="card mb-3 shadow-sm" style="max-width: 540px; cursor:pointer;">
                    <div class="row g-0">
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This</p>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="https://www.thetimes.co.uk/imageserver/image/%2Fmethode%2Ftimes%2Fprod%2Fweb%2Fbin%2F5f40c35e-a438-11e7-8955-1ad2a9a7928d.jpg?crop=1900%2C1069%2C14%2C289&resize=1200" style="height: 100px;" alt="...">
                        </div>
                    </div>
                </div>

                <div class="card mb-3  shadow-sm" style="max-width: 540px; cursor:pointer;">
                    <div class="row g-0">
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This</p>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="https://www.thetimes.co.uk/imageserver/image/%2Fmethode%2Ftimes%2Fprod%2Fweb%2Fbin%2F5f40c35e-a438-11e7-8955-1ad2a9a7928d.jpg?crop=1900%2C1069%2C14%2C289&resize=1200" style="height: 100px;" alt="...">
                        </div>
                    </div>
                </div>

                <div class="card mb-3 shadow-sm" style="max-width: 540px; cursor:pointer;">
                    <div class="row g-0">
                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This</p>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="https://www.thetimes.co.uk/imageserver/image/%2Fmethode%2Ftimes%2Fprod%2Fweb%2Fbin%2F5f40c35e-a438-11e7-8955-1ad2a9a7928d.jpg?crop=1900%2C1069%2C14%2C289&resize=1200" style="height: 100px;" alt="...">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-7 col-lg-8 col-xl-9 d-flex flex-column justify-content-center align-items-center">
                <div id="map" style="height: 400px; width: 100%;"></div>
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

            // Dummy locations
            const locations = [{
                    lat: -34.5,
                    lng: 150.7,
                    name: "Location 1"
                },
                {
                    lat: -34.6,
                    lng: 150.8,
                    name: "Location 2"
                }
            ];

            // Add markers to the map
            locations.forEach(location => {
                new google.maps.Marker({
                    position: {
                        lat: location.lat,
                        lng: location.lng
                    },
                    map: map,
                    title: location.name
                });
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9C3ZQP5xjNW21JgyEmpfXX5nCRASZ4XI&callback=initMap"></script>
</body>

</html>