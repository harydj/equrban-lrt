<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Models\m_user;

class Form_setor extends BaseController
{
    public function index()
    {

        echo view('include/header');
        echo view('include/sidebar');
        echo view('include/navbar');
        // echo view('admin/user');
        echo view('include/footer');
    }
}