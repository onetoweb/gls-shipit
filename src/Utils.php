<?php

namespace Onetoweb\Gls\Shipit;

/**
 * Utils.
 */
final class Utils
{
    /**
     * @param string $filename
     * @param string $data
     * 
     * @return bool
     */
    public static function writeLabel(string $filename, string $data): bool
    {
        $binary = base64_decode($data, true);
        
        return (file_put_contents($filename, $binary) !== false);
    }
}