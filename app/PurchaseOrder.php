<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;
    protected $table = 'purchase_order';
    protected $fillable = ['nama', 'alamat', 'barang', 'bayar', 'keterangan'];


}
