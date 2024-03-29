<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_login;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tabungan Qurban LRT Jabodebek'
        ];
        echo view('include/header', $data);
        echo view('login', $data);
        echo view('include/footer');
    }

    public function check_account()
    {
        //validasi login
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        //fetch data from database for login validation
        $model = new m_login();

        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            // Verify password with hashed password bcrypt
            $verify_pass = password_verify($password, $pass);
            
            if ($verify_pass) {
                $ses_data = [
                    'id' => $data['id'],
                    'email' => $data['email'],
                    'nipp' => $data['nipp'], 
                    'nama' => $data['nama'],
                    'is_active' => $data['is_active'],
                    'id_role' => $data['id_role'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                if ($data['is_active'] == 0) {
                    $session->setFlashdata('msg', 'Akun tidak aktif');
                    return redirect()->to(base_url('/'));
                } else {
                    if ($session->id_role == '1') {
                        return redirect()->to(base_url('dashboard/admin'));
                    } elseif ($session->id_role == '2') {
                        return redirect()->to(base_url('dashboard/penabung'));
                    }
                }
                
            } else {
                $session->setFlashdata('msg', 'Password salah');
                return redirect()->to(base_url('/'));
            }
        } else {
            $session->setFlashdata('msg', 'Email tidak terdaftar');
            return redirect()->to(base_url('/'));
        }
    }


    public function logout()
    {
        $session = session();

        // Clear cookies
        foreach ($_COOKIE as $key => $value) {
            setcookie($key, '', time() - 3600);
        }
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}