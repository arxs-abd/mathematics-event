<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\RegionalModel;
use App\Models\PesertaAjaxModel;
use CodeIgniter\Config\Config;

class Peserta extends BaseController
{
    public function ajax_list()
    {
        $peserta = new PesertaAjaxModel($this->request);
        if ($this->request->getMethod(true) == 'POST') {
            $lists = $peserta->get_datatables();
            $data = [];
            $no = $this->request->getPost('start');
            foreach ($lists as $list) {
                // $no++;
                $url = base_url('/cetak/' . $list->pin);
                $checkbox = <<< HTML
                    <input class="text-center" type="checkbox" name="md" data-id="$list->id">
                HTML;
                $action = <<< HTML
                    <a href="" data-id="$list->id" data-namaLengkap="$list->namaLengkap" data-namaSekolah="$list->namaSekolah" data-kelamin="$list->kelamin" data-alamat="$list->alamat" data-telp="$list->telp" data-email="$list->email" data-regional="$list->regional" data-tingkat="$list->tingkat" class="btn btn-info btn-sm btn-edit-peserta"><i class="fas fa-fw fa-edit"></i></a>
                    <a href="" class="btn btn-warning btn-sm btn-detail-peserta"><i class="fas fa-fw fa-info"></i></a>
                    <a href="" data-namaLengkap="$list->namaLengkap" data-id="$list->id" class="btn btn-danger btn-sm btn-delete-peserta"><i class="fas fa-fw fa-trash"></i></a>
                    <a href="$url" target="_blank" class="btn btn-secondary btn-sm"> <i class="fas fa-fw fa-print"></i></a>
                HTML;
                $row = [$checkbox, $list->namaLengkap, $list->pin, $list->namaSekolah, getStatus($list->status), $action];
                array_push($data, $row);
            }
            $output = [
                'draw' => $this->request->getPost('draw'),
                'recordsTotal' => $peserta->count_all(),
                'recordsFiltered' => $peserta->count_filtered(),
                'data' => $data
            ];
            return json_encode($output);
        }
    }

    public function hapusPeserta()
    {
        dd($this->request->getPost());
    }

    public function addPeserta()
    {
        // dd($this->request->getPost());
        // Cek Token
        $token = $this->request->getPost('token');
        if ($token != session()->get('csrf_token')) {
            session()->setFlashdata('fail', 'Token Yang Anda Masukkan Salah');
            return redirect()->to(base_url('/peserta'));
        }
        $peserta = new PesertaModel();
        $field = ['namaLengkap', 'kelamin', 'namaSekolah', 'alamat', 'telp', 'email', 'regional', 'tingkat'];
        $rules = $peserta->validationRules;
        if (!$this->validate($rules)) {
            session()->setFlashdata('fail', 'Gagal Menambahkan Peserta Baru');
            return redirect()->to(base_url('/dashboard'));
        }
        $pin = random_string('numeric', 8);
        $data = [
            'namaLengkap' => $this->request->getPost('namaLengkap'),
            'kelamin' => $this->request->getPost('kelamin'),
            'namaSekolah' => $this->request->getPost('namaSekolah'),
            'pin' => $pin,
            'status' => 1,
            'alamat' => $this->request->getPost('alamat'),
            'telp' => $this->request->getPost('telp'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'tgl_daftar' => time(),
            'regional' => $this->request->getPost('regional'),
            'tingkat' => $this->request->getPost('tingkat'),
        ];
        $peserta->insert_peserta($data);
        session()->setFlashdata('success', 'Peserta Berhasil Di Tambah');
        return redirect()->to(base_url('/peserta'));
    }

    public function editPeserta()
    {
        if ($this->request->getPost('id')) {
            $id = $this->request->getPost('id');
            $url = '/peserta';
        } else {
            $id = session()->get('id');
            $url = '/edit_peserta';
        }
        // Cek Token
        $token = $this->request->getPost('token');
        if ($token != session()->get('csrf_token')) {
            session()->setFlashdata('fail', 'Token Yang Anda Masukkan Salah');
            return redirect()->to(base_url($url));
        }
        $peserta = new PesertaModel();
        $rules = $peserta->validationRules;
        if (!$this->validate($rules)) {
            session()->setFlashdata('fail', 'Gagal Mengedit Peserta');
            return redirect()->to(base_url($url))->with('errors', $this->validator->getErrors());
        }
        $data = [
            'namaLengkap' => $this->request->getPost('namaLengkap'),
            'kelamin' => $this->request->getPost('kelamin'),
            'namaSekolah' => $this->request->getPost('namaSekolah'),
            'alamat' => $this->request->getPost('alamat'),
            'telp' => $this->request->getPost('telp'),
            'email' => $this->request->getPost('email'),
            'regional' => $this->request->getPost('regional'),
            'tingkat' => $this->request->getPost('tingkat'),
        ];
        $peserta->update_where($id, $data);
        session()->setFlashdata('success', 'Peserta Berhasil Di Edit');
        return redirect()->to(base_url($url));
    }

    public function deletePeserta()
    {
        // Cek Token
        $token = $this->request->getPost('token');
        if ($token != session()->get('csrf_token')) {
            session()->setFlashdata('fail', 'Token Yang Anda Masukkan Salah');
            return redirect()->to(base_url('/dashboard'));
        }
        $peserta = new PesertaModel();
        $id = $this->request->getPost('id');
        // dd($id);
        if (is_array($id)) {
            $peserta->delete_many($id);
        } else {
            $peserta->delete(['id' => $id]);
        }
        session()->setFlashdata('success', 'Peserta Berhasil Di Hapus');
        return redirect()->to(base_url('/peserta'));
    }
}
