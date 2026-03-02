<?php
session_start();
include 'koneksi.php';

function showMessage($type, $message)
{
    $_SESSION['message'] = [
        'type' => $type,
        'text' => $message
    ];
}
function getMessage()
{
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
    return null;
}
$server_name = $_SERVER['SERVER_NAME'];
$projek_path = '/crud_adminite';

$is_localhost = in_array($server_name, ['localhost', '127.0.0.1']);
if ($is_localhost) {
    define('BASE_URL', 'https://' . $server_name);
} else {
    define('BASE_URL', 'https://' . $server_name);
}
define('ADMIN_LTE', BASE_URL . '/adminlte');
?>
