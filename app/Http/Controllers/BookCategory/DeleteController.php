<?php

namespace App\Http\Controllers\BookCategory;

use App\BookCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function __invoke($id)
    {
        if (!$bookCategory=BookCategory::find($id)) {
            return $this->response()->failMessage(404,'book category not found');
        }

        $bookCategory->delete();
        return $this->response()->successMessage('success delete book category');
    }
}
