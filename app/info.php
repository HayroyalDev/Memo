<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class info extends Model
{
    public $fillable =['title','body','attachment','uploaded_by'];
    function read(){
        return $this->hasMany(MemoRead::class,'memo_id');
    }

    function user(){
        return $this->belongsTo(User::class,'_to');
    }
}
