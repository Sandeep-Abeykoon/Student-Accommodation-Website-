<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'includes/links.php'; ?>
  <title><?php echo $settings_result['site_title'] ?> : Home</title>
</head>

<body class="bg-light">

  <!-- Header -->
  <?php include 'includes/header.php'; ?>


  <div class="container-fluid px-lg-4 mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <!-- Swiper -->
        <div class="swiper swiper-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="https://www.pottersholidays.com/static/9f60595971440199e7da18095d490bf6/57f28/accommodation-header-update.jpg" style="max-height: 400px; width:100%" />
            </div>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
        <!-- End Swiper -->
      </div>
    </div>
  </div>



  <!-- Articles Section -->
  <?php
  $articles_query = "SELECT * FROM `articles`";
  $articles_result = select($articles_query);

  // Check if there are any articles
  if (mysqli_num_rows($articles_result) > 0) {
  ?>
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Articles</h2>
    <div class="container read-more-container">
      <div class="row gap-3">
        <?php
        while ($article = mysqli_fetch_assoc($articles_result)) {
          $content = $article['article_content'];
          // Truncate the content to 100 characters
          $truncated_content = strlen($content) > 100 ? substr($content, 0, 100) . '...' : $content;
        ?>
          <div class="col-md-12">
            <div class="card mb-1">
              <div class="card-body">
                <h5 class="card-title"><strong><?php echo $article['article_title']; ?></strong></h5>
                <p class="card-text truncated-text">
                  <?php echo $truncated_content; ?>
                </p>
                <?php if ($truncated_content !== $content) { ?>
                  <p class="card-text full-text d-none">
                    <?php echo $content; ?>
                  </p>
                  <button class="read-more-btn btn btn-primary">Show More</button>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  <?php
  } // End if there are articles
  ?>

  <!-- Reach Us -->
  <?php
  $contact_query = "SELECT * FROM `contact_details` WHERE `id_no`=?";
  $values = [1];
  $contacts_result = mysqli_fetch_assoc(select($contact_query, $values, 'i'));
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