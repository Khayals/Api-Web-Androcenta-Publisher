<?php

namespace App\Http\Controllers\Book;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetAllController extends Controller
{
    public function __invoke()
    {
        $book=Book::with(['bookcategory'])->get();
        return $this->response()->successData('success get all data book','data',$book);
    }
}
