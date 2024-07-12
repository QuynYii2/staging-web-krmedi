<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AhaOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        '_id',
        'supplier_id',
        'shared_link',
        'path',
        'status'
    ];
}
