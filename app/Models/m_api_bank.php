<?php

namespace App\Models;

use CodeIgniter\Model;

class m_api_bank extends Model
{
    protected $table = '';
    protected $primaryKey = '';
    protected $allowedFields = [];

    public function getBanks()
    {
        // Panggil API untuk mengambil data bank
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        $response = file_get_contents('https://bank.thecloudalert.com/api/get/', false, $context);
        $data = json_decode($response, true);

        // Return data bank
        return $data['data'];
    }
}
