<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestQuote extends Model
{
    // Insert data in Database
    protected $fillable = [
        'name', 'phone', 'email', 'req_service', 'quote_message'
    ];
}
