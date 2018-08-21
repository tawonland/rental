<?php
class Dany_Model extends CI_Model
{

    CONST LABEL = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Pesan error
     * @param boolean $err
     * @param boolean $aksi
     * @param string $msg
     * @return string
     */
    function getErrorMessage($err, $aksi = null, $msg = null) {
        if (!empty($aksi)) {
            switch ($aksi) {
                case 'insert': $aksi = 'ditambah';
                    break;
                case 'update': $aksi = 'diubah';
                    break;
                case 'delete': $aksi = 'dihapus';
                    break;
                case 'save': $aksi = 'disimpan';
                    break;
                case 'restore': $aksi = 'diambil';
                    break;
                default: $default = true;
            }
        } else
            $aksi = 'Operasi';

        if (empty($default))
            $aksi .= static::LABEL;

        return 'Data ' . ($err == '0' ? 'berhasil' : 'gagal') . ' ' .$aksi . (empty($msg) ? '' : ', ' . $msg);
    }
}