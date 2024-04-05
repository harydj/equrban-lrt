<?php

namespace App\Models;

use CodeIgniter\Model;

class m_tabungan extends Model {


    protected $table = 'tb_tabungan';
    protected $primaryKey = 'id_penabung';
    protected $allowedFields = ['id_penabung', 'saldo', 'nipp'];

    public function __construct() {
        parent::__construct();
    }  

    
}