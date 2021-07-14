<?php

namespace Tests\Unit;

use App\Services\Terminal;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    private $terminal;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_simple()
    {
        $this->boot();

        $codes = 'BBD';
        $result = 22.165;

        $total = $this->process($codes);

        self::assertEquals($result, $total);
    }

    /**
     * A depends test example.
     *
     * @return void
     */
    public function test_depends()
    {
        $this->boot();

        $codes = 'AAABCDABE';
        $result = 32.34;

        $total = $this->process($codes);

        self::assertEquals($result, $total);
    }

    /**
     * A pax test example.
     *
     * @return void
     */
    public function test_pax()
    {
        $this->boot();

        $codes = 'CCCCCCC';
        $result = 7.975;

        $total = $this->process($codes);

        self::assertEquals($result, $total);
    }

    /**
     * A mixed test example.
     *
     * @return void
     */
    public function test_mixed()
    {
        $this->boot();

        $codes = 'ABCD';
        $result = 14.74;

        $total = $this->process($codes);

        self::assertEquals($result, $total);
    }

    /**
     * A mixed test example.
     *
     * @return void
     */
    public function test_mixed_depends()
    {
        $this->boot();

        $codes = 'ABECDE';
        $result = 16.94;

        $total = $this->process($codes);

        self::assertEquals($result, $total);
    }

    /**
     * @param string $codes
     *
     * @return mixed
     */
    private function process($codes) {
        for ($i = 0; $i < strlen($codes); $i++) {
            $this->terminal->scanProduct($codes[$i]);
        }
        return $this->terminal->calcTotal();
    }

    private function boot () {
        $pricing = [
            'A' => (Object) [
                'name' => 'Product A',
                'price' => (Object) [
                    'amount' => 2,
                    'pax' => 5,
                    'tax' => 10,
                    'pax_amount' => 9
                ]
            ],
            'B' => (Object) [
                'name' => 'Product B',
                'price' => (Object) [
                    'amount' => 10,
                    'tax' => 10
                ]
            ],
            'C' => (Object) [
                'name' => 'Product C',
                'price' => (Object) [
                    'amount' => 1.25,
                    'tax' => 10,
                    'pax' => 6,
                    'pax_amount' => 6
                ]
            ],
            'D' => (Object) [
                'name' => 'Product D',
                'price' => (Object) [
                    'amount' => 0.15,
                    'tax' => 10
                ]
            ],
            'E' => (Object) [
                'name' => 'Product E',
                'price' => (Object) [
                    'amount' => 2,
                    'tax' => 10,
                    'depend_code' => 'B'
                ]
            ]
        ];

        if (!$this->terminal) {
            $this->terminal = new Terminal($pricing);
        }
        else
        {
            $this->terminal->clearProducts();
        }
    }
}
