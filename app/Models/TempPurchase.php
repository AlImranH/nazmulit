<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPurchase extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_no', 'supplier_id', 'date'];
}
