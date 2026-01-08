<?php

namespace controllers;

class LastAction
{

    public function getWaiting()
    {
        if (!isset($_SESSION['last_action'])) {
            echo 0;
        } else {
            echo time() - $_SESSION['last_action'];
        }
    }



}