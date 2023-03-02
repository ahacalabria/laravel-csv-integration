<?php
namespace App\Services;

use App\Contracts\CsvGeneratorInterface;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemException;
use PhpParser\Node\Expr\Throw_;

class OrderService implements CsvGeneratorInterface
{
    protected $sftp;

    public function __construct()
    {
        $this->sftp = Storage::disk('sftp');
    }

    public function generateCSV($orders)
    {
        $fileName = 'Orders/' . date('Ymd_His') . '.csv';
        $csvContent = '';
        
        foreach ($orders as $order) {
            $csvContent .= $order['delivery_date'] . ',' .
                        $order['street_address'] . ',' .
                        $order['city'] . ',' .
                        $order['state'] . ',' .
                        $order['postal_code'] . ',' .
                        $order['customer'] . ',' .
                        $order['items'][0]['item_id'] . ',' .
                        $order['items'][0]['quantity'] . "\n";
            for ($i = 1; $i < count($order['items']); $i++) {
                $csvContent .= ",,,,,,," .
                        $order['items'][$i]['item_id'] . ',' .
                        $order['items'][$i]['quantity'] . "\n";
            }
        }
        
        try {
            Storage::disk('sftp')->put($fileName, $csvContent);
        } catch (FilesystemException $e) {
            Throw($e);
            // handle the exception here
            // for example, throw a custom exception or log the error
        }
        
        return $fileName;
    }
}
