<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : Home</title>
</head>

<body>
    <?php print_r($_SESSION) ?>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>
    <?php include('ajax/accommodations.php'); ?>
</body>

</html>