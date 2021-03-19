<?php

namespace App\Http\Controllers\GoogleDrive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use Validator;

class UploadGoogleDriveController extends Controller
{
    public function __invoke(Request $request){
        $validator = Validator::make($request->all(),[
            'item' => 'required|max:2000',
            'folderId' => 'required'
        ]);
        
        if($validator->fails()) {
            return response()->json([
                "status"=>400,
                "msg"=>$validator->errors()->all()
            ],400);
        }

        $file=$request->file('item');
        $folderId=$request->input('folderId');
        
        try {
        if ($folderId == "1HiWqwX8a4Blgidu3TKyIR2dzCIM1VDry") {
            Storage::disk('paketAntologi')->put($file->getClientOriginalName(),$file->get());
        }else if ($folderId == "1RqLZHdwp5qLI7uZm4jo9XKX6rt_czGhR") {
            Storage::disk('paketBerbayar')->put($file->getClientOriginalName(),$file->get());
        }else if ($folderId == "1bddFPUXRANV-OVvJCCP32I8erkfvuXmO") {
            Storage::disk('paketSeleksi')->put($file->getClientOriginalName(),$file->get());
        }
        // $file->store($folderId,"google");
        return response()->json([
            "status"=>200,
            "msg"=>"success upload to google drive"
        ],200);
        } catch (\Exception $e) {
            return response()->json([
                "status"=>500,
                "msg"=>$e->getMessage()
            ],200); 
        }
    }
}
