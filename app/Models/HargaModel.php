<?php

namespace App\Models;

use CodeIgniter\Model;

class HargaModel extends Model
{
    protected $table = 'himatik3_me_harga_regional';
    protected $validationRules = [
        'sd' => [
            'label' => 'Harga SD',
            'rules' => 'required',
            'errors' => [
                'reqired' => '{field} Tidak Boleh Kosong '
            ]
        ],
        'smp' => [
            'label' => 'Harga SMP',
            'rules' => 'required',
            'errors' => [
                'reqired' => '{field} Tidak Boleh Kosong '
            ]
        ],
        'sma' => [
            'label' => 'Harga SMA',
            'rules' => 'required',
            'errors' => [
                'reqired' => '{field} Tidak Boleh Kosong '
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

    public function insert_harga($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update_where($id, $data)
    {
        return $this->db->table($this->table)->where('id_regional', $id)->update($data);
    }

    public function delete_where($field, $value)
    {
        return $this->db->table($this->table)->delete([$field => $value]);
    }
}
