<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    public $fillable =['sender_id','reciever_id','read','text','attachment','from','sent_at'];
}
