<?php

function isLogin()
{
    return !is_null(session()->get('name'));
}

function getMenu($role)
{
    $menu_role = [
        // Menu Untuk Admin
        'admin' => [
            [
                'menu_name' => 'Peserta',
                'icon' => 'fas fa-fw fa-users',
                'url' => '/peserta'
            ],
            [
                'menu_name' => 'Regional',
                'icon' => 'fas fa-fw fa-search-location',
                'url' => '/regional'
            ],
            [
                'menu_name' => 'Pembayaran',
                'icon' => 'fas fa-fw fa-wallet',
                'url' => '/pembayaran'
            ],
            [
                'menu_name' => 'Statistik',
                'icon' => 'far fa-fw fa-chart-bar',
                'url' => '/statistik'
            ],
            [
                'menu_name' => 'Pengaturan',
                'icon' => 'fas fa-fw fa-cog',
                'url' => '/pengaturan'
            ]
        ],
        // Menu Untuk Peserta
        'peserta' => [
            [
                'menu_name' => 'Peserta Info',
                'icon' => 'fas fa-fw fa-user',
                'url' => '/peserta_info'
            ],
            [
                'menu_name' => 'Edit Peserta',
                'icon' => 'fas fa-fw fa-user-edit',
                'url' => '/edit_peserta'
            ],
            [
                'menu_name' => 'Kartu Peserta',
                'icon' => 'fas fa-fw fa-id-card',
                'url' => '/kartu_peserta'
            ]
        ]
    ];
    return $menu_role[$role];
}

function generateFlashData($type, $msg)
{
    if ($type == 'error') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    } else if ($type == 'success') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }

    // echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
    //             ' . $msg . '
    //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //                 <span aria-hidden="true">&times;</span>
    //             </button>
    //         </div>';
}

function generateFlashDataV2($type, $msg)
{
    echo '<div class="alert alert-' . $type . '" role="alert">'
        . $msg .
        '</div>';
}

function getStatus($status)
{
    if ($status == 1) {
        return '<span class="badge badge-pill badge-danger p-2"> Belum Verifikasi </span>';
    }
    if ($status == 2) {
        return '<span class="badge badge-pill badge-warning p-2"> Sedang Verifikasi </span>';
    }
    if ($status == 3) {
        return '<span class="badge badge-pill badge-success p-2"> Sudah Verifikasi </span>';
    }
}

function getDataSekolah($tingkat)
{
    $db = \Config\Database::connect();
    return $db->table('himatik3_me_peserta')->where(['tingkat' => $tingkat])->countAllResults();
}

function tgl_indo($timeFormat)
{
    $format = date('Y-m-d', $timeFormat);
    $month = [
        '',
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    $time = explode('-', $format);
    return " {$time[2]} {$month[(int)$time[1]]} {$time[0]} ";
}

function getHarga($regional, $tingkat)
{
    $db = \Config\Database::connect();
    $id_regional = $db->table('himatik3_me_regional')->getWhere(['regional' => $regional])->getResultArray();
    $harga = $db->table('himatik3_me_harga_regional')->getWhere(['id_regional' => $id_regional[0]['id']])->getResultArray();
    return $harga[0][$tingkat];
}

function get_regional()
{
    $faker = \Faker\Factory::create();
    $db = \Config\Database::connect();
    $reg = $db->table('himatik3_me_regional')->select('regional')->get()->getResult('array');
    return $reg[$faker->numberBetween(0, count($reg) - 1)]['regional'];
}

function get_tingkat()
{
    $faker = \Faker\Factory::create();
    $tingkat = ['SD', 'SMP', 'SMA'];
    return $tingkat[$faker->numberBetween(0, 2)];
}
