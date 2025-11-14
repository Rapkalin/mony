<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{

    /**
     * @param string $controller_name
     * @param string[] $extraData
     * @return string[]
     */
    protected function formatData(string $controller_name, array $extraData = []): array
    {
        $data = [
            'controller_name' => $controller_name,
        ];

        if ($extraData) {
            $data = array_merge($data, $extraData);
        }

        return $data;
    }

    protected function getControllerName (): string
    {
        return self::class;
    }
}