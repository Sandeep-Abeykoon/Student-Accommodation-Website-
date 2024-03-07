<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NSBM Accomodation</title>

  <?php include 'includes/links.php'; ?>
  <?php include 'includes/styles.php'; ?>
</head>

<body class="bg-light">

  <!-- Header -->
  <?php include 'includes/header.php'; ?>

  <!-- Swiper -->
  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="./images/sliderImage.jpg" class="w-100 d-block" />
        </div>
        <div class="swiper-slide">
          <img src="./images/sliderImage.jpg" class="w-100 d-block" />
        </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </div>

  <!-- Reach Us -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Reach Us</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
        <iframe height="320px" class="w-100 rounded" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15846.303361252902!2d80.0415729!3d6.8213291!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2523b05555555%3A0x546c34cd99f6f488!2sNSBM%20Green%20University!5e0!3m2!1sen!2slk!4v1709637123008!5m2!1sen!2slk" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 rounded mb-4 d-flex flex-column justify-content-center align-items-center">
          <h5>Call Us</h5>
          <a href="tel:+94115445000" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +94 115445000</a>
          <a href="tel:+94115445000" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +94 115445000</a>
        </div>

        <div class="bg-white p-4 rounded mb-4 d-flex flex-column justify-content-center align-items-center">
          <h5>Follow Us</h5>
          <a href="#" class="d-inline-block mb-3"><span class="badge bg-light text-dark fs-6 p-2"> <i class="bi bi-twitter me-1"></i>Twitter</span></a>
          <a href="#" class="d-inline-block mb-3"><span class="badge bg-light text-dark fs-6 p-2"> <i class="bi bi-facebook me-1"></i>Facebook</span></a>
          <a href="#" class="d-inline-block"><span class="badge bg-light text-dark fs-6 p-2"> <i class="bi bi-instagram me-1"></i>Instagram</span></a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/scripts.php'; ?>

</body>

</html>