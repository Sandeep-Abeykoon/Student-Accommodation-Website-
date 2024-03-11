<?php
include 'essentials.php';
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel : Settings</title>
    <?php include 'links.php'; ?>
</head>

<body class="bg-light">

    <?php include 'header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">SETTINGS</h3>

                <!-- General Settings Section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-settings">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card_text" id="site_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">Site About Us</h6>
                        <p class="card-text" id="site_about"></p>
                    </div>
                </div>

                <!-- General Settings Modal -->
                <div class="modal fade" id="general-settings" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general_settings_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title">General Settings</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Site Title</label>
                                        <input type="text" name="site_title" id="site_title_input" class="form-control shadow-none" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">About us</label>
                                        <textarea name="site_about" id="site_about_input" class="form-control shadow-none" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shutdown Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="update_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown-toggle">
                                </form>

                            </div>
                        </div>
                        <p class="card-text">
                            No member can interact with the website when the shutdown mode is on.
                        </p>
                    </div>
                </div>

                <!-- Contact Us detail Section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Us Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contactUs-settings">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card_text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card_text" id="googleMap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                                    <p class="card_text mb-1">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="phone_number_1"></span>
                                    </p>
                                    <p class="card_text">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="phone_number_2"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                                    <p class="card_text" id="email"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                                    <p class="card_text mb-1">
                                        <i class="bi bi-facebook me-1"></i>
                                        <span id="facebook"></span>
                                    </p>
                                    <p class="card_text mb-1">
                                        <i class="bi bi-instagram me-1"></i>
                                        <span id="instagram"></span>
                                    </p>
                                    <p class="card_text">
                                        <i class="bi bi-twitter me-1"></i>
                                        <span id="twitter"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include 'scripts.php'; ?>

    <script>
        let general_data, contacts_data;

        let general_settings_form = document.getElementById('general_settings_form');
        let site_title_input = document.getElementById('site_title_input');
        let site_about_input = document.getElementById('site_about_input');

        function get_general_data() {
            // Getting the inner text
            let site_title = document.getElementById('site_title');
            let site_about = document.getElementById('site_about');

            let shutdown_toggle = document.getElementById("shutdown-toggle");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                general_data = JSON.parse(this.responseText);

                // Setting the inner text
                site_title.innerText = general_data.site_title;
                site_about.innerText = general_data.site_about;

                site_title_input.value = general_data.site_title;
                site_about_input.value = general_data.site_about

                if (general_data.shutdown == 0) {
                    shutdown_toggle.checked = false;
                    shutdown_toggle.value = 0;
                } else {
                    shutdown_toggle.checked = true;
                    shutdown_toggle.value = 1;
                }
            }

            xhr.send('get_general_data');
        }

        general_settings_form.addEventListener('submit', function(e) {
            e.preventDefault();
            update_general_data(site_title_input.value, site_about_input.value);
        });

        function update_general_data(site_title_value, site_about_value) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {

                var modalReference = document.getElementById('general-settings');
                var modal = bootstrap.Modal.getInstance(modalReference);
                modal.hide();

                if (this.responseText == 1) {
                    alert("Success", "Changes saved", "success")
                    get_general_data();
                } else {
                    alert("Attention", "No Changes saved")
                }
            }

            xhr.send('site_title=' + site_title_value + '&site_about=' + site_about_value + '&update_general_data');
        }

        function update_shutdown(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1 && general_data.shutdown == 0) {
                    alert("Attention", "Site has been shutdown!")
                } else {
                    alert("Attention", "Site is Live!")
                }
                get_general_data();
            }

            xhr.send('update_shutdown=' + val);
        }

        function get_contacts_data() {

            let contacts_id = ['address', 'googleMap', 'phone_number_1', 'phone_number_2', 'email', 'facebook', 'instagram', 'twitter']
            let iframe = document.getElementById('iframe');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                contacts_data = JSON.parse(this.responseText);
                contacts_data = Object.values(contacts_data)

                for (i = 0; i < contacts_id.length; i++) {
                    document.getElementById(contacts_id[i]).innerText = contacts_data[i + 1];
                }
                iframe.src = contacts_data[9];
            }

            xhr.send('get_contacts_data');
        }

        window.onload = function() {
            get_general_data();
            get_contacts_data();
        }
    </script>

</body>

</html>