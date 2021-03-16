<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['book_category_id','title','description','pages','author','isbn','publisher','price','rating','shopee_link','photo','date_published','created_at','updated_at'];
    public $timestamps=FALSE;

    public function bookcategory() {
        return $this->belongsTo('App\BookCategory','book_category_id','id');
    }
}
