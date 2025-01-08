<?php

namespace App\Controller\Tests;

use PHPUnit\Framework\TestCase;
use App\Controller\HomeController as HomeController;

class HomeControllerTest extends TestCase
{
    public function testCalcul()
    {
        $this->assertEquals(4, (new HomeController)->calcul(2), "This function is supposed to calculate the number of products");
    }
}