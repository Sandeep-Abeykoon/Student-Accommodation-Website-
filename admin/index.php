<?php
include 'db_config.php';
include 'essentials.php';

session_start();
if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    redirect("dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Login</title>

    <?php include 'links.php'; ?>

    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">Admin Panel Login</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_username" required type="text" class="form-control shadow-none text-center" placeholder="Admin Username">
                </div>

                <div class="mb-4">
                    <input name="admin_password" required type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>

                <button name="login" type="submit" class="btn text-white btn-dark shadow-none">Login</button>

            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['login'])) {
        $form_data = filteration($_POST);

        $query = "SELECT * FROM `admin_credentials` WHERE `admin_username` =? AND `admin_password` =?";
        $values = [$form_data['admin_username'], $form_data['admin_password']];
        $data_types = "ss";

        $result = select($query, $values, $data_types);
        if ($result->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['adminLogin'] = true;
            $_SESSION['admin_id'] = $row['id_no'];
            redirect('dashboard.php');
        } else {
            alert("Login Failed", "Invalid Credentials!");
        }
    }

    ?>

    <?php include 'scripts.php'; ?>
</body>

</html>