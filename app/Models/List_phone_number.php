<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_phone_number extends Model
{
    use HasFactory;

    protected $table = 'list_phone_number';
    protected $primaryKey = 'id';
    public $timestamps = false; 

    protected $fillable = ['phone','car_name','created_date','updated_date'];

}
