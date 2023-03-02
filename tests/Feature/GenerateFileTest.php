<?php

namespace Tests\Feature;

use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GenerateFileTest extends TestCase
{
    protected $orderService;
    protected $config;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderService = new OrderService();
    }

    public function testGenerateCSV()
    {
        $orders = [
            [
                'delivery_date' => '2023-03-15',
                'street_address' => '1234 Main St',
                'city' => 'Anytown',
                'state' => 'CA',
                'postal_code' => '12345',
                'customer' => 'John Doe',
                'partner_id' => 'partner1',
                'items' => [
                    ['item_id' => '123', 'external_id' => 'ABC', 'quantity' => 2],
                    ['item_id' => '456', 'external_id' => 'DEF', 'quantity' => 1]
                ]
            ]
        ];

        $fileName = $this->orderService->generateCSV($orders);

        // check if the file exists on the SFTP server
        $fileExists = Storage::disk('sftp')->exists($fileName);
        $this->assertTrue($fileExists);
    }
}
