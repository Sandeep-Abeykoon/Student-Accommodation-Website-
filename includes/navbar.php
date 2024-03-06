<nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">NSBM</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active me-2" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="#">Accomodations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="#">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="#">About Us</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Settings
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-flex" role="search">
                <button type="button" class="btn btn-outline-dark shadow-none me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button type="button" class="btn btn-outline-dark shadow-none me-2" data-bs-toggle="modal" data-bs-target="#confirmationModal">Register</button>

            </div>
        </div>
    </div>
</nav>

<!-- Confirmation dialog modal -->
<div class="modal" tabindex="-1" role="dialog" id="confirmationModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you a landlord?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">Yes</button>
      </div>
    </div>
  </div>
</div>

<script>
    function confirmRegistration() {
        if (confirm("Are you a landlord?")) {
            $('#registerModal').modal('show');
        } else {
            // Show a message indicating that student and warden accounts will be created by the university IT department
            alert("Student and warden accounts will be created by the university IT department.");
        }
    }
</script>