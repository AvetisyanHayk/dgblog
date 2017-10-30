<?php
/**
 * Created by PhpStorm.
 * User: Hayk
 * Date: 29/10/2017
 * Time: 22:22
 */

namespace App\Http;


class Tools
{
    public static function convertMultilineToSingleline($multiline)
    {
        $lines = preg_split ('/(\r\n|\n|\r)/m', $multiline);
        $trimmedLines = [];
        foreach($lines as $line) {
            $trimmedLines[] = trim($line);
        }
        if (sizeof($trimmedLines) == 1) {
            return $trimmedLines[0];
        } else {
            $singleline = $trimmedLines[0];
            for ($i = 1; $i < sizeof($trimmedLines); $i++) {
                $singleline .= "%n" . $trimmedLines[$i];
            }
            return $singleline;
        }
    }

    public static function convertSinglelineToMultiline($singleline) {
        $lines = explode('%n', $singleline);
        if (sizeof($lines) == 1) {
            return $lines[0];
        } else {
            $multiline = $lines[0];
            for ($i = 1; $i < sizeof($lines); $i++) {
                $multiline .= "\r\n" . $lines[$i];
            }
            return $multiline;
        }
         
    }
}