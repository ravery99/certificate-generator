<?php

namespace App\Config;

use Dotenv\Dotenv;

class Config
{
    public const DPI = 171;
    public const DOMAIN = 'http://localhost';
    public const BASE_URL = '/certificate-generator/public';

    // Load .env saat pertama kali class digunakan
    public static function load()
    {
        static $loaded = false; // Variabel static untuk memastikan hanya dipanggil sekali
        if (!$loaded) {
            $dotenv = Dotenv::createImmutable(__DIR__ . "/../../"); // Sesuaikan path
            $dotenv->load();
            $loaded = true;
        }
    }

    public static function get(string $key)
    {
        self::load(); // Pastikan .env sudah diload
        // var_dump(getenv('DB_USER'));
        // var_dump($_ENV['DB_USER']);
        // var_dump($_SERVER['DB_USER']);
        // exit;

        $defaults = [
            'DB_HOST' => 'localhost',
            'DB_USER' => 'user',
            'DB_PASS' => 'password',
            'DB_NAME' => 'certificate_generator_db',
            'DB_PORT' => '5432',
        ];

        return $_ENV[$key] ?? $_SERVER[$key] ?? $defaults[$key] ?? null;
    }
}
