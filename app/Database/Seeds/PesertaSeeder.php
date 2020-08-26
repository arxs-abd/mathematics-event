<?php

namespace App\Database\Seeds;

class PesertaSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        helper('text');
        helper('custom');
        for ($i = 0; $i < 799; $i++) {
            $peserta = new \App\Models\PesertaModel();
            $gender = ['male', 'female'];
            $faker = \Faker\Factory::create('id_ID');
            $g = $gender[$faker->numberBetween(0, 1)];
            $pin = random_string('numeric', 8);
            while ($peserta->check_pin($pin)) {
                $pin = random_string('numeric', 8);
            }
            $regional = get_regional();
            $tingkat = get_tingkat();
            $datax = [
                'namaLengkap' => $faker->name($g),
                'kelamin' => ($g == 'male') ? 'Laki-Laki' : 'Perempuan',
                'namaSekolah' => "{$tingkat} {$faker->numberBetween(1, 100)} {$regional}",
                'pin' => $pin,
                'status' => 1,
                'alamat' => $faker->address(),
                'telp' => $faker->phoneNumber(),
                'email' => $faker->email,
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'tgl_daftar' => $faker->unixTime(),
                'regional' => $regional,
                'tingkat' => $tingkat,
            ];

            $this->db->table('himatik3_me_peserta')->insert($datax);
        }
    }
}
