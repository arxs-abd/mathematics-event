<?php

namespace App\Controllers;

use App\Models\HargaModel;
use App\Models\PesertaModel;
use App\Models\RegionalModel;
use CodeIgniter\Config\Config;

class Regional extends BaseController
{
    protected $regional;

    public function __construct()
    {
        $this->regional = new RegionalModel();
        $this->harga_regional = new HargaModel();
    }

    public function addRegional()
    {
        // Cek Token
        $token = $this->request->getPost('token');
        if ($token != session()->get('csrf_token')) {
            session()->setFlashdata('fail', 'Token Yang Anda Masukkan Salah');
            return redirect()->to(base_url('/regional'));
        }

        $rules = $this->regional->getValidationRules();
        // dd($this->request->getPost());
        if (!$this->validate($rules)) {
            session()->setFlashdata('fail', 'Gagal Menambahkan Regional');
            return redirect()->to(base_url('/regional'));
        }
        $dataRegional = [
            'regional' => $this->request->getPost('regional')
        ];
        $this->regional->insert_regional($dataRegional);
        $idRegional = $this->regional->get_by_coloumn('regional', $this->request->getPost('regional'));
        $dataHargaRegional = [
            'id_regional' => $idRegional->id,
            'sd' => $this->request->getPost('sd'),
            'smp' => $this->request->getPost('smp'),
            'sma' => $this->request->getPost('sma'),
        ];
        $this->harga_regional->insert_harga($dataHargaRegional);
        session()->setFlashdata('success', 'Regional Berhasil Di Tambah');
        return redirect()->to(base_url('/regional'));
    }

    public function editRegional()
    {
        // Cek Token
        $token = $this->request->getPost('token');
        if ($token != session()->get('csrf_token')) {
            session()->setFlashdata('fail', 'Token Yang Anda Masukkan Salah');
            return redirect()->to(base_url('/regional'));
        }

        $rules = $this->regional->getValidationRules();
        if (!$this->validate($rules)) {
            session()->setFlashdata('fail', 'Gagal Mengedit Regional');
            return redirect()->to(base_url('/regional'));
        }
        $data = [
            'regional' => $this->request->getPost('regional')
        ];

        $this->regional->update_where($this->request->getPost('id'), $data);
        $idRegional = $this->regional->get_by_coloumn('regional', $this->request->getPost('regional'));
        $dataHargaRegional = [
            'id_regional' => $idRegional->id,
            'sd' => $this->request->getPost('sd'),
            'smp' => $this->request->getPost('smp'),
            'sma' => $this->request->getPost('sma'),
        ];
        $this->harga_regional->update_where($this->request->getPost('id'), $dataHargaRegional);
        session()->setFlashdata('success', 'Regional Berhasil Di Edit');
        return redirect()->to(base_url('/regional'));
    }

    public function deleteRegional()
    {
        // Cek Token
        $token = $this->request->getPost('token');
        if ($token != session()->get('csrf_token')) {
            session()->setFlashdata('fail', 'Token Yang Anda Masukkan Salah');
            return redirect()->to(base_url('/regional'));
        }

        // $this->regional->delete(['id' => $this->request->getPost('id')]);
        $this->harga_regional->delete_where('id_regional', $this->request->getPost('id'));
        session()->setFlashdata('success', 'Regional Berhasil Di Hapus');
        return redirect()->to(base_url('/regional'));
    }
}
