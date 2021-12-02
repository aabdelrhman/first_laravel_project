<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sections;

class products extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ['id' , 'product_name' , 'description' , 'section_id' , 'created_at' , 'updated_at'];
    protected $hidden = ['created_at' , 'updated_at'];

    public function section(){
        return $this -> belongsTo(sections::class,'section_id','id');
    }
}
