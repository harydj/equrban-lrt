<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_formulir_penabung;

class Formulir_Penabung extends BaseController
{
    public function index()
    {      
        $model = new m_formulir_penabung();
        $user = $model->getUser();
        $bank = $model->getBanks();

        $data = [
            'title' => 'E-Qurban LRT Jabodebek',
            'active_page' => 'formulir_penabung',
            'Menu'  => 'Formulir Penabung',
            'session' => session(),
            'user'  => $user->getResult(),
            'bank' => $bank
        ] ;

        echo view('include/header',$data);
        echo view('include/sidebar',$data);
        echo view('include/navbar',$data);
        echo view('admin/formulir_penabung',$data);
        echo view('include/footer',$data);
    }

    public function add_penyetoran()
    {
        // Proses penyimpanan data
        $model = new m_formulir_penabung();
        $session = session();
        // Siapkan data untuk disimpan
        $id_penabung = $this->request->getVar('id_penabung');

        $data = [
            'tanggal_penyetoran' => $this->request->getVar('tanggal_penyetoran'),
            'nama_pengirim' => $this->request->getVar('nama_pengirim'),
            'rekening_pengirim' => $this->request->getVar('rekening_pengirim'),
            'bank_pengirim' => $this->request->getVar('bank_pengirim'),
            'nama_penerima' => $this->request->getVar('nama_penerima'),
            'rekening_penerima' => $this->request->getVar('rekening_penerima'),
            'bank_penerima' => $this->request->getVar('bank_penerima'),
            'metode_pembayaran' => 'Transfer Bank',
            'jumlah_setoran' => $this->request->getVar('jumlah_setoran'),
        ];
        

        // Upload gambar
        $buktiTransfer = $this->request->getFile('bukti_transfer');

        // Periksa apakah file telah diunggah
        if (!empty($buktiTransfer)) {
            if ($buktiTransfer->isValid() && !$buktiTransfer->hasMoved()) {
                $newName = $buktiTransfer->getRandomName();
                $buktiTransfer->move("assets/img/uploads", $newName); 
                $data['bukti_transfer'] = $newName;
            }
        } else {
            $session->setFlashdata('error', 'Tidak ada file yang diunggah.');
        }

        // Simpan data penyetoran ke database
        $id_penyetoran = $model->insertPenyetoran($data);


        // Get Saldo saat ini
        $saldo = $model->getSaldo($id_penabung);

        // Jika penyimpanan data penyetoran berhasil
        if ($id_penyetoran) {
            // Siapkan data untuk transaksi
            $dataTransaksi = [
                'id_penabung' => $id_penabung,
                'id_penyetoran' => $id_penyetoran, // ID penyetoran yang baru saja dimasukkan
                'tanggal_transaksi' => $this->request->getVar('tanggal_penyetoran'), // Tanggal transaksi saat ini
                'nominal' => $this->request->getVar('jumlah_setoran'), // Gunakan jumlah setoran dari form
                'saldo' => $saldo, // didapatkan dari fungsi get saldo
                'id_keterangan' => 1, //ID keterangan 1 = setor
                'id_status' => 1, // ID status transaksi 
                'id_admin' => null, // Isi jika  admin telah memproses transaksi
            ];

            // Simpan data transaksi ke tabel tb_trx_penabung
            $model->addTransaksi($dataTransaksi);

            // Set pesan sukses
            $successMessage = 'Penyetoran disubmit';
            $session->setFlashdata('success', $successMessage);
            return redirect()->to(base_url('admin/formulir_penabung'));
        } else {
            // Set pesan gagal jika penyimpanan data penyetoran gagal
            $failedMessage = 'Penyetoran tidak disubmit';
            $session->setFlashdata('failed', $failedMessage);
            return redirect()->to(base_url('admin/formulir_penabung'));
        }


    }

    public function add_penarikan()
    {
        // Proses penyimpanan data
        $model = new m_formulir_penabung();
        $session = session();
        $id_penabung =  $this->request->getVar('id_penabung_d');
        // Siapkan data untuk disimpan
        $data = [
            'tanggal_pengajuan' => $this->request->getVar('tanggal_pengajuan'),
            'nama_pengirim' => $this->request->getVar('nama_pengirim_d'),
            'rekening_pengirim' => $this->request->getVar('rekening_pengirim_d'),
            'bank_pengirim' => $this->request->getVar('bank_pengirim_d'),
            'nama_penerima' => $this->request->getVar('nama_penerima_d'),
            'rekening_penerima' => $this->request->getVar('rekening_penerima_d'),
            'bank_penerima' => $this->request->getVar('bank_penerima_d'),
            'jumlah_penarikan' => $this->request->getVar('jumlah_penarikan'),
            'metode_pembayaran' => 'Transfer Bank'
        ];
        

        // Upload gambar
        $buktiTransfer = $this->request->getFile('bukti_transfer_d');
    
        // Periksa apakah file telah diunggah
        if (!empty($buktiTransfer)) {
            if ($buktiTransfer->isValid() && !$buktiTransfer->hasMoved()) {
                $newName = $buktiTransfer->getRandomName();
                $buktiTransfer->move("assets/img/uploads", $newName); 
                $data['bukti_transfer'] = $newName;
            }
        } else {
            $session->setFlashdata('error', 'Tidak ada file yang diunggah.');
        }

        // Simpan data ke database
        $id_penarikan = $model->insertPenarikan($data);

        // Get Saldo saat ini
        $saldo = $model->getSaldo($id_penabung);
        

        if ($id_penarikan) {
            $dataTransaksi = [
                'id_penabung' => $id_penabung,
                'id_penarikan' => $id_penarikan, // ID penyetoran yang baru saja dimasukkan
                'tanggal_transaksi' => $this->request->getVar('tanggal_pengajuan'), // Tanggal transaksi saat ini
                'nominal' => $this->request->getVar('jumlah_penarikan'), // Gunakan jumlah setoran dari form
                'saldo' => $saldo, // didapatkan dari fungsi get saldo
                'id_keterangan' => 2, //ID keterangan 2 = tarik
                'id_status' => 1, // ID status transaksi
                'id_admin' => null, // Isi jika  admin telah memproses transaksi
            ];

            // Simpan data transaksi ke tabel tb_trx_penabung
            $model->addTransaksi($dataTransaksi);

            $successMessage = 'Penarikan dana diajukan';
            $session = session();
            $session->setFlashdata('success', $successMessage);
            return redirect()->to(base_url('admin/formulir_penabung'));          
        } else {
            $failedMessage = 'Penarikan dana tidak berhasil diajukan';
            $session = session();
            $session->setFlashdata('failed', $failedMessage);
            return redirect()->to(base_url('admin/formulir_penabung'));
        }
    }
}