<?php

namespace App\Models;

use CodeIgniter\Model;

class m_login extends Model {
    private $email;
    private $password;

    protected $table = 'tb_auth';
    protected $id = 'tb_auth.id';

    public function __construct() {
        parent::__construct();
    }

    
}