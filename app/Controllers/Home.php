<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\RegionalModel;
use CodeIgniter\Config\Config;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Mathematics Event - Himatika FMIPA Unhas',
			'page' => 'Home ME',
			'image' => $this->getImages(),
		];

		echo view('template/header', $data);
		echo view('template/home');
		echo view('template/galeri');
		echo view('template/alur_lomba');
		echo view('template/alur_daftar');
		echo view('template/deskripsi');
		echo view('template/footer');
	}

	public function login()
	{
		return view('dashboard/login');
	}

	public function getLogin()
	{
		$peserta = new PesertaModel();
		$data = [
			'pin' => $this->request->getPost('pin'),
			'password' => $this->request->getPost('password')
		];
		// Admin
		$pin = '11041983';
		$pass = '123';
		$level = 'admin';

		$login = $peserta->check_pin($data['pin']);

		if ($data['pin'] == $pin & $data['password'] == $pass) {
			session()->set('name', 'Admin Mathematics Event');
			session()->set('level', 'admin');
			return redirect()->to(base_url('/peserta'));
		}
		if ($login) {
			if (password_verify($data['password'], $login->password)) {
				// session()->set(json_decode($login));
				// dd((array)$login);
				$data = [
					'id' => $login->id,
					'name' => $login->namaLengkap,
					'level' => 'peserta',
					'kelamin' => $login->kelamin,
					'namaSekolah' => $login->namaSekolah,
					'pin' => $login->pin,
					'status' => $login->status,
					'alamat' => $login->alamat,
					'telp' => $login->telp,
					'email' => $login->email,
					'regional' => $login->regional,
					'tingkat' => $login->tingkat,
				];
				session()->set($data);
				return redirect()->to(base_url('/peserta_info'));
			}
		}
		session()->setFlashdata('loginfail', 'Pin Atau Password Anda Salah');
		return redirect()->to(base_url('/login'));
	}

	public function register()
	{
		$peserta = new PesertaModel();
		$regional = new RegionalModel();
		$rules = $peserta->validationRules;
		$tingkat = ['SD', 'SMP', 'SMA'];
		$data = [
			'regional' => $regional->getAll(),
			'tingkat' => $tingkat,
			'page' => 'Register',
		];
		if ($this->request->getMethod() == 'post') {
			if (!$this->validate($rules)) {
				$data['errors'] = $this->validator->getErrors();
				return view('dashboard/register', $data);
			} else {
				$pin = random_string('numeric', 8);
				while ($peserta->check_pin($pin)) {
					$pin = random_string('numeric', 8);
				}
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
					'regional' => $this->request->getPost('regional'),
					'tingkat' => $this->request->getPost('tingkat'),
				];
				$send = [
					'name' => $data['namaLengkap'],
					'email' => $data['email'],
					'pin' => $pin
				];
				// dd($data);
				// $this->sendEmail($send);
				$peserta->insert_peserta($data);
				session()->setFlashdata('insert_success', 'Anda Berhasil Terdaftar, Silahkan Cek Email Anda Untuk Mengetahui Pin Login Anda');
				return redirect()->to(base_url('/home/login'));
			}
		}
		return view('dashboard/register', $data);
	}

	private function sendEmail($data)
	{
		// $template = view('dashboard/template/email_template', $data);
		$email = \Config\Services::email();
		$email->setTo($data['email']);

		$template = view('dashboard/template/email_template', $data);

		$email->setSubject('Pin Login Mathematics Event');
		$email->setMessage($template);

		if ($email->send()) {
			// echo 'Hore';
		} else {
			echo $email->printDebugger();
		}
	}

	private static function getImages()
	{
		$fields = "media_url,media_type";
		$token = env('apikey.instagram.matheventxx');
		$url = "https://graph.instagram.com/me/media?access_token={$token}&fields={$fields}";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$resultx = curl_exec($curl);
		curl_close($curl);
		$result = json_decode($resultx, true);
		$images = [];
		$n = 9;
		$i = 0;
		if (isset($result['error'])) {
			return false;
		}
		while ($n > 0) {
			if ($result["data"][$i]["media_type"] != "VIDEO") {
				array_push($images, $result["data"][$i]["media_url"]);
				$n -= 1;
			}
			$i += 1;
		}
		return $images;
	}
}
