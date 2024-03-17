<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : About Us</title>
</head>

<body class="bg-light">
    <!-- Header -->
    <?php include './includes/header.php'; ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">About US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3" style="margin-left: 200px; margin-right: 200px">
        NSBM Green University is the first ever green university in South Asia and sets an example for the whole South Asia by paving the way for environmental sustainability. The university is open for both national and international student community and it has turned a new chapter in Sri Lankan higher education.

NSBM Green University is established under the Ministry of Education and it is renowned for its world-class academic offerings. This state-of-the-art university offers nationally and internationally recognized, UGC-approved degree programmes and foreign degree programmes in four faculties: Business, Computing, Engineering, Science, and Postgraduate Studies.
        </p>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Our Vision</h3>
                <p>To be Sri Lanka’s best-performing graduate school and to be recognized internationally. To develop globally competitive and responsible graduates that businesses demand, working in synergy with all our stakeholders and contributing to our society.</p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-1">
                <img src="https://www.maga.lk/wp-content/uploads/2018/03/4-NSBM.jpg" alt="" class="w-100">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box h-100 d-flex flex-column justify-content-between align-items-center">
                    <img src="https://cdn-icons-png.freepik.com/512/3701/3701836.png" alt="" width="70px">
                    <h4 class="mt-3">100+ Available Accomodations</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box h-100 d-flex flex-column justify-content-between align-items-center">
                    <img src="https://st2.depositphotos.com/47577860/46279/v/450/depositphotos_462792098-stock-illustration-accommodation-available-hotel-icon-filled.jpg" alt="" width="70px">
                    <h4 class="mt-3">1000+ Accomodations Provided</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box h-100 d-flex flex-column justify-content-between align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2915/2915324.png" alt="" width="70px">
                    <h4 class="mt-3">100% Guaranteed</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box h-100 d-flex flex-column justify-content-between align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2247/2247881.png" alt="" width="70px">
                    <h4 class="mt-3">100% University Monitoring</h4>
                </div>
            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold h-font text-center">Our Team</h3>

    <div class="container px-4">
        <!-- Swiper -->
        <div class="swiper mySwiper" style="max-width: 500px;">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white text-center overflow-hidden rounded"><img src="data:image/jpeg;base64,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" alt="" style="max-width: 200px; height:auto">
                    <h5 class="mt-2">Chamika</h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded"><img src="data:image/jpeg;base64,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" alt="" style="max-width: 200px; height:auto">
                    <h5 class="mt-2">#Name</h5>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <?php include 'includes/scripts.php'; ?>

</body>

</html>