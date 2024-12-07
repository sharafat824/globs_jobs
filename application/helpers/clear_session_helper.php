
<?php

if (!function_exists('set_no_cache_headers')) {
    function set_no_cache_headers() {
        $CI =& get_instance();
        $CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $CI->output->set_header('Pragma: no-cache');
    }
}
?>