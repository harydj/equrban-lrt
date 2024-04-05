<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_transaksi_penabung;

class Transaksi_Penabung extends BaseController
{
    public function index()
    {
        $model = new m_transaksi_penabung();
        $query = $model->getTransaksiPenabung();

        $data = [
            'title' => 'E-Qurban LRT Jabodebek',
            'active_page' => 'transaksi_penabung',
            'Menu'  => 'Transaksi Penabung',
            'session' => session(),
            'transaksi' => $query->getResult()
        ] ;


        echo view('include/header', $data);
        echo view('include/sidebar', $data);
        echo view('include/navbar', $data);
        echo view('admin/transaksi_penabung', $data);
        echo view('include/footer');
    }

}
