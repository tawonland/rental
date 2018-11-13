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

    function getConn($conn = ''){

        if(empty($conn)){
            return $this->load->database('default', TRUE);
        }
        else{
            return $this->load->database($conn, TRUE);
        }

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
     * Mendapatkan key, bisa array, dari konstanta key
     * @param boolean $array
     * @return mixed
     */
    public static function getKey($array = false) {
        return self::getArray(static::key, $array);
    }

    /**
     * Mendapatkan nilai, bisa array
     * @param string $key
     * @param boolean $array
     * @return mixed
     */
    public static function getArray($key, $array = false) {
        $a_key = explode(',', $key);

        foreach ($a_key as $k => $v)
            $a_key[$k] = trim($v);

        if (count($a_key) == 1) {
            if ($array)
                return array($key);
            else
                return $key;
        } else
            return $a_key;
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

    function getCountAll()
    {

        $this->db->select('COUNT(*) as countall');
        $this->db->from($this->getTable());
        
        return $this->db->get()->row()->countall;

    }

    /*
     * Mendapatkan baris data 
     * @param string $conn
     * @paramg string $column = column1, column2, ...
     * @filter string $filter = id = '...'
    */
    function getRows($conn = '', $column = '', $filter = ''){
        
        $conn   = $this->getConn($conn);
        $table  = $this->getTable();

        $query  = $conn->get($table);

        return $query->result_array();
    }

    // function getRowsIdAsKey($conn = '', $column = '', $filter = ''){
        
    //     $rs = $this->getRows($conn, $column, $filter);

    //     $p_key = $this->getKey();

    //     $rows = array();
    //     foreach ($rs as $key => $value) {

    //         $id = $value[$p_key];

    //         $rows[$id] = 
    //     }

    //     return $rows;
    // }

    
}