<?php

namespace App\Models;

use CodeIgniter\Model;

class m_formulir_penabung extends Model {


    protected $table = 'tb_trx_penabung';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_transaksi', 'id_penyetoran', 'id_penarikan', 'id_penabung', 'tanggal_transaksi', 'nominal', 'saldo', 'id_keterangan', 'id_status', 'id_admin'];

    protected $table2 = 'tb_penyetoran_dana';
    protected $primaryKey2 = 'id_penyetoran';
    protected $allowedFields2 = ['id_penyetoran', 'nama_pengirim', 'rekening_pengirim', 'bank_pengirim', 'nama_penerima', 'rekening_penerima', 'bank_penerima', 'jumlah_setoran', 'metode_pembayaran', 'bukti_transfer','tanggal_penyetoran'];
   
    protected $table3 = 'tb_penarikan_dana';
    protected $primaryKey3 = 'id_penarikan';
    protected $allowedFields3 = ['id_penarikan', 'nama_pengirim', 'rekening_pengirim', 'bank_pengirim', 'nama_penerima', 'rekening_penerima', 'bank_penerima', 'jumlah_setoran', 'metode_pembayaran', 'bukti_transfer','tanggal_pengajuan','tanggal_transfer'];
   

    public function __construct() {
        parent::__construct();
    }

    public function getUser()
    {
        // Fetch all user data from database with all the reference table
        $builder = $this->db->table('tb_auth');
        $builder->select('tb_auth.id as id_penabung, nipp, nama, email, password, id_role, tb_role.role as role, tb_role.description as desc, is_active, tb_user_status.description as status, created_date');
        $builder->join('tb_role', 'tb_auth.id_role = tb_role.id');
        $builder->join('tb_user_status', 'tb_auth.is_active = tb_user_status.id');
        $builder->where('id_role','2');
        $builder->where('is_active','1');
        $query = $builder->get();
        return $query;
    }

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

    public function insertPenyetoran($data)
    {
        $builder = $this->db->table('tb_penyetoran_dana');
        $builder->insert($data);
        $id_penyetoran = $this->db->insertID();
        
        return $id_penyetoran;
        
    }

    public function insertPenarikan($data)
    {
        $builder = $this->db->table('tb_penarikan_dana');
        $builder->insert($data);
        $id_penarikan = $this->db->insertID();
        
        return $id_penarikan;
    }

    public function addtransaksi($data)
    {
        $builder = $this->db->table('tb_trx_penabung');
        $hasil = $builder->insert($data);
        
        return $hasil;
    }

    public function getSaldo($id_penabung) {
        $builder = $this->db->table('tb_tabungan');
        $builder->select('saldo');
        $builder->where('id_penabung', $id_penabung);
        $query = $builder->get();
        $result = $query->getRow();
    
        if ($result) {
            return $result->saldo;
        } else {
            return 0; // Atau nilai default saldo jika tidak ditemukan
        }
    }
}