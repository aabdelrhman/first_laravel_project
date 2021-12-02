<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\invoices;

class invoice_attachments extends Model
{
    protected $guarded = [];

    public function invoice(){
        return $this -> belongsTo(invoices::class , 'invoice_id' , 'id');
    }
}
