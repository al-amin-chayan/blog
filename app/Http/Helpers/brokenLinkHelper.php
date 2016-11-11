<?php

/**
 * Check if a link is broken
 *
 * @param  string $url
 *
 * @return bool
 */

if (function_exists('curl_version')) {

    function url_exists($url) {
        $ch = @curl_init($url);
        @curl_setopt($ch, CURLOPT_HEADER, TRUE);
        @curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $status = array();
        preg_match('/HTTP\/.* ([0-9]+) .*/', @curl_exec($ch), $status);
        return ($status[1] == 200);
    }

} else {

    function url_exists($url) {
        $h = get_headers($url);
        $status = array();
        preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0], $status);
        return ($status[1] == 200);
    }

}