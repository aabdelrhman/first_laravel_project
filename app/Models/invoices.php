<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sections;
use App\Models\invoices_details;
use App\Models\invoice_attachments;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function section(){
        return $this -> belongsTo(sections::class , 'section_id' , 'id');
    }

    public function details(){
        return $this -> hasMany(invoices_details::class , 'invoices_id' , 'id') ;
    }

    public function attachment(){
        return $this -> hasMany(invoice_attachments::class , 'invoice_id' , 'id') ;
    }
}
