<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ClientController extends BaseController {
    public function index() {
        return view("clients/client.html");
    }
}

?>