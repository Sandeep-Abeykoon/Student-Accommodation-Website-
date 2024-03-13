<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
        slidesPerView: 1,
        spaceBetween: 40,
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
            1000: {
                slidesPerView: 3,
            },
            1400: {
                slidesPerView: 4,
            },
        }
    });
</script>

<script>
    const parentContainer = document.querySelector('.read-more-container');

    parentContainer.addEventListener('click', event => {
        const current = event.target;
        const isReadMoreBtn = current.className.includes('read-more-btn');

        if (!isReadMoreBtn) return;

        const currentText = event.target.parentNode.querySelector('.read-more-text');

        currentText.classList.toggle('d-none');
        currentText.classList.toggle('read-more-text--show');

        current.textContent = currentText.classList.contains('read-more-text--show') ? "Read Less..." : "Read More...";
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

    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('name', register_form.elements['name'].value);
        data.append('email', register_form.elements['name'].value);
        data.append('phone_number_1', register_form.elements['name'].value);
        data.append('phone_number_2', register_form.elements['name'].value);
        data.append('address', register_form.elements['name'].value);
        data.append('password', register_form.elements['name'].value);
        data.append('confirm_password', register_form.elements['name'].value);
        data.append('register', '');

        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
    });

    setActive();
</script>