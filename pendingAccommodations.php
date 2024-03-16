<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : Pending Accommodations</title>
</head>

<!-- Header -->
<?php include 'includes/header.php'; ?>
<?php include('ajax/get_pending_accommodations.php'); ?>

<body class="bg-light">
    <div class="container my-5">
        <h2 class="fw-bold h-font text-center">Pending Accommodations</h2>

        <?php
        $pendingAccommodations = getPendingAccommodations();
        ?>
        <!-- List of Pending Accommodations -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            foreach ($pendingAccommodations as $accommodation) {
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
                        <button type="button" class="btn btn-danger" id="declineButton">Decline</button>
                        <button type="button" onclick="accept_accommodation()" class="btn btn-success" id="acceptButton">Accept</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('.view-more-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var card = button.closest('.card');
                    var id_no = card.dataset.id_no;
                    var name = card.dataset.name;
                    var description = card.dataset.description;
                    var thumbnailPath = card.dataset.thumbnail;
                    var location = card.dataset.location;
                    var address = card.dataset.address;
                    var bathrooms = card.dataset.bathrooms;
                    var kitchens = card.dataset.kitchens;
                    var rooms = card.dataset.rooms;
                    var beds = card.dataset.beds;
                    var price = card.dataset.price;
                    var capacity = card.dataset.capacity;

                    var images = [];
                    var index = 0;
                    while (card.dataset['image-' + index]) {
                        images.push(card.dataset['image-' + index]);
                        index++;
                    }

                    var modalTitle = document.getElementById('accommodationModalLabel');
                    var modalDescription = document.getElementById('accommodationDescription');
                    var modalLocation = document.getElementById('accommodationLocation');
                    var modalAddress = document.getElementById('accommodationAddress');
                    var modalBathrooms = document.getElementById('accommodationBathrooms');
                    var modalKitchens = document.getElementById('accommodationKitchens');
                    var modalRooms = document.getElementById('accommodationRooms');
                    var modalBeds = document.getElementById('accommodationBeds');
                    var modalPrice = document.getElementById('accommodationPrice');
                    var modalCapacity = document.getElementById('accommodationCapacity');
                    var modalCarousel = document.querySelector('#accommodationCarousel .carousel-inner');

                    modalTitle.textContent = name;
                    modalDescription.textContent = description;
                    modalLocation.href = location;
                    modalLocation.textContent = 'View Location';
                    modalAddress.textContent = address;
                    modalBathrooms.textContent = bathrooms;
                    modalKitchens.textContent = kitchens;
                    modalRooms.textContent = rooms;
                    modalBeds.textContent = beds;
                    modalPrice.textContent = price;
                    modalCapacity.textContent = capacity;

                    modalCarousel.innerHTML = '';
                    images.forEach(function(image, index) {
                        var activeClass = index === 0 ? 'active' : '';
                        var carouselItem = document.createElement('div');
                        carouselItem.className = 'carousel-item ' + activeClass;
                        carouselItem.innerHTML = '<img src="ajax/uploads/' + image + '" class="d-block w-100" alt="Accommodation Image">';
                        modalCarousel.appendChild(carouselItem);
                    });

                    var modal = new bootstrap.Modal(document.getElementById('accommodationDetailsModal'));
                    modal.show();
                });
            });


            // AJAX for Decline
            document.getElementById('declineButton').addEventListener('click', function() {
                var reason = prompt("Enter the reason for declining:");
                if (reason !== null) {
                    var formData = new FormData();
                    formData.append('accommodation_id', id_no);
                    formData.append('reason', reason);

                    fetch('ajax/accommodation_status.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload(); // Reload the page after declining
                            } else {
                                alert('Failed to decline accommodation.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Failed to decline accommodation.');
                        });
                }
            });

            function accept_accommodation() {
                var card = document.querySelector('.card');
                var id_no = card.dataset.id_no;
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/a.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    console.log(this.response);

                    if (this.responseText == 1) {
                        alert("Success", "Accommodation accepted", "success");
                        location.reload(); // Reload the page after accepting
                    } else {
                        alert("Attention", "Failed to accept accommodation");
                    }
                }

                xhr.send('id_no=' + id_no + '&action=accept');
            }
        </script>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/scripts.php'; ?>

</body>

</html>