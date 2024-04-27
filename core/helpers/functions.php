<?php
function debug($data)
{
    $debugInfo = debug_backtrace()[0];
    $fileName = basename($debugInfo['file']);
    $lineNumber = $debugInfo['line'];

    echo '<pre>File: ' . $fileName . "\n";
    echo 'Line: ' . $lineNumber . "\n";
    echo 'Value: ' . print_r($data, true) . '</pre>';
}