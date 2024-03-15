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

        @keyframes glow {
            0% {
                box-shadow: 0 0 10px rgba(0, 0, 255, 0.5);
            }

            50% {
                box-shadow: 0 0 20px rgba(0, 0, 255, 0.8);
            }

            100% {
                box-shadow: 0 0 10px rgba(0, 0, 255, 0.5);
            }
        }

        .glow-button {
            animation: glow 1s infinite;
        }

        @media (min-width: 992px) {}
    </style>
</head>

<!-- Header -->
<?php include 'includes/header.php'; ?>

<?php
$add_accommodation_btn = "";
if (!$settings_result['shutdown'] && isset($_SESSION['uRole']) && $_SESSION['uRole'] == 'landlord') {
    $add_accommodation_btn = '<button data-bs-toggle="modal" data-bs-target="#addAccommodationModal" class="btn btn-primary position-fixed translate-middle-y m-3 glow-button" style="z-index: 1000; top: 110px; right: 0px">Add +</button>';
}
?>

<body class="bg-light">

    <?php echo ($add_accommodation_btn) ?>

    <!-- Add Accommodation Modal -->
    <div class="modal fade" id="addAccommodationModal" tabindex="-1" aria-labelledby="addAccommodationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccommodationModalLabel">Add Accommodation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Accommodation Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Google Maps Share Location Link</label>
                            <input type="text" class="form-control" id="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail Image</label>
                            <input type="file" class="form-control" id="thumbnail" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" class="form-control" id="images" accept="image/*" multiple required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="bathrooms" class="form-label">No. of Bathrooms</label>
                                <input type="number" class="form-control" id="bathrooms" required>
                            </div>
                            <div class="col-md-6">
                                <label for="kitchens" class="form-label">No. of Kitchens</label>
                                <input type="number" class="form-control" id="kitchens" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="rooms" class="form-label">No. of Rooms</label>
                                <input type="number" class="form-control" id="rooms" required>
                            </div>
                            <div class="col-md-6">
                                <label for="beds" class="form-label">No. of Beds</label>
                                <input type="number" class="form-control" id="beds" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="capacity" required>
                        </div>
                        <div class="text-end my-1">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        <input type="hidden" id="uId" value="<?php echo $_SESSION['uId']; ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>


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

    <script>
        // Add Accommodation
        document.addEventListener('DOMContentLoaded', function() {
            let addAccommodationForm = document.querySelector('#addAccommodationModal form');
            addAccommodationForm.addEventListener('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(addAccommodationForm);
                let uId = document.getElementById('uId').value;
                formData.append('add_accommodation', '');

                // Retrieve specific form field values and append to formData
                let name = document.getElementById('name').value;
                let description = document.getElementById('description').value;
                let location = document.getElementById('location').value;
                let address = document.getElementById('address').value;
                let thumbnail = document.getElementById('thumbnail').files[0];
                let images = document.getElementById('images').files;
                let bathrooms = document.getElementById('bathrooms').value;
                let kitchens = document.getElementById('kitchens').value;
                let rooms = document.getElementById('rooms').value;
                let beds = document.getElementById('beds').value;
                let price = document.getElementById('price').value;
                let capacity = document.getElementById('capacity').value;

                formData.append('name', name);
                formData.append('description', description);
                formData.append('location', location);
                formData.append('address', address);
                formData.append('thumbnail', thumbnail);
                for (let i = 0; i < images.length; i++) {
                    formData.append('images[]', images[i]);
                }
                formData.append('bathrooms', bathrooms);
                formData.append('kitchens', kitchens);
                formData.append('rooms', rooms);
                formData.append('beds', beds);
                formData.append('price', price);
                formData.append('capacity', capacity);
                formData.append('uId', uId);

                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'ajax/add_accommodations.php', true);
                xhr.onload = function() {
                    console.log(this.response);

                    if (this.responseText == 'success') {
                        alert("Success", "Accommodation added successfully!", "success");
                        var modalReference = document.getElementById('addAccommodationModal');
                        var modal = bootstrap.Modal.getInstance(modalReference);
                        modal.hide();

                    } else {
                        // Request failed
                        alert("Attention", "Server error. Please try again later.", "danger");
                    }
                }
                xhr.send(formData);
            });
        });
    </script>

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