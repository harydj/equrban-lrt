<?php

namespace App\Models;

use CodeIgniter\Model;

class m_user extends Model {


    protected $table = 'tb_auth';
    protected $table_desc = 'tb_role';

    // Define allowed fields for changed or new records to table.
    protected $allowedFields = [
        'nipp',
        'nama',
        'email',
        'password',
        'id_role',
        'is_active'
    ];

    public function __construct() {
        parent::__construct();
    }

    public function getUser()
    {
        // Fetch all user data from database with all the reference table
        $builder = $this->db->table('tb_auth');
        $builder->select('nipp, nama, email, password, id_role, tb_role.role as role, tb_role.description as desc, is_active, tb_user_status.description as status, created_date');
        $builder->join('tb_role', 'tb_auth.id_role = tb_role.id');
        $builder->join('tb_user_status', 'tb_auth.is_active = tb_user_status.id');
        $query = $builder->get();
        return $query;
    }

    public function updateUser($data){
        // Fetch user data from database by NIPP
        $builder = $this->db->table('tb_auth');
        $builder->where('nipp',$data['nipp']);
        // Update user data by given parameter
        $hasil = $builder->update($data);

        return $hasil;
    }

    public function passwordsMatch($password, $nipp){
        // Fetch user data from the database by NIPP
        $user = $this->where('nipp', $nipp)->first();

        // Check if the password not changed
        if ($password == $user['password']) {
            // Return True if the submitted password matches the hashed password stored in the database
            return true;
        } else {
            // Return false if the password is changed
            return false;
        }
    }

    
}