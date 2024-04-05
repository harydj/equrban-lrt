<?php

namespace App\Models;

use CodeIgniter\Model;

class m_approval extends Model {


    protected $table = 'tb_trx_penabung';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_transaksi', 'id_penyetoran', 'id_penarikan', 'id_penabung', 'tanggal_transaksi', 'nominal', 'saldo', 'id_keterangan', 'id_status', 'id_admin'];

    public function getTransaksiPenabung()
    {
        $builder =  $this->db->table('tb_trx_penabung');
        $builder->select('tb_trx_penabung.*, 
                        penabung_auth.id as id_penabung, penabung_auth.nama as nama_penabung, penabung_auth.nipp, 
                        tb_status_transaksi.status, tb_keterangan.keterangan, 
                        admin_auth.nama as nama_approver, setor.nama_pengirim as nama_pengirim_k, setor.rekening_pengirim rekening_pengirim_k, setor.bank_pengirim bank_pengirim_k
                        ,setor.nama_penerima nama_penerima_k, setor.rekening_penerima rekening_penerima_k, setor.bank_penerima bank_penerima_k
                        ,setor.metode_pembayaran metode_pembayaran_k, setor.bukti_transfer bukti_transfer_k
                        ,tarik.nama_pengirim nama_pengirim_d, tarik.rekening_pengirim rekening_pengirim_d, tarik.bank_pengirim bank_pengirim_d
                        ,tarik.nama_penerima nama_penerima_d, tarik.rekening_penerima rekening_penerima_d,  tarik.bank_penerima bank_penerima_d
                        ,tarik.metode_pembayaran metode_pembayaran_d, tarik.bukti_transfer bukti_transfer_d');
        $builder->join('tb_auth as penabung_auth', 'penabung_auth.id = tb_trx_penabung.id_penabung','left');
        $builder->join('tb_auth as admin_auth', 'admin_auth.id = tb_trx_penabung.id_admin','left');
        $builder->join('tb_penyetoran_dana setor', 'setor.id_penyetoran = tb_trx_penabung.id_penyetoran','left');
        $builder->join('tb_penarikan_dana tarik', 'tarik.id_penarikan = tb_trx_penabung.id_penarikan','left' );
        $builder->join('tb_status_transaksi', 'tb_status_transaksi.id = tb_trx_penabung.id_status');
        $builder->join('tb_keterangan', 'tb_keterangan.id_keterangan = tb_trx_penabung.id_keterangan');
        $builder->join('(' . $this->db->table('tb_trx_penabung')
                ->select('id_penabung, MAX(id_transaksi) AS max_id_transaksi')
                ->groupBy('id_penabung, id_keterangan')
                ->getCompiledSelect() . ') m', 'tb_trx_penabung.id_penabung = m.id_penabung AND tb_trx_penabung.id_transaksi = m.max_id_transaksi', 'inner');
        
        // Menambahkan klausa where untuk id_keterangan = 1
        $builder->where('tb_trx_penabung.id_keterangan', 1);
        $builder->where('tb_trx_penabung.id_status', 1);

        // Menambahkan klausa where untuk id_keterangan = 2
        $builder->orWhere('tb_trx_penabung.id_keterangan', 2);
        $builder->whereIn('tb_trx_penabung.id_status', [1, 4]);

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

    public function approveSetoran($transactionId, $newStatus)
    {
        // Get the existing transaction data
        $existingTransaction = $this->find($transactionId);
        
        // Calculate new saldo by adding current saldo with nominal
        $existingSaldo = $this->getSaldo($existingTransaction['id_penabung']);
        $newSaldo = $existingSaldo + $existingTransaction['nominal'];

        // Get id_admin from session
        $session = session();
        $idAdmin = $session->get('id');


        // Create a new transaction with updated status and saldo
        $newTransaction = [
            'id_penyetoran' => $existingTransaction['id_penyetoran'],
            'id_penarikan' => $existingTransaction['id_penarikan'],
            'id_penabung' => $existingTransaction['id_penabung'],
            'tanggal_transaksi' => $existingTransaction['tanggal_transaksi'], // Current date
            'nominal' => $existingTransaction['nominal'],
            'saldo' => $newSaldo, // Updated saldo
            'id_keterangan' => $existingTransaction['id_keterangan'],
            'id_status' => $newStatus,
            'id_admin' => $idAdmin, // Set id_admin from session
            'created_date' => date('Y-m-d H:i:s') // Current timestamp
        ];

        // Insert the new transaction
        $this->insert($newTransaction);

        // Update saldo in tb_tabungan table
        $hasil = $this->updateTabunganSaldo($existingTransaction['id_penabung'], $newSaldo);

        return $hasil; // Return the ID of the newly created transaction
    }

    public function rejectTransaksi($transactionId, $newStatus)
    {
        // Get the existing transaction data
        $existingTransaction = $this->find($transactionId);
        
        $existingSaldo = $this->getSaldo($existingTransaction['id_penabung']);
        // Get id_admin from session
        $session = session();
        $idAdmin = $session->get('id');

        // Create a new transaction with updated status and saldo
        $newTransaction = [
            'id_penyetoran' => $existingTransaction['id_penyetoran'],
            'id_penarikan' => $existingTransaction['id_penarikan'],
            'id_penabung' => $existingTransaction['id_penabung'],
            'tanggal_transaksi' => $existingTransaction['tanggal_transaksi'], // Current date
            'nominal' => $existingTransaction['nominal'],
            'saldo' => $existingSaldo, 
            'id_keterangan' => $existingTransaction['id_keterangan'],
            'id_status' => $newStatus,
            'id_admin' => $idAdmin, // Set id_admin from session
            'created_date' => date('Y-m-d H:i:s') // Current timestamp
        ];

        // Insert the new transaction
        $hasil = $this->insert($newTransaction);

        return $hasil; // Return the ID of the newly created transaction
    }

    public function prosesPenarikan($transactionId, $newStatus)
    {
        // Get the existing transaction data
        $existingTransaction = $this->find($transactionId);

        $existingSaldo = $this->getSaldo($existingTransaction['id_penabung']);
        
        // Get id_admin from session
        $session = session();
        $idAdmin = $session->get('id');



        // Create a new transaction with updated status and saldo
        $newTransaction = [
            'id_penyetoran' => $existingTransaction['id_penyetoran'],
            'id_penarikan' => $existingTransaction['id_penarikan'],
            'id_penabung' => $existingTransaction['id_penabung'],
            'tanggal_transaksi' => $existingTransaction['tanggal_transaksi'], // Current date
            'nominal' => $existingTransaction['nominal'],
            'saldo' => $existingSaldo, 
            'id_keterangan' => $existingTransaction['id_keterangan'],
            'id_status' => $newStatus,
            'id_admin' => $idAdmin, // Set id_admin from session
            'created_date' => date('Y-m-d H:i:s') // Current timestamp
        ];

        // Insert the new transaction
        $hasil = $this->insert($newTransaction);

        return $hasil; // Return the ID of the newly created transaction
    }

    protected function updateTabunganSaldo($idPenabung, $newSaldo)
    {
        $builder = $this->db->table('tb_tabungan');
        $builder->where('id_penabung',$idPenabung);

        $data['saldo'] = $newSaldo;

        $hasil = $builder->update($data);

        return $hasil;
    }

    protected function getSaldo($idPenabung)
{
    $builder = $this->db->table('tb_tabungan');
    $builder->select('saldo');
    $builder->where('id_penabung', $idPenabung);

    $query = $builder->get();
    $row = $query->getRow();

    if ($row) {
        return $row->saldo;
    } else {
        return 0; // Atau nilai default sesuai kebutuhan Anda
    }
}

    public function prosesTransferDana($data, $newStatus)
    {
        $existingTransaction = $this->find($data['id_transaksi']);

        $existingSaldo = $this->getSaldo($existingTransaction['id_penabung']);
        

        $data_penarikan = [
            'tanggal_transfer' => $data['tanggal_transfer'],
            'nama_pengirim' => $data['nama_pengirim'],
            'rekening_pengirim' => $data['rekening_pengirim'],
            'bank_pengirim' => $data['bank_pengirim'],
            'bukti_transfer' => $data['bukti_transfer']
        ];

        $builder = $this->db->table('tb_penarikan_dana');
        $builder->where('id_penarikan', $existingTransaction['id_penarikan']);
        $hasil_penarikan = $builder->update($data_penarikan);

        // Get id_admin from session
        $session = session();
        $idAdmin = $session->get('id');

        if($hasil_penarikan){
            $newSaldo = $existingSaldo - $existingTransaction['nominal'];
             
            $newTransaction = [
                'id_penyetoran' => $existingTransaction['id_penyetoran'],
                'id_penarikan' => $existingTransaction['id_penarikan'],
                'id_penabung' => $existingTransaction['id_penabung'],
                'tanggal_transaksi' => $existingTransaction['tanggal_transaksi'], // Current date
                'nominal' => $existingTransaction['nominal'],
                'saldo' => $newSaldo, // Updated saldo
                'id_keterangan' => $existingTransaction['id_keterangan'],
                'id_status' => $newStatus,
                'id_admin' => $idAdmin, // Set id_admin from session
                'created_date' => date('Y-m-d H:i:s') // Current timestamp
            ];
    
            // Insert the new transaction
            $this->insert($newTransaction);
    
            // Update saldo in tb_tabungan table
            $hasil = $this->updateTabunganSaldo($existingTransaction['id_penabung'], $newSaldo);
            return $hasil;
        }else{
            return false;
        }
        
        
    }
    
}