<?php

function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        redirect("index.php");
    }
    session_regenerate_id(true);
}

function redirect($url)
{
    echo ("<script>window.location.href='$url';</script>");
}

function alert($title, $message, $type = "")
{
    $bs_class = ($type == "sucess") ? "alert-sucess" : "alert-danger";

    echo <<<alert
    <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
        <strong>$title !</strong> $message.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    alert;
}
