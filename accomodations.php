<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : Accommodations</title>
    <style>
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

    <?php
    $accommodations = getAccommodations()
    ?>

    <!-- List of Accommodations -->
    <div class="container">
        <div class="row mb-5 bg-white rounded shadow p-4 mb-5" id="cardContainer">
            <div class="col-12 col-md-5 col-lg-4 col-xl-3 mb-3" style="overflow-y: auto; height: 400px;">
                <?php
                foreach ($accommodations as $accommodation) {
                    $thumbnailPath = 'ajax/uploads/' . $accommodation['thumbnail'];
                    echo '
    <div class="col">
        <div class="card h-100 d-flex flex-column justify-content-center align-items-center"
            data-name="' . $accommodation['name'] . '"
            data-description="' . $accommodation['description'] . '"
            data-thumbnail="' . $thumbnailPath . '"
            data-location="' . $accommodation['location'] . '"
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
            <div class="card-footer">
                <a href="#" class="btn btn-primary mt-1 view-more-btn">View Details</a>
            </div>
        </div>
    </div>';
                }
                ?>
            </div>
            <div class="col-12 col-md-7 col-lg-8 col-xl-9 d-flex flex-column justify-content-center align-items-center">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>


    <!-- Accommodation Details Modal -->
    <div class="modal fade" id="accommodationModal" tabindex="-1" aria-labelledby="accommodationModalLabel" aria-hidden="true">
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
                    <p><strong>Location:</strong> <a id="accommodationLocation" target="_blank"></a></p>
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
                    <button type="button" onclick="decline_accommodation()" class="btn btn-danger" id="declineButton">Decline</button>
                    <button type="button" onclick="accept_accommodation()" class="btn btn-success" id="acceptButton">Accept</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9C3ZQP5xjNW21JgyEmpfXX5nCRASZ4XI&callback=initMap"></script>

    <script>
        function fetchCardData() {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'ajax/get_accommodations.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const data = JSON.parse(xhr.responseText);
                        if (Array.isArray(data)) {
                            resolve(data);
                        } else {
                            reject('Data is not an array');
                        }
                    } else {
                        reject('Failed to fetch card data');
                    }
                };
                xhr.onerror = function() {
                    reject('Failed to fetch card data');
                };
                xhr.send();
            });
        }

        function createCard(name, description, thumbnail, location, address, bathrooms, kitchens, rooms, beds, price, capacity, id_no) {
            const card = document.createElement('div');
            card.className = 'card mb-3 shadow-sm';
            card.style.maxWidth = '540px';
            card.style.cursor = 'pointer';
            card.setAttribute('data-name', name);
            card.setAttribute('data-description', description);
            card.setAttribute('data-thumbnail', thumbnail);
            card.setAttribute('data-location', location);
            card.setAttribute('data-address', address);
            card.setAttribute('data-bathrooms', bathrooms);
            card.setAttribute('data-kitchens', kitchens);
            card.setAttribute('data-rooms', rooms);
            card.setAttribute('data-beds', beds);
            card.setAttribute('data-price', price);
            card.setAttribute('data-capacity', capacity);
            card.setAttribute('data-id_no', id_no);

            card.innerHTML = `
        <div class="row g-0">
            <div class="col-7 click-card">
                <div class="card-body">
                    <h5 class="card-title">${name}</h5>
                    <p class="card-text">${description}</p>
                </div>
            </div>
            <div class="col-5">
                <img src="ajax/uploads/${thumbnail}" class="d-block w-100" alt="...">
            </div>
        </div>
    `;

            return card;
        }

        async function renderCards() {
            const cardContainer = document.getElementById('cardContainer');
            const cardWrapper = cardContainer.querySelector('.col-12');
            try {
                const cardData = await fetchCardData();
                console.log(cardData);
                cardData.forEach(({
                    name,
                    description,
                    thumbnail,
                    location,
                    address,
                    bathrooms,
                    kitchens,
                    rooms,
                    beds,
                    price,
                    capacity,
                    id_no,
                    images
                }) => {
                    const card = createCard(name, description, thumbnail, location, address, bathrooms, kitchens, rooms, beds, price, capacity, id_no, images);
                    cardWrapper.appendChild(card);
                });
            } catch (error) {
                console.error(error);
            }
        }

        renderCards();
    </script>
</body>

</html>