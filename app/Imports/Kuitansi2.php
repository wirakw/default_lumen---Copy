<?php

namespace App\Imports;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class Kuitansi2 implements ToModel, WithCalculatedFormulas
{
    public function model(array $row)
    {
        return new Transaction([
            'channel_order_id' => "${row[1]}",
            'channel_name' => $row[8],
            'order_date' => $row[2],
            'total' => $row[6],
        ]);
    }
    
    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'channel_order_id';
    }
}
