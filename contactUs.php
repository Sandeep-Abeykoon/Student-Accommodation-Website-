<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <?php include './includes/links.php'; ?>
    <?php include 'includes/styles.php'; ?>
</head>

<body class="bg-light">
    <?php include './includes/header.php'; ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Contact US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam nesciunt vitae enim minima <br> non provident sapiente obcaecati explicabo rerum neque. Quos dolorem
        </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe height="320px" class="w-100 rounded mb-4" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15846.303361252902!2d80.0415729!3d6.8213291!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2523b05555555%3A0x546c34cd99f6f488!2sNSBM%20Green%20University!5e0!3m2!1sen!2slk!4v1709637123008!5m2!1sen!2slk" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <h5>Address</h5>
                    <a href="https://maps.app.goo.gl/BydHW6vmxPG7zmFZA" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-geo-alt-fill"></i> Pitipana - Thalagala Rd, Homagama</a>

                    <h5 class="mt-4">Call Us</h5>
                    <a href="tel:+94115445000" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +94 115445000</a><br>
                    <a href="tel:+94115445000" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +94 115445000</a>
                    <h5 class="mt-4"><i class="bi bi-envelope-at-fill"></i> Email</h5>
                    <a href="mailto: nsbmaccomodation@gmail.com" class="d-inline-block mb-2 text-decoration-none text-dark">nsbmaccomodation@gmail.com</a>

                    <h5 class="mt-4">Follow Us</h5>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2"> <i class="bi bi-twitter me-1"></i></a>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2"> <i class="bi bi-facebook me-1"></i></a>
                    <a href="#" class="d-inline-block text-dark fs-5"> <i class="bi bi-instagram me-1"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form action="">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="col-md-12 p-0 mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn text-white btn-dark mt-3 shadow-none">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>