<?php

namespace App\Models;

use CodeIgniter\Model;

class m_dashboard_admin extends Model {


    // protected $table = 'tb_trx_penabung';
    // protected $primaryKey = 'id_transaksi';
    // protected $allowedFields = ['id_transaksi', 'id_penyetoran', 'id_penarikan', 'id_penabung', 'tanggal_transaksi', 'nominal', 'saldo', 'keterangan', 'id_status', 'id_admin'];

    // public function getTransaksiPenabung()
    // {
    //     $builder =  $this->db->table('tb_trx_penabung');
    //     $builder->select('tb_trx_penabung.*, 
    //                     penabung_auth.id as id_penabung, penabung_auth.nama as nama_penabung, penabung_auth.nipp, 
    //                     tb_status_transaksi.status, 
    //                     admin_auth.nama as nama_approver, setor.nama_pengirim as nama_pengirim_k, setor.rekening_pengirim rekening_pengirim_k
    //                     ,setor.nama_penerima nama_penerima_k, setor.rekening_penerima rekening_penerima_k
    //                     ,setor.metode_pembayaran metode_pembayaran_k, setor.bukti_transfer bukti_transfer_k
    //                     ,tarik.nama_pengirim nama_pengirim_d, tarik.rekening_pengirim rekening_pengirim_d
    //                     ,tarik.nama_penerima nama_penerima_d, tarik.rekening_penerima rekening_penerima_d
    //                     ,tarik.metode_pembayaran metode_pembayaran_d, tarik.bukti_transfer bukti_transfer_d');
    //     $builder->join('tb_auth as penabung_auth', 'penabung_auth.id = tb_trx_penabung.id_penabung','left');
    //     $builder->join('tb_auth as admin_auth', 'admin_auth.id = tb_trx_penabung.id_admin','left');
    //     $builder->join('tb_penyetoran_dana setor', 'setor.id_penyetoran = tb_trx_penabung.id_penyetoran','left');
    //     $builder->join('tb_penarikan_dana tarik', 'tarik.id_penarikan = tb_trx_penabung.id_penarikan','left' );
    //     $builder->join('tb_status_transaksi', 'tb_status_transaksi.id = tb_trx_penabung.id_status');
    //     $builder->join('(' . $this->db->table('tb_trx_penabung')
    //             ->select('id_penabung, MAX(id_transaksi) AS max_id_transaksi')
    //             ->groupBy('id_penabung, keterangan')
    //             ->getCompiledSelect() . ') m', 'tb_trx_penabung.id_penabung = m.id_penabung AND tb_trx_penabung.id_transaksi = m.max_id_transaksi', 'inner');
    //     $query = $builder->get();
    //     return $query;
    // }

    public function getTotalSaldo()
    {
        // Ambil total saldo dari semua penabung
        $builder = $this->db->table('tb_tabungan');
        $totalSaldo = $builder->selectSum('saldo')->get()->getRow()->saldo;
        return $totalSaldo;
    }

    public function getTotalPenabungAktif()
    {
        $builder = $this->db->table('tb_auth');
        $builder->where('is_active', 1);
        $builder->countAllResults();
        return $builder->countAllResults();
    }

    public function getTotalSetoran()
    {
        $builder = $this->db->table('tb_trx_penabung');
        $builder->selectSum('nominal');
        $builder->where('id_status', 2);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->nominal ?? 0;
    }
    
    public function getTotalPenarikan()
    {
        $builder = $this->db->table('tb_trx_penabung');
        $builder->selectSum('nominal');
        $builder->where('id_status', 5);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->nominal ?? 0;
    }

    public function getJumlahTransaksiPerStatus()
    {
        $subquery = "(SELECT id_penabung, id_keterangan, id_status, 
                         ROW_NUMBER() OVER (PARTITION BY id_penabung, id_keterangan ORDER BY id_transaksi DESC) AS row_num
                      FROM $this->table) AS ranked_transactions";

        $builder = $this->db->table($subquery)
                            ->select('id_status, COUNT(*) AS jumlah_transaksi')
                            ->where('row_num', 1)
                            ->groupBy('id_status');

        $query = $builder->get();

        return $query->getResult();
    }
}