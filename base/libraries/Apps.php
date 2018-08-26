<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Apps
{
    private $js = '';
    private $css = '';

    public function set_js($js = '')
    {
        $this->js = $js;
    }

    public function get_js()
    {
        return $this->js;
    }

    public function set_css($css = '')
    {
        $this->css = $css;
    }

    public function get_css()
    {
        return $this->css;
    }

    public function tgl_indo($tgl = '')
    {
        $bulan = array (
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

    public function to_date($tgl = '')
    {
        $y = explode('/', $tgl);
        return $y[2].'-'.$y[1].'-'.$y[0];
    }

}