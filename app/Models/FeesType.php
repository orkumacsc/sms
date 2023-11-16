<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesType extends Model
{
    use HasFactory;

    protected $guarded = []; 
    
    public function totalFees($ClassFees){
        $total = 0;
        foreach ($ClassFees as $key => $ClassFee) {
            $fees = FeeTypes::select('fee_group_id', 'fee_amount')->where('fee_group_id', 'ClassFee.fee_group_id')-first();

            $total += $fees->fee_amount;

            dd($total);
        };

        return $total;
    }
}
