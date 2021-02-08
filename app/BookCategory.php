<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $table = 'book_categories';
    protected $fillable = ['name','description','photo','created_at','updated_at'];
    public $timestamps=FALSE;
}
