<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NSBM Accomodation</title>

  <?php include 'includes/links.php'; ?>
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


  <!-- Articles Section -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Articles</h2>
  <div class="container read-more-container">
    <div class="row">

      <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-body">
            <p class="card-text">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde, facere? Quae distinctio reprehenderit soluta fugiat, alias, doloremque similique tenetur magni voluptate a, perspiciatis quaerat! Necessitatibus velit consectetur expedita consequatur assumenda!
              <span class="read-more-text d-none">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio quasi quaerat, amet explicabo magnam, nulla porro dolorem itaque
              </span>
            </p>
            <button class="read-more-btn btn btn btn-primary">Read More...</button>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <p class="card-text">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde, facere? Quae distinctio reprehenderit soluta fugiat, alias, doloremque similique tenetur magni voluptate a, perspiciatis quaerat! Necessitatibus velit consectetur expedita consequatur assumenda!
              <span class="read-more-text d-none">
                fafdsdsfdsffsdf
              </span>
            </p>
            <button class="read-more-btn btn btn btn-primary">Read More...</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Reach Us -->
  <?php
  $contact_query = "SELECT * FROM `contact_details` WHERE `id_no`=?";
  $values = [1];
  $contacts_result = mysqli_fetch_assoc(select($contact_query, $values, 'i'));
  print_r($contacts_result);
  ?>

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Reach Us</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
        <iframe height="320px" class="w-100 rounded" src="<?php echo $contacts_result['iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 rounded mb-4 d-flex flex-column justify-content-center align-items-center">
          <h5>Call Us</h5>
          <a href="tel: +<?php echo $contacts_result['phone_number_1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +<?php echo $contacts_result['phone_number_1'] ?></a>
          <?php
          if ($contacts_result['phone_number_2'] != '') {
            echo <<<data
            <a href="tel: +$contacts_result[phone_number_2]" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +$contacts_result[phone_number_2]</a>
            data;
          }
          ?>
        </div>

        <div class="bg-white p-4 rounded mb-4 d-flex flex-column justify-content-center align-items-center">
          <h5>Follow Us</h5>

          <?php
          if ($contacts_result['twitter'] != '') {
            echo <<<data
            <a target="_blank" href="$contacts_result[twitter]" class="d-inline-block mb-3"><span class="badge bg-light text-dark fs-6 p-2"> <i class="bi bi-twitter me-1"></i>Twitter</span></a>
            data;
          }

          if ($contacts_result['facebook'] != '') {
            echo <<<data
              <a target="_blank" href="$contacts_result[facebook]" class="d-inline-block mb-3"><span class="badge bg-light text-dark fs-6 p-2"> <i class="bi bi-facebook me-1"></i>Facebook</span></a>
              data;
          }

          if ($contacts_result['instagram'] != '') {
            echo <<<data
              <a target="_blank" href="$contacts_result[instagram]" class="d-inline-block mb-3"><span class="badge bg-light text-dark fs-6 p-2"> <i class="bi bi-instagram me-1"></i>Instagram</span></a>
              data;
          }
          ?>

        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

  <?php include 'includes/scripts.php'; ?>
</body>

</html>