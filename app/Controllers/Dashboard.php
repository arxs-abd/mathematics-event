<?php

namespace App\Controllers;

use App\Models\PengaturanModel;
use App\Models\PesertaModel;
use App\Models\RegionalModel;
use Dompdf\Dompdf;
use Exception;

class Dashboard extends BaseController
{

    public function __construct()
    {
        helper('text');
        $this->token = random_string('sha1');
        session()->set('csrf_token', $this->token);
    }

    public function index()
    {
        if (session()->get('level') == 'peserta') {
            session()->setFlashdata('fail', 'Anda Tidak Boleh Mengakses Halaman Tersebut');
            return redirect()->to(base_url('/peserta_info'));
        }


        $peserta = new PesertaModel();
        $regional = new RegionalModel();
        $data = [
            'title' => 'Peserta - Mathematics Event - Himatika FMIPA Unhas',
            'page' => 'Peserta',
            'peserta' => $peserta->getAll(),
            'regional' => $regional->findAll(),
            'tingkat' => ['SD', 'SMP', 'SMA'],
            'token' => $this->token
        ];
        return view('dashboard/peserta', $data);
    }

    public function regional()
    {
        if (session()->get('level') == 'peserta') {
            session()->setFlashdata('fail', 'Anda Tidak Boleh Mengakses Halaman Tersebut');
            return redirect()->to(base_url('/peserta_info'));
        }

        $regional = new RegionalModel();
        $data = [
            'title' => 'Regional - Mathematics Event - Himatika FMIPA Unhas',
            'page' => 'Regional',
            'regional' => $regional->findAll(),
            'token' => $this->token,
        ];
        return view('dashboard/regional', $data);
    }

    public function statistik()
    {
        if (session()->get('level') == 'peserta') {
            session()->setFlashdata('fail', 'Anda Tidak Boleh Mengakses Halaman Tersebut');
            return redirect()->to(base_url('/dashboard/peserta_info'));
        }

        $data = [
            'title' => 'Statistik - Mathematics Event - Himatika FMIPA Unhas',
            'page' => 'Statistik',
        ];
        return  view('dashboard/statistik', $data);
    }

