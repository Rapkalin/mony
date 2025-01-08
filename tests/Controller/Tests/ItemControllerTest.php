<?php

namespace App\Tests\Controller\Tests;

use PHPUnit\Framework\TestCase;
use App\Controller\ItemController as ItemController;


class ItemControllerTest extends TestCase
{
    public function testCalculate()
    {
        $this->assertEquals(4, (new ItemController())->calculate(2), "This function is supposed to calculate the blabla of products");

    }
}