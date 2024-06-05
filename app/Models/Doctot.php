<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctot extends Model
{
    use HasFactory;
<<<<<<< HEAD
}
=======

    protected $fillable ={
    'doc_id',
    'category',
    'experience',
    'bio_data',
    'status',
    }

    public function user(){
    return $this->belongsTo(User::class);
    }
>>>>>>> f52237c (versão 1.1)
