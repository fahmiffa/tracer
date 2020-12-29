<?php

if (!function_exists('getSegment')) {

    /**
     * Returns segment value for given segment number or false.
     *
     * @param int $number The segment number for which we want to return the value of
     *
     * @return string|false
     */
    function getSegment(int $number)
    {
        $request = \Config\Services::request();

        if ($request->uri->getTotalSegments() >= $number && $request->uri->getSegment($number)) {
            return $request->uri->getSegment($number);
        } else {
            return false;
        }
    }
}

function pad($tr, $str)
{
    return str_pad($str, 50, $tr, STR_PAD_LEFT);
}
function string_align($name = '', $price = '', $dollarSign = false)
{
    $rightCols = 8;
    $leftCols = 28;
    if ($dollarSign) {
        $leftCols = $leftCols / 2 - $rightCols / 2;
    }
    $left = str_pad($name, $leftCols);

    $price = number_format($price, 0, ',', '.');

    $sign = ($dollarSign ? 'Rp. ' : '');
    $right = str_pad($sign . $price, $rightCols, ' ', STR_PAD_LEFT);
    return "$left$right\n";
}

// Format tangal ke dd-mm-yyyy
function date_to_id($tanggal)
{
    $tgl = date('d-m-Y', strtotime($tanggal));
    if ($tgl == '01-01-1970') {
        return '';
    } else {
        return $tgl;
    }
}

function role($data)
{
    if ($data == 1) {
        return 'Admin';
    } else {
        return 'Karyawan';
    }
}

function temp($data)
{
    if ($data == 1) {
        return $data;
    } else {
        return 'Aktif Client';
    }
}


function trans_date($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
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
    );

    $split1   = explode(' ', $tanggal);
    $split    = explode('-', $split1[0]);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo . ' ' . $split1[1];
}

function dtime($waktu, $m, $string)
{
    $date = date_create($waktu);
    date_add($date, date_interval_create_from_date_string($m . ' ' . $string));
    return date_format($date, 'Y-m-d');
}

function datetime_to_id($tanggal)
{

    date_default_timezone_set('Asia/Jakarta');
    $date = new DateTime($tanggal);
    return $date->format('d-m-Y  H:i:s'); // 21-01-2017 05:13:03

}

// Format tangal ke dd-mm-yyyy
function date_to_in($tanggal)
{
    $tgl = date('Y-m-d', strtotime($tanggal));
    if ($tgl == '1970-01-01') {
        return '';
    } else {
        return $tgl;
    }
}

//format rupiah
function format_rp($rp)
{
    return number_format($rp, 0, ',', '.');
}

//format standar, remove rp
function format_num($data)
{
    $data1 = str_replace('Rp ', '', $data);
    return str_replace(".", "", $data1);
}


function status($da)
{
    if ($da == 0) {
        return 'Belum bekerja';
    } else if ($da == 1) {
        return 'Bekerja';
    } else {
        return 'Berwirausaha';
    }
}
