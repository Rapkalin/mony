<?php

namespace App\Tests\Controller\Tests;

use PHPUnit\Framework\TestCase;
use App\Controller\ItemController as MonyItemController;


class ItemController extends TestCase
{
    public function testCalculate()
    {
        $this->assertEquals(4, (new MonyItemController())->calculate(2), "This function is supposed to calculate the blabla of products");

    }
}