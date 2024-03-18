<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    function alert(title, message, type = "warning") {
        let bs_class = "alert-" + type;
        let element = document.createElement('div');
        element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
            <strong>${title} !</strong> ${message}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;
        document.body.appendChild(element);
    }
</script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 3500
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 3500
        },
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            500: {
                slidesPerView: 2,
            },
        }
    });
</script>

<script>
    document.addEventListener('click', event => {
        const current = event.target;
        const isReadMoreBtn = current.classList.contains('read-more-btn');

        if (!isReadMoreBtn) return;

        const container = current.closest('.card-body');
        const truncatedText = container.querySelector('.truncated-text');
        const fullText = container.querySelector('.full-text');

        if (truncatedText.classList.contains('d-none')) {
            truncatedText.classList.remove('d-none');
            fullText.classList.add('d-none');
            current.textContent = "Show More";
        } else {
            truncatedText.classList.add('d-none');
            fullText.classList.remove('d-none');
            current.textContent = "Show Less";
        }
    });
</script>

<script>
    function setActive() {
        let navbar = document.getElementById("nav-bar");
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    // User Registration
    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('name', register_form.elements['name'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('phone_number', register_form.elements['phone_number'].value);
        data.append('secondary_phone_number', register_form.elements['secondary_phone_number'].value);
        data.append('address', register_form.elements['address'].value);
        data.append('password', register_form.elements['password'].value);
        data.append('confirm_password', register_form.elements['confirm_password'].value);
        data.append('register', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if (this.responseText == 'password_mismatch') {
                alert("Error", "Password Mismatch", "danger");
            } else if (this.responseText == 'already_exits') {
                alert("Error", "User Already Registered", "danger");
            } else if (this.responseText == '1') {
                alert("Success", "User registered successfully", "success");

                var modalReference = document.getElementById('registerModal');
                var modal = bootstrap.Modal.getInstance(modalReference);
                modal.hide();
                register_form.reset();
            } else {
                alert("Error", "Server Error (Registration Failed)", "danger");
            }
        }
        xhr.send(data);
    });

    // User Login
    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('email', login_form.elements['email'].value);
        data.append('password', login_form.elements['password'].value);
        data.append('login', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if (this.responseText == 'user-not-found') {
                alert("Error", "User cannot be found", "danger");
            } else if (this.responseText == 'inactive') {
                alert("Attention", "User is Inactive, Please Contact the Admin");
            } else if (this.responseText == 'invalid-password') {
                alert("Error", "Password is incorrect", "danger");
            } else {
                window.location = window.location.pathname;

                var modalReference = document.getElementById('loginModal');
                var modal = bootstrap.Modal.getInstance(modalReference);
                modal.hide();
            }

        }
        xhr.send(data);
    });


    setActive();
</script>

<script>
    let selectedFiles = [];

    function handleFileSelect(event) {
        const files = event.target.files;
        if (files.length + selectedFiles.length > 5) {
            alert("Attention", "You can only select up to 5 files.");
            event.target.value = ""; // Clear the selected files
            return;
        }
        for (let i = 0; i < files.length; i++) {
            selectedFiles.push(files[i]);

            let container = document.createElement('div');
            container.classList.add('image-preview');

            let img = document.createElement('img');
            img.src = URL.createObjectURL(files[i]);
            img.width = 100;
            img.height = 100;

            let removeBtn = document.createElement('button');
            removeBtn.textContent = 'Remove';
            removeBtn.addEventListener('click', function() {

                let index = selectedFiles.indexOf(files[i]);
                if (index !== -1) {
                    selectedFiles.splice(index, 1);
                }
                container.remove();
            });

            container.appendChild(img);
            container.appendChild(removeBtn);


            let previewContainer = document.getElementById('image-preview');
            previewContainer.appendChild(container);
        }
    }


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
            let lon = document.getElementById('lon').value;
            let lat = document.getElementById('lat').value;
            let address = document.getElementById('address').value;
            let thumbnail = document.getElementById('thumbnail').files[0];
            for (let i = 0; i < selectedFiles.length; i++) {
                formData.append('images[]', selectedFiles[i]);
            }
            let bathrooms = document.getElementById('bathrooms').value;
            let kitchens = document.getElementById('kitchens').value;
            let rooms = document.getElementById('rooms').value;
            let beds = document.getElementById('beds').value;
            let price = document.getElementById('price').value;
            let capacity = document.getElementById('capacity').value;

            formData.append('name', name);
            formData.append('description', description);
            formData.append('lon', lon);
            formData.append('lat', lat);
            formData.append('address', address);
            formData.append('thumbnail', thumbnail);
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

<script>
    document.querySelectorAll('.view-more-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var card = button.closest('.card');
            var id_no = card.dataset.id_no;
            var name = card.dataset.name;
            var description = card.dataset.description;
            var thumbnailPath = card.dataset.thumbnail;
            var lon = card.dataset.lon;
            var lat = card.dataset.lat;
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

    function delete_accommodation() {
        var card = document.querySelector('.card');
        var id_no = card.dataset.id_no;
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/delete_accommodation.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            console.log(this.response);

            if (this.responseText == 1) {
                alert("Success", "Accommodation deleted", "success");
                location.reload();
            } else {
                alert("Attention", "Failed to delete accommodation");
            }
        }

        xhr.send('id_no=' + id_no + '&action=delete');
    }
</script>