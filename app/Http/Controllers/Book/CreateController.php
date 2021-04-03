<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\BookCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use JD\Cloudder\Facades\Cloudder;
use Validator;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'book_category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'pages' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'publisher' => 'required',
            'price' => 'required',
            'rating' => 'required',
            'shopee_link' => 'required',
            'photo'=>'required|max:2000|mimes:jpg,png,jpeg'
        ]);

        if($validator->fails()){
            return $this->response()->failMessage(422,$validator->errors()->all());
        }

        $data=[
            'book_category_id'=>$request->input('book_category_id'),
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'pages'=>$request->input('pages'),
            'author'=>$request->input('author'),
            'isbn'=>$request->input('isbn'),
            'publisher'=>$request->input('publisher'),
            'price'=>$request->input('price'),
            'rating'=>$request->input('rating'),
            'shopee_link'=>$request->input('shopee_link'),
        ];

        $image = $request->file('photo')->getRealPath();

        $user=auth('api')->user();
        if ($user->role_id != 1) {
            return $this->response()->failMessage(403,'sorry only admin can create book');
        }

        if (!BookCategory::find($data['book_category_id'])) {
            return $this->response()->failMessage(404,'book category not found');
        }

        try {
            Cloudder::upload($image,null,array('folder'=>'cover_book','resource_type'=>'image'));
            $imgUrl = Cloudder::show(Cloudder::getPublicId());
            $replaceImg=str_replace('/c_fit,h_150,w_150','',$imgUrl);
            $this->create($data,$replaceImg);
            return $this->response()->successMessage('create book success');
        } catch (\Throwable $th) {
            return $this->response()->failMessage(422,$th->getMessage());
        }
    }

    public function create($data,$imgUrl)
    {
        Book::insert([
            'book_category_id'=>$data['book_category_id'],
            'title'=>$data['title'],
            'description'=>$data['description'],
            'pages'=>$data['pages'],
            'author'=>$data['author'],
            'isbn'=>$data['isbn'],
            'publisher'=>$data['publisher'],
            'price'=>$data['price'],
            'rating'=>$data['rating'],
            'shopee_link'=>$data['shopee_link'],
            'photo'=>$imgUrl,
            'date_published'=>Carbon::now()
        ]);
    }
}
