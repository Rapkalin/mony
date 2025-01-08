<?php

namespace App\Tests\Controller\Tests;

use PHPUnit\Framework\TestCase;
use App\Controller\HomeController as MonyHomeController;

class HomeController extends TestCase
{
    public function testCalcul()
    {
        $this->assertEquals(4, (new MonyHomeController)->calcul(2), "This function is supposed to calculate the number of products");
    }
}