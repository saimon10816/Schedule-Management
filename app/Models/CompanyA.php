<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyA extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'postSite', 'guardName', 'shiftStart', 'shiftEnd', 'totalHour', 'remarks'];

    public static function last()
    {
        return self::latest()->first();
    }

}
