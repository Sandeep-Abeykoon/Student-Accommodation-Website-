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
            let lon = document.getElementById('lon').value;
            let lat = document.getElementById('lat').value;
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
            formData.append('lon', lon);
            formData.append('lat', lat);
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