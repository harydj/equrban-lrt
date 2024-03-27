<?php

namespace App\Models;

use CodeIgniter\Model;

class m_user extends Model {


    protected $table = 'tb_auth';
    protected $table_desc = 'tb_role';

    public function __construct() {
        parent::__construct();
    }

    public function getUser()
    {
        $builder = $this->db->table('tb_auth');
        $builder->select('nipp, nama, email, password, id_role, tb_role.role as role, tb_role.description as desc, is_active, tb_user_status.description as status, created_date');
        $builder->join('tb_role', 'tb_auth.id_role = tb_role.id');
        $builder->join('tb_user_status', 'tb_auth.is_active = tb_user_status.id');
        $query = $builder->get();
        return $query;
    }

    
}