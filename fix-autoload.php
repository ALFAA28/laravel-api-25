<?php

/**
 * Fix autoloader to include App namespace
 * This script is run after composer dump-autoload to ensure App namespace is included
 */

$baseDir = dirname(__FILE__);
$autoloadPsr4 = $baseDir . '/vendor/composer/autoload_psr4.php';
$autoloadStatic = $baseDir . '/vendor/composer/autoload_static.php';

// Fix autoload_psr4.php
if (file_exists($autoloadPsr4)) {
    $content = file_get_contents($autoloadPsr4);

    // Check if App namespace already exists
    if (strpos($content, "'App\\\\'") === false) {
        $content = str_replace(
            "return array(",
            "return array(\n    'App\\\\' => array(\$baseDir . '/app'),\n    'Database\\\\Factories\\\\' => array(\$baseDir . '/database/factories'),\n    'Database\\\\Seeders\\\\' => array(\$baseDir . '/database/seeders'),",
            $content
        );
        file_put_contents($autoloadPsr4, $content);
    }
}

// Fix autoload_static.php
if (file_exists($autoloadStatic)) {
    $content = file_get_contents($autoloadStatic);

    // Check if App namespace already exists in prefixLengthsPsr4
    if (strpos($content, "'App\\\\' => 4") === false) {
        // Add to prefixLengthsPsr4
        $content = preg_replace(
            '/public static \$prefixLengthsPsr4 = array\s*\(/',
            "public static \$prefixLengthsPsr4 = array(\n        'A' => \n        array (\n            'App\\\\\\\\' => 4,\n            'Database\\\\\\\\Factories\\\\\\\\' => 20,\n            'Database\\\\\\\\Seeders\\\\\\\\' => 19,\n        ),",
            $content
        );

        // Add to prefixDirsPsr4
        $content = preg_replace(
            '/public static \$prefixDirsPsr4 = array\s*\(/',
            "public static \$prefixDirsPsr4 = array(\n        'App\\\\\\\\' => \n        array (\n            0 => __DIR__ . '/../../app',\n        ),\n        'Database\\\\\\\\Factories\\\\\\\\' => \n        array (\n            0 => __DIR__ . '/../../database/factories',\n        ),\n        'Database\\\\\\\\Seeders\\\\\\\\' => \n        array (\n            0 => __DIR__ . '/../../database/seeders',\n        ),",
            $content
        );

        file_put_contents($autoloadStatic, $content);
    }
}
