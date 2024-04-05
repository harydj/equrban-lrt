<?php

namespace App\Controllers;

use App\Models\m_api_bank;

class Bank_API extends BaseController
{
    public function index()
    {
        // Panggil model untuk mengambil data bank
        $bankModel = new m_api_bank();
        $banks = $bankModel->getBanks();

        // Kirim data bank ke view
        return view('admin/bank_api', ['banks' => $banks]);
    }
}
