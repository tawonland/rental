<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Manajemen session aplikasi web
 */
class SessionManager {

    const INDEX = 'rental';

    /**
     * Mendapatkan data session
     * @param string $index
     * @return mixed
     */
    protected static function get($index) {
        return $_SESSION[self::INDEX][$index];
    }

    /**
     * Cek apakah sudah login
     * @return bool
     */
    public static function isAuthenticated() {
        $auth = self::get('auth');

        return empty($auth['isauthenticated']) ? FALSE : TRUE;
    }
 
    /**
     * Mendapatkan username
     * @return string
     */
    public static function getUserName() {
        $auth = self::get('auth');

        return $auth['username'];
    }

    /**
     * Menghapus data session
     */
    public static function destroy() {
        unset($_SESSION[self::INDEX]);
    }

}
