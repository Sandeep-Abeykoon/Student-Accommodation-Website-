<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Login</title>

    <?php include 'links.php'; ?>
    <?php include 'styles.php'; ?>

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
        <form>
            <h4 class="bg-dark text-white py-3">Admin Panel Login</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_username" type="text" class="form-control shadow-none text-center" placeholder="Admin Username">
                </div>

                <div class="mb-4">
                    <input name="admin_password" type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>

                <button name="login" type="submit" class="btn text-white btn-dark shadow-none">Login</button>

            </div>
        </form>
    </div>
    <?php include 'scripts.php'; ?>
</body>

</html>