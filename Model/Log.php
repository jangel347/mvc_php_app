<?php
class Log
{

    static function write($text)
    {
        $file = fopen('log/log.txt', 'a');
        fputs($file, "/*-----------------------------------------------------------*/\n");
        fputs($file, $text . "\n");
        fputs($file, "/*-----------------------------------------------------------*/\n");
        fclose($file);
    }
}
