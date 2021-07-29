<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class Transaction extends Model
{
    use Uuids;
    use SoftDeletes;
    protected $guarded = [];
    protected $keyType = 'string';
    protected $dateFormat = 'Y-m-d H:i:s.u';
    public $incrementing = false;
    use HasFactory;
}
