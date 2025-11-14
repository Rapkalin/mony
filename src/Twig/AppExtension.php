<?php

namespace App\Twig;

use Twig\Attribute\AsTwigFunction;

class AppExtension
{
    #[AsTwigFunction('packageVersion')]
    public function getPackageVersion(): string
    {
        $path = dirname(__DIR__, 2) . '/package.json';

        if (!file_exists($path)) {
            return 'unknown';
        }

        $package = json_decode(file_get_contents($path), true);

        return $package['version'] ?? 'unknown';
    }
}
