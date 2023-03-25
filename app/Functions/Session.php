<?php

class Session extends Controller
{
    public function check()
    {
        if (isset($_SESSION['login_sale'])) {
            if ($_SESSION['login_sale'] == False) {
                $this->logout();
            } else {
                $this->userData = $_SESSION['user_data'];
            }
        } else {
            header("location: " . $this->BASE_URL . "Login");
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . $this->BASE_URL . "Login");
    }
}
