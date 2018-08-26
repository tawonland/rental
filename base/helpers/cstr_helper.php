<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function to_dmY($tgl = '', $delimiter = '/')
{
    if (empty($tgl)){
        return NULL;
    }

    $y = explode('-', $tgl);
    return $y[2].$delimiter.$y[1].$delimiter.$y[0];
}

function to_money($str = '0'){
    return number_format($str, '2', '.', ',');
}

function status_expenses(){

    $status = array();
    $status[0] = 'Belum Realisasi';
    $status[1] = 'Sudah Realisasi';
    
    return $status;
}

function tgl_indo($tgl = '')
    {
        if (empty($tgl)){
            return NULL;
        }

        $bulan = array (
            0 => '00',
            1 => 'Januari',
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
        $x = explode(' ', $tgl);
        $y = explode('-', $x[0]);
        return $y[2].' '.$bulan[(int)$y[1]].' '.$y[0];
    }