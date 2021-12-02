<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\invoices;

class sections extends Model
{
    protected $fillable = ['section_name' , 'description' , 'Created_by'];
    public  $timestamps = true ;

    public function products(){
        return $this -> hasMany('products' , 'section_id' , 'id');
    }

    public function invoices(){
        return $this -> hasMany(invoices::class , 'section_id' , 'id');
    }
}


