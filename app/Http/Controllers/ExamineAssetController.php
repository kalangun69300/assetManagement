<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

class ExamineAssetController extends Controller
{
    public function examine() {
        $assets=Asset::all();
        return view('approver.asset.examine',compact('assets'));
    }

    public function storeInspection(Request $request) {
        Asset::insert([
            'asset_pass'=>$request->asset_pass,
            'asset_problem'=>$request->asset_problem
       ]);
       return redirect()->route('assetExamine')->with('success',"บันทึกข้อมูลเรียบร้อย"); 
    }
    
}
