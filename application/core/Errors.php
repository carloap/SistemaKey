<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

/* Class to handle errors
 */

Class Errors {

    var $ob_level;
    
    public function show_404($message, $heading) {
        echo $this->show_error($message, 404, $heading, 'error_404');
        exit;
    }
    
    public function show_error($message, $status_code = 500, $heading, $template = 'error_500') {
        $this->status_error($status_code);

        $message = '<p>' . implode('</p><p>', (!is_array($message)) ? array($message) : $message) . '</p>';

        if (ob_get_level() > $this->ob_level + 1) {
            ob_end_flush();
        }
        ob_start();
        include APPPATH . 'errors/' . $template . '.php'; // transport the 'heading' and 'message' variables to inside of file
        $buffer = ob_get_contents();
        ob_end_clean(); // Empties the buffer and closes it - No output is sent
        return $buffer;
    }

    public static function status_error($code = 200) {
        $text = '';
        $ncode = array(
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );
        if (isset($ncode[$code])) {
            $text = $ncode[$code];
        }
        header('HTTP/1.0 ' . $code . ' ' . $text, TRUE, $code);
    }

}
