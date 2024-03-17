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

        .carousel-item img {
            max-width: 300px;
            margin: 0 auto;
        }

        .carousel {
            margin: 0 auto;
        }

        #image-preview {
            margin-top: 10px;
        }

        .image-preview {
            position: relative;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .image-preview button {
            position: absolute;
            top: 0;
            right: 0;
            padding: 2px 6px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 0 0 0 5px;
            cursor: pointer;
        }
    </style>
</head>

<!-- Header -->
<?php include 'includes/header.php'; ?>
<?php include('ajax/get_accommodations.php'); ?>

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
                            <label for="lon" class="form-label">Location Longitude</label>
                            <input type="text" class="form-control" id="lon" required>
                        </div>
                        <div class="mb-3">
                            <label for="lat" class="form-label">Location Latitude</label>
                            <input type="text" class="form-control" id="lat" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail Image</label>
                            <input type="file" class="form-control" id="thumbnail" accept="image/*" onchange="handleThumbnailSelect(event)" required>
                            <div id="thumbnail-preview"></div>
                            <button type="button" class="btn btn-danger mt-2" id="remove-thumbnail" disabled>Remove Thumbnail</button>
                        </div>
                        <div id="image-preview-thumbnail" class="d-flex flex-wrap"></div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Images (up to 5 files)</label>
                            <input type="file" class="form-control" id="images" accept="image/*" onchange="handleFileSelect(event)" required>
                        </div>
                        <div id="image-preview" class="d-flex flex-wrap"></div>

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

    <?php
    $accommodations = getAccommodations()
    ?>

    <!-- List of Accommodations -->
    <div class="container">
        <div class="row mb-5 bg-white rounded shadow p-4 mb-5" id="cardContainer">
            <div class="col-12 col-md-5 col-lg-4 col-xl-3 mb-3" style="overflow-y: auto; height: 400px;">
                <?php
                if (empty($accommodations)) {
                    echo '<div style="height: 50vh; display: flex; justify-content:center; align-items:center" class="text-center"><span>No accommodations at the moment.</span></div>';
                } else {
                    foreach ($accommodations as $accommodation) {
                        $thumbnailPath = 'ajax/uploads/' . $accommodation['thumbnail'];
                        echo '
    <div class="col">
        <div class="card h-100 d-flex flex-column justify-content-center align-items-center" style="cursor:pointer"
            data-name="' . $accommodation['name'] . '"
            data-description="' . $accommodation['description'] . '"
            data-thumbnail="' . $thumbnailPath . '"
            data-lon="' . $accommodation['lon'] . '"
            data-lat="' . $accommodation['lat'] . '"
            data-address="' . $accommodation['address'] . '"
            data-bathrooms="' . $accommodation['bathrooms'] . '"
            data-kitchens="' . $accommodation['kitchens'] . '"
            data-rooms="' . $accommodation['rooms'] . '"
            data-beds="' . $accommodation['beds'] . '"
            data-price="' . $accommodation['price'] . '"
            data-capacity="' . $accommodation['capacity'] . '"
            data-id_no="' . $accommodation['id_no'] . '"
            ';

                        // Add data attributes for each image URL
                        foreach ($accommodation['images'] as $index => $image) {
                            echo 'data-image-' . $index . '="' . $image . '" ';
                        }

                        echo '>
            <img src="' . $thumbnailPath . '" class="img-thumbnail mt-3" alt="Accommodation Thumbnail" style="width: 250px;">
            <div class="card-body text-center">
                <h5 class="card-title">' . $accommodation['name'] . '</h5>
                <p class="card-text">' . $accommodation['description'] . '</p>
            </div>
        </div>
    </div>';
                    }
                }
                ?>
            </div>
            <div class="col-12 col-md-7 col-lg-8 col-xl-9 d-flex flex-column justify-content-center align-items-center">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>


    <!-- Accommodation Details Modal -->
    <div class="modal fade" id="accommodationDetailsModal" tabindex="-1" aria-labelledby="accommodationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accommodationModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="accommodationCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Carousel items will be dynamically added here -->
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#accommodationCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#accommodationCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <p id="accommodationDescription"></p>
                    <!-- Add other details here -->
                    <p><strong>Address:</strong> <span id="accommodationAddress"></span></p>
                    <p><strong>Bathrooms:</strong> <span id="accommodationBathrooms"></span></p>
                    <p><strong>Kitchens:</strong> <span id="accommodationKitchens"></span></p>
                    <p><strong>Rooms:</strong> <span id="accommodationRooms"></span></p>
                    <p><strong>Beds:</strong> <span id="accommodationBeds"></span></p>
                    <p><strong>Price:</strong> <span id="accommodationPrice"></span></p>
                    <p><strong>Capacity:</strong> <span id="accommodationCapacity"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="" class="btn btn-success" id="acceptButton">Book</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <script>
        function handleThumbnailSelect(event) {
            thumbnailFile = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const thumbnailPreview = document.getElementById('thumbnail-preview');
                thumbnailPreview.innerHTML = ''; // Clear previous preview

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'mt-3');
                img.style.width = '250px';

                thumbnailPreview.appendChild(img);

                // Enable the "Remove Thumbnail" button
                document.getElementById('remove-thumbnail').removeAttribute('disabled');
            };

            reader.readAsDataURL(thumbnailFile);
        }

        document.getElementById('remove-thumbnail').addEventListener('click', function() {
            const thumbnailPreview = document.getElementById('thumbnail-preview');
            thumbnailPreview.innerHTML = ''; // Clear the preview
            thumbnailFile = null; // Reset the selected file
            document.getElementById('remove-thumbnail').setAttribute('disabled', 'disabled');
            document.getElementById('thumbnail').value = ''; // Clear the input value
        });
    </script>

    <script>
        let selectedFiles = [];

        function handleFileSelect(event) {
            const files = event.target.files;
            if (files.length + selectedFiles.length > 5) {
                alert("You can only select up to 5 files.");
                event.target.value = ""; // Clear the selected files
                return;
            }
            for (let i = 0; i < files.length; i++) {
                selectedFiles.push(files[i]);
            }
            console.log("Selected Files:", selectedFiles);
        }
    </script>

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9C3ZQP5xjNW21JgyEmpfXX5nCRASZ4XI&loading=async&callback=initMap">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            const modalTitle = document.getElementById('accommodationModalLabel');
            const modalDescription = document.getElementById('accommodationDescription');
            const modalAddress = document.getElementById('accommodationAddress');
            const modalBathrooms = document.getElementById('accommodationBathrooms');
            const modalKitchens = document.getElementById('accommodationKitchens');
            const modalRooms = document.getElementById('accommodationRooms');
            const modalBeds = document.getElementById('accommodationBeds');
            const modalPrice = document.getElementById('accommodationPrice');
            const modalCapacity = document.getElementById('accommodationCapacity');
            const modalCarouselInner = document.querySelector('#accommodationCarousel .carousel-inner');

            cards.forEach(card => {
                card.addEventListener('click', function() {
                    modalTitle.textContent = card.dataset.name;
                    modalDescription.textContent = card.dataset.description;
                    modalAddress.textContent = card.dataset.address;
                    modalBathrooms.textContent = card.dataset.bathrooms;
                    modalKitchens.textContent = card.dataset.kitchens;
                    modalRooms.textContent = card.dataset.rooms;
                    modalBeds.textContent = card.dataset.beds;
                    modalPrice.textContent = card.dataset.price;
                    modalCapacity.textContent = card.dataset.capacity;

                    // Clear previous carousel items
                    modalCarouselInner.innerHTML = '';

                    // Add images to the carousel
                    for (let i = 0; i < 5; i++) {
                        if (card.dataset['image-' + i]) {
                            const carouselItem = document.createElement('div');
                            carouselItem.classList.add('carousel-item');
                            if (i === 0) {
                                carouselItem.classList.add('active');
                            }
                            const image = document.createElement('img');
                            image.src = 'ajax/uploads/' + card.dataset['image-' + i];
                            image.classList.add('d-block', 'w-100');
                            carouselItem.appendChild(image);
                            modalCarouselInner.appendChild(carouselItem);
                        }
                    }

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById('accommodationDetailsModal'));
                    modal.show();
                });
            });
        });
    </script>


    <script>
        function initMap() {
            const locations = [{
                    name: 'Location 1',
                    lat: 40.7128,
                    lng: -74.006
                },
                {
                    name: 'Location 2',
                    lat: 34.0522,
                    lng: -118.2437
                },
                {
                    name: 'Location 3',
                    lat: 41.8781,
                    lng: -87.6298
                },
                // Add more locations as needed
            ];
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8,
            });

            // Add markers to the map
            locations.forEach(location => {
                const lat = parseFloat(location.lat);
                const lng = parseFloat(location.lon);

                new google.maps.Marker({
                    position: {
                        lat: lat,
                        lng: lng
                    },
                    map: map,
                    title: location.name
                });
            });
        }
    </script>

    <script>
        const locations = [];
        document.querySelectorAll('.card').forEach(function(button) {
            var card = button.closest('.card');
            var lat = parseFloat(card.dataset.lat);
            var lon = parseFloat(card.dataset.lon);
            var name = card.dataset.name;

            locations.push({
                name: name,
                lat: lat,
                lon: lon
            });
        });
        console.log(locations);

        initMap(locations);
    </script>

</body>

</html>