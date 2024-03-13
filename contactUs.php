<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : Contact Us</title>
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

    <?php
    $contact_query = "SELECT * FROM `contact_details` WHERE `id_no`=?";
    $values = [1];
    $contacts_result = mysqli_fetch_assoc(select($contact_query, $values, 'i'));
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe height="320px" class="w-100 rounded mb-4" src="<?php echo $contacts_result['iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contacts_result['googleMap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-geo-alt-fill"></i> <?php echo $contacts_result['address'] ?></a>

                    <h5 class="mt-4">Call Us</h5>
                    <a href="tel: +<?php echo $contacts_result['phone_number_1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +<?php echo $contacts_result['phone_number_1'] ?></a><br>
                    <?php
                    if ($contacts_result['phone_number_2'] != '') {
                        echo <<<data
                        <a href="tel: +$contacts_result[phone_number_2]" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +$contacts_result[phone_number_2]</a>
                        data;
                    }
                    ?>
                    <h5 class="mt-4"><i class="bi bi-envelope-at-fill"></i> Email</h5>
                    <a href="mailto: <?php echo $contacts_result['email'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><?php echo $contacts_result['email'] ?></a>

                    <h5 class="mt-4">Follow Us</h5>
                    <?php
                    if ($contacts_result['twitter'] != '') {
                        echo <<<data
                        <a target="_blank" href="$contacts_result[twitter]" class="d-inline-block text-dark fs-5 me-2"> <i class="bi bi-twitter me-1"></i></a>
                        data;
                    }

                    if ($contacts_result['facebook'] != '') {
                        echo <<<data
                        <a target="_blank" href="$contacts_result[facebook]" class="d-inline-block text-dark fs-5 me-2"> <i class="bi bi-facebook me-1"></i></a>
                        data;
                    }

                    if ($contacts_result['instagram'] != '') {
                        echo <<<data
                        <a target="_blank" href="$contacts_result[instagram]" class="d-inline-block text-dark fs-5"> <i class="bi bi-instagram me-1"></i></a>
                        data;
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form method="get" action="mailto:recipient@example.com">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input type="text" name="name" class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input type="email" name="email" class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input type="text" name="subject" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-12 p-0 mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="body" class="form-control shadow-none" rows="5" style="resize: none;" required></textarea>
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

    <?php include 'includes/scripts.php'; ?>

</body>

</html>