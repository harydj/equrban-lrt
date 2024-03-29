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

    public function add_user()
    {         
            $model = new m_user();
            $nama = $this->request->getVar('nama');
            $password = $this->request->getVar('password');
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $data = [
                'nipp'        => $this->request->getVar('nipp'),
                'nama'        => $nama,
                'email'       => $this->request->getVar('email'),
                'password'    => $hash,
                'id_role'     => $this->request->getVar('role_user')
            ];

            $hasil = $model->insert($data);
            if ($hasil) {
                $successMessage = 'User '.$nama.' telah ditambahkan';
                $session = session();
                $session->setFlashdata('success', $successMessage);
                return redirect()->to(base_url('admin/user'));
            } else {
                $failedMessage = 'Gagal menambahkan user';
                $session = session();
                $session->setFlashdata('failed', $failedMessage);
                return redirect()->to(base_url('admin/user'));
            }
    }

    public function edit_user()
    {
        $model = new m_user();

        $nipp = $this->request->getVar('nipp');

        $nama = $this->request->getVar('nama');
            $data = [
                'nama'        => $nama,
                'nipp'        => $this->request->getVar('nipp'),
                'email'       => $this->request->getVar('email'),
                'password'    => $this->request->getVar('password'),
                'id_role'     => $this->request->getVar('role_user'),
                'is_active'   => $this->request->getVar('status')
            ];

        // Check if the password field is being updated
            $password = $this->request->getVar('password');
            if (!empty($password)) {
                if ($model->passwordsMatch($data['password'], $data['nipp'])) {
                    // Password Not Changed
                }else{
                    // Hash the plaintext password using bcrypt
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $data['password'] = $hashedPassword;
                }
            }

            $hasil = $model->updateUser($data);

            if ($hasil) {
                $successMessage = 'User '.$nama.' telah diupdate';
                $session = session();
                $session->setFlashdata('edit_success', $successMessage);
                return redirect()->to(base_url('admin/user'));
            } else {
                $failedMessage = 'Gagal update user';
                $session = session();
                $session->setFlashdata('edit_failed', $failedMessage);
                return redirect()->to(base_url('admin/user'));
            }

    }
}