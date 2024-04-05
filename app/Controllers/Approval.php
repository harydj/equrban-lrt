<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_approval;

class Approval extends BaseController
{
    public function index()
    {

        $model = new m_approval();
        $query = $model->getTransaksiPenabung();
        $bank = $model->getBanks();
        

        $data = [
            'title' => 'E-Qurban LRT Jabodebek',
            'active_page' => 'approval',
            'Menu'  => 'Approval',
            'session' => session(),
            'transaksi' => $query->getResult(),
            'bank'  => $bank
        ] ;


        echo view('include/header',$data);
        echo view('include/sidebar',$data);
        echo view('include/navbar',$data);
        echo view('admin/approval',$data);
        echo view('include/footer',$data);
    }

    public function approve_setoran()
    {
        $model = new m_approval();
        $transactionId = $this->request->getVar('id_transaksi_k');
        
        // Create a new transaction with updated status (2 = approved)
        $newTransactionId = $model->approveSetoran($transactionId, 2);

        if ($newTransactionId) {
            $successMessage = 'Transaksi penyetoran telah diapprove';
            $session = session();
            $session->setFlashdata('success', $successMessage);
            return redirect()->to(base_url('admin/approval'));       
        } else {
            $failedMessage = 'Transaksi penyetoran tidak diapprove ';
            $session = session();
            $session->setFlashdata('failed', $failedMessage);
            return redirect()->to(base_url('admin/approval'));
        }
    }

    public function reject_setoran()
    {
        $model = new m_approval();
        $transactionId = $this->request->getVar('id_transaksi_k');
        
        // Create a new transaction with updated status (3 = rejected)
        $newTransactionId = $model->rejectTransaksi($transactionId, 3);

        if ($newTransactionId) {
            $successMessage = 'Transaksi penyetoran telah direject';
            $session = session();
            $session->setFlashdata('success', $successMessage);
            return redirect()->to(base_url('admin/approval'));       
        } else {
            $failedMessage = 'Transaksi penyetoran tidak direject ';
            $session = session();
            $session->setFlashdata('failed', $failedMessage);
            return redirect()->to(base_url('admin/approval'));
        }
    }

    public function proses_tarik()
    {
        $model = new m_approval();
        $transactionId = $this->request->getVar('id_transaksi_d');
        
        // Create a new transaction with updated status (4 = in progress)
        $newTransactionId = $model->prosesPenarikan($transactionId, 4);

        if ($newTransactionId) {
            $successMessage = 'Transaksi penarikan telah diproses';
            $session = session();
            $session->setFlashdata('success', $successMessage);
            return redirect()->to(base_url('admin/approval'));       
        } else {
            $failedMessage = 'Transaksi penarikan tidak diproses ';
            $session = session();
            $session->setFlashdata('failed', $failedMessage);
            return redirect()->to(base_url('admin/approval'));
        }
    }

    public function transfer_dana()
    {
        $model = new m_approval();
        $session = session();
        $transactionId = $this->request->getVar('id_transaksi_d');
        

        $data = [
            'id_transaksi' => $transactionId,
            'tanggal_transfer' => $this->request->getVar('tanggal_transfer'),
            'nama_pengirim' => $this->request->getVar('nama_pengirim_d'),
            'rekening_pengirim' => $this->request->getVar('rekening_pengirim_d'),
            'bank_pengirim' => $this->request->getVar('bank_pengirim_d')
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
        // Create a new transaction with updated status (5 = funds sent)
        $newTransactionId = $model->prosesTransferDana($data, 5);


        if ($newTransactionId) {
            $successMessage = 'Transfer dana telah dikonfirmasi';
            $session = session();
            $session->setFlashdata('success', $successMessage);
            return redirect()->to(base_url('admin/approval'));       
        } else {
            $failedMessage = 'Transfer dana terkonfirmasi';
            $session = session();
            $session->setFlashdata('failed', $failedMessage);
            return redirect()->to(base_url('admin/approval'));
        }
    }

    public function reject_penarikan()
    {
        $model = new m_approval();
        $transactionId = $this->request->getVar('id_transaksi_d');
        
        // Create a new transaction with updated status (3 = rejected)
        $newTransactionId = $model->rejectTransaksi($transactionId, 3);

        if ($newTransactionId) {
            $successMessage = 'Transaksi penarikan telah direject';
            $session = session();
            $session->setFlashdata('success', $successMessage);
            return redirect()->to(base_url('admin/approval'));       
        } else {
            $failedMessage = 'Transaksi penarikan tidak direject ';
            $session = session();
            $session->setFlashdata('failed', $failedMessage);
            return redirect()->to(base_url('admin/approval'));
        }
    }
}