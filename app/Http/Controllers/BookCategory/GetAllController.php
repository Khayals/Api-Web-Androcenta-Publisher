<?php

namespace App\Http\Controllers\BookCategory;

use App\BookCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetAllController extends Controller
{
    public function __invoke()
    {
        $bookCategory=BookCategory::all();
        return $this->response()->successData('success get all book category','data',$bookCategory);
    }
}
