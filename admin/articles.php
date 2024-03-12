<?php
include 'essentials.php';
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel : Articles</title>
    <?php include 'links.php'; ?>
</head>

<body class="bg-light">
    <?php include 'header.php'; ?>


    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Article Management</h3>

                <!-- Articles Section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Articles</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#articleModal">
                                <i class="bi bi-plus"></i>
                                Add New Article
                            </button>
                        </div>
                        <div id="articles_list">
                            <!-- Dummy articles -->
                            <div class="article card border-0 shadow mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Article 1</h5>
                                    <p class="card-text">Content for article 1</p>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary btn-sm edit_button" data-bs-toggle="modal" data-bs-target="#articleModal">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm delete_button">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <div class="article card border-0 shadow mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Article 2</h5>
                                    <p class="card-text">Content for article 2</p>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary btn-sm edit_button" data-bs-toggle="modal" data-bs-target="#articleModal">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm delete_button">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Article Modal -->
                <div class="modal fade" id="articleModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="article_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add/Edit Article</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="article_id">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Title</label>
                                        <input type="text" id="article_title_input" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Content</label>
                                        <textarea id="article_content_input" class="form-control shadow-none" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'scripts.php'; ?>

</body>

</html>