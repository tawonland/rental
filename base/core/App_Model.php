<?php
class App_Model extends Dany_Model
{

    CONST SCHEMA    = NULL;
    CONST TABLE     = NULL;
    CONST SEQUENCE  = NULL;
    CONST KEY       = NULL;
    CONST VALUE     = NULL;
    CONST ORDER     = NULL;
    CONST LABEL     = NULL;
    // UNTUK PAGING
    CONST NAV = 3;
    CONST LIMIT = 10;
    CONST FINDLIMIT = 20;

    public function __construct()
    {
        parent::__construct();
    }

    function getSchema() {
        global $conf;

        $schema = static::SCHEMA;
        if (empty($schema) and ! empty($conf['db_dbschema']))
            $schema = $conf['db_dbschema'];

        return $schema;
    }

    function getTable($table = null) {
        if (empty($table))
            $table = static::TABLE;

        $schema = static::getSchema();
        if (empty($schema))
            return $table;
        else
            return $schema . '.' . $table;
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