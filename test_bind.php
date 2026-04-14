<?php
$s = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (@socket_bind($s, '127.0.0.1', 8000)) {
    echo "Success\n";
} else {
    echo "Fail\n";
}