    public function pesertaInfo()
    {
        // Midtrans
        \Midtrans\Config::$serverKey = env('midtrans.server.key');

        // Uncomment for production environment
        // \Midtrans\Config::$isProduction = true;

        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Info
        // $status = \Midtrans\Transaction::status('ME-XX-1574296329');
        // dd($status->transaction_status);
        // $transaction = array(
        //     'transaction_details' => array(
        //         'order_id' => rand(),
        //         'gross_amount' => 10000 // no decimal allowed
        //     )
        // );

        $pesertaModel = new PesertaModel();
        $peserta = $pesertaModel->find(session('id'));
        $harga = getHarga($peserta['regional'], strtolower($peserta['tingkat']));

        $transaction = [
            'transaction_details' => [
                'order_id' => 'ME-XX-' . strtoupper($peserta['regional']) . '-' . $peserta['pin'],
                'gross_amount' => $harga + 5000,
            ],
            'item_details' => [
                [
                    'id' => 'ME-BIAYA-PENDAFTARAN-' . $peserta['regional'],
                    'price' => $harga,
                    'quantity' => 1,
                    'name' => 'Biaya Pendaftaran Regional ' . $peserta['regional'] . ' Tingkat ' . $peserta['tingkat'],
                ],
                [
                    'id' => 'ME-BIAYA-ADMINISTRASI',
                    'price' => 5000,
                    'quantity' => 1,
                    'name' => 'Biaya Administrasi',
                ],
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($transaction);

        $peserta = new PesertaModel();
        $data = [
            'title' => session()->get('name') . ' - Mathematics Event - Himatika FMIPA Unhas',
            'page' => 'Peserta Info',
            'field' => ['Nama Lengkap', 'Jenis Kelamin', 'Nama Sekolah', 'Pin', 'Status',  'Alamat', 'Telp', 'Email', 'Regional/Tingkat'],
            'peserta' => $peserta->find(session()->get('id')),
            'snapToken' => $snapToken,
        ];
        return view('dashboard/peserta_info', $data);
    }
    public function editPesertaInfo()
    {
        if (session()->get('level') == 'admin') {
            session()->setFlashdata('fail', 'Anda Tidak Boleh Mengakses Halaman Tersebut');
            return redirect()->to(base_url('/dashboard'));
        }
        $peserta = new PesertaModel();
        $regional = new RegionalModel();
        $data = [
            'title' => session()->get('name') . ' - Mathematics Event - Himatika FMIPA Unhas',
            'page' => 'Edit Peserta',
            'field' => ['Nama Lengkap', 'Jenis Kelamin', 'Nama Sekolah', 'Pin', 'Status',  'Alamat', 'Telp', 'Email', 'Regional/Tingkat'],
            'peserta' => $peserta->find(session()->get('id')),
            'regional' => $regional->findAll(),
            'tingkat' => ['SD', 'SMP', 'SMA'],
            'token' => $this->token,
        ];
        return view('dashboard/edit_peserta_info', $data);
    }

    public function pembayaran()
    {
        $data = [
            'title' => 'Pembayaran',
            'page' => 'Pembayaran'
        ];

        return view('dashboard/pembayaran', $data);
    }

    public function pengaturan()
    {
        $pengaturan = new PengaturanModel();
        $data = [
            'title' => 'Pengaturan',
            'page' => 'Pengaturan',
            'setting' => $pengaturan->findAll(),
        ];

        // dd($data['setting']);

        return view('dashboard/pengaturan', $data);
    }

    public function editPengaturan()
    {
        $field = ['kegiatan', 'korca'];
        $pengaturan = new PengaturanModel();

        $rules = [
            'namaKegiatan' => 'required',
            'namaKorca' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('fail', 'Gagal Mengedit Pengaturan');
            return redirect()->to(base_url('/pengaturan'));
        }
        $data = [
            [
                'id' => 1,
                'setting' => 'kegiatan',
                'value' => $this->request->getPost('namaKegiatan')
            ],
            [
                'id' => 2,
                'setting' => 'korca',
                'value' => $this->request->getPost('namaKorca')
            ]
        ];
        $pengaturan->updateBatch($data, 'id');
        session()->setFlashdata('success', 'Berhasil Mengedit Pengaturan');
        return redirect()->to(base_url('/pengaturan'));
    }

    public function cetak($pin)
    {
        // dd($this->request);
        $pengaturan = new PengaturanModel();
        $setting = $pengaturan->findAll();
        $title = strtoupper($setting[0]['value']);
        $pesertaModel = new PesertaModel();
        $peserta = $pesertaModel->check_pin($pin);
        $tgl_daftar = tgl_indo($peserta->tgl_daftar);
        if ($peserta) {
            if ($peserta->status != 3) {
                if ($peserta->status == 2) {
                    session()->setFlashdata('fail', 'Silahkan Selesaikan Proses Verifikasi Terlebih Dahulu');
                }
                if ($peserta->status == 1) {
                    session()->setFlashdata('fail', 'Silahkan Lakukan Proses Pembayaran Terlebih Dahulu');
                }
                return redirect()->to(base_url('/peserta'));
            }
            if (session()->get('level') == 'peserta') {
                if (session()->get('pin') != $pin) {
                    session()->setFlashdata('fail', 'Anda Tidak Bisa Mencetak Kartu Peserta');
                    return redirect()->to(base_url('/peserta_info'));
                }
            }
            $timeNow = tgl_indo(time());
            $template = <<< HTML
                <div border="1" style="text-align: center; border: solid 1px black; font-family: Helvetica; position : relative;">
                    <table align="center" cellspacing="3" cellpadding="4" style="padding-top : 10px; padding-bottom : 5px; left : 20%; transform: translateX(-3px); z-index : 10;">
                        <tr>
                            <td style="text-align: center;"><img src="assets/img/logo/himatika-logo.png" alt="Logo Himatika FMIPA Unhas" width="80" border="0" align="middle"></td>
                            <th style="text-align: center; font-size:x-large;" colspan="2"><b>PANITIA {$title} <br>Himatika FMIPA Unhas</b></th>
                            <td style="text-align: center"><img src="assets/img/logo/me-logo.png" alt="Logo Mathematis Event Himatika FMIPA Unhas" width="80" border="0" align="middle"></td>
                        </tr>
                        <tr>
                            <th style="text-align:center" colspan="4"><b>BUKTI PENDAFTARAN ONLINE PESERTA</b></th>
                        </tr>
                        <tr style="background-color: #EAECEE;">
                            <td>Nomor Peserta</td>
                            <td colspan="2">Nama Regional</td>
                            <td>Tanggal Daftar</td>
                        </tr>
                        <tr style="background-color: #EAECEE;">
                            <td>12309812</td>
                            <td colspan="2">{$peserta->regional}</td>
                            <td>{$tgl_daftar}</td>
                        </tr>
                        <tr>
                            <td colspan="4"><br></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td colspan="3">: {$peserta->namaLengkap} </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td colspan="3">: {$peserta->kelamin}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td colspan="3">: {$peserta->alamat}</td>
                        </tr>
                        <tr>
                            <td>Asal Sekolah</td>
                            <td colspan="3">: {$peserta->namaSekolah}</td>
                        </tr>
                        <tr>
                            <td colspan="4"><br></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;" colspan="4">Makassar, {$timeNow}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;" colspan="4"><br><br><br></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;" colspan="4"> {$setting[1]['value']} </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;" colspan="4">Panitia {$setting[0]['value']}</td>
                        </tr>
                    </table>
                </div>
            HTML;
            $pdf = new Dompdf();
            $pdf->load_html($template);
            $pdf->setPaper('A4');
            $pdf->render();
            return $pdf->stream("{$peserta->namaLengkap}_{$peserta->pin}.pdf", ['Attachment' => false]);
        }
        session()->setFlashdata('fail', 'Tidak Ada Peserta yang Mempunyai Pin Tersebut');
        return redirect()->to(base_url('/peserta'));
    }

    public function pay()
    {
        \Midtrans\Config::$serverKey = env('midtrans.server.key');

        // Uncomment for production environment
        // \Midtrans\Config::$isProduction = true;

        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        // dd('jalan');
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            // Redirect to Snap Payment Page
            header('Location: ' . $paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function logout()
    {
        session()->setTempdata('name');
        session()->setTempdata('role');
        session()->setTempdata('csrf_token');
        session()->remove(['name', 'role', 'csrf_token']);
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }
}
