<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table = 'himatik3_me_pengaturan';
    protected $validationRules = [
        'value' => [
            'label' => 'Pengaturan',
            'rules' => 'required',
            'errors' => [
                'required' => '{fields} Harus Di Isi',
            ]
        ]
    ];

    public function update_where($id, $data)
    {
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }
}
