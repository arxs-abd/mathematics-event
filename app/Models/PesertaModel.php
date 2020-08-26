<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $table = 'himatik3_me_peserta';
    // protected $allowedFields = ['namaLengkap', 'kelamin', 'namaSekolah', 'pin', 'status', 'alamat', 'telp', 'email', 'regional', 'tingkat'];
    protected $validationRules = [
        'namaLengkap' => [
            'label' => 'Nama Lengkap',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
            ]
        ],
        'kelamin' => [
            'label' => 'Jenis Kelamin',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
            ]
        ],
        'namaSekolah' => [
            'label' => 'Nama Sekolah',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
            ]
        ],
        'alamat' => [
            'label' => 'Alamat',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
            ]
        ],
        'telp' => [
            'label' => 'Nomot Hp',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
            ]
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong',
                'valid_email' => 'Masukkan {field} yang Benar'
            ]
        ],
        'regional' => [
            'label' => 'Regional',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
            ]
        ],
        'tingkat' => [
            'label' => 'Jenjang Sekolah',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
            ]
        ]
    ];

    public function getAll()
    {
        return $this->db->table($this->table)->get()->getResultArray();
    }

    public function get_by_id($id)
    {
        return $this->db->table($this->table)->getWhere(['id' => $id])->getFirstRow();
    }

    public function insert_peserta($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update_where($id, $data)
    {
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }

    public function check_pin($pin)
    {
        return $this->db->table($this->table)->getWhere(['pin' => $pin])->getFirstRow();
    }

    public function delete_many($data)
    {
        return $this->db->table($this->table)->whereIn('id', $data)->delete();
    }
}
