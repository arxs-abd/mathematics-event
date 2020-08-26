<?php

namespace App\Models;

use CodeIgniter\Model;

class RegionalModel extends Model
{
    protected $table = 'himatik3_me_regional';
    protected $validationRules = [
        'regional' => [
            'label' => 'Regional',
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

    public function get_by_coloumn($coloumn, $value)
    {
        return $this->db->table($this->table)->getWhere([$coloumn => $value])->getFirstRow();
    }

    public function insert_regional($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update_where($id, $data)
    {
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }
}
