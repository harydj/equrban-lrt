<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_dashboard_admin;

class Dashboard_Admin extends BaseController
{
    public function index()
    {
         // Load model
         $model = new m_dashboard_admin();

         // Get total saldo
         $totalSaldo = $model->getTotalSaldo();
         $penabungAktif = $model->getTotalPenabungAktif();
         $totalSetoran = $model->getTotalSetoran();
         $totalPenarikan = $model->getTotalPenarikan();
        //  $jumlahTrxPerStatus = $model->getJumlahTransaksiPerStatus();

        $data = [
            'title' => 'E-Qurban LRT Jabodebek',
            'active_page' => 'dashboard',
            'Menu'  => 'Dashboard',
            'session' => session(),
            'total_saldo' => $totalSaldo,
            'total_penabung' => $penabungAktif,
            'total_setoran' => $totalSetoran,
            'total_penarikan' => $totalPenarikan
            // 'jumlahTrxPerStatus' => $jumlahTrxPerStatus
        ] ;


        echo view('include/header', $data);
        echo view('include/sidebar', $data);
        echo view('include/navbar', $data);
        echo view('admin/dashboard', $data);
        echo view('include/footer');
    }

}