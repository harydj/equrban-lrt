<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_user;

class User extends BaseController
{
    public function index()
    {
        $model = new m_user();
        $query = $model->getUser();

        $data = [
            'title' => 'E-Qurban LRT Jabodebek',
            'session' => session(),
            'user' => $query->getResult()
        ];


        echo view('include/header', $data);
        echo view('include/sidebar', $data);
        echo view('include/navbar', $data);
        echo view('admin/user', $data);
        echo view('include/footer');
    }

    public function show($id)
    {
        // Logic to display a specific user by ID
    }

    public function create()
    {
        // Logic to show the user creation form
    }

    public function store()
    {
        // Logic to store a new user in the database
    }

    public function edit($id)
    {
        // Logic to show the user edit form
    }

    public function update($id)
    {
        // Logic to update a user in the database
    }

    public function destroy($id)
    {
        // Logic to delete a user from the database
    }
}