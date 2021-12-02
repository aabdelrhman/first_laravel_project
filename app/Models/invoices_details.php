<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\invoices ;

class invoices_details extends Model
{
    protected $guarded = [];

    /**
     * Get all of the comments for the invoices_details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoice()
    {
        return $this->belongsTo(invoices::class, 'invoices_id', 'id');
    }
}
