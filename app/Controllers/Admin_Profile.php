<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Models\m_user;

class Admin_Profile extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'E-Qurban LRT Jabodebek',
            'active_page' => 'profile',
            'Menu'  => 'Profile',
            'session' => session()
        ] ;

        echo view('include/header',$data);
        echo view('include/sidebar',$data);
        echo view('include/navbar',$data);
        // echo view('admin/user');
        echo view('include/footer',$data);
    }
}