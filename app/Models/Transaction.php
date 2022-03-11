<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    public $timestamps = false; 

    protected $fillable = ['vin','car_name','phone','email','link','docs_name','status_payment','id_user','created_date','updated_date'];
}
