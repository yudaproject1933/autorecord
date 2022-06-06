<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';
    protected $primaryKey = 'id';
    public $timestamps = false; 

    protected $fillable = ['phone','car_name','price','id_employee','created_date','updated_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_employee', 'id');
    }
}
