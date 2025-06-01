<?php

namespace App\Tests\Controller\Tests;

use PHPUnit\Framework\TestCase;
use App\Controller\ExpenseController as MonyExpenseController;


class ExpenseController extends TestCase
{
    public function testCalculate()
    {
        $this->assertEquals(4, (new MonyExpenseController())->calculate(2), "This function is supposed to calculate the blabla of products");

    }
}