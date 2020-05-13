<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Commune;
use App\Region;
use DB;

class CommuneController extends Controller
{
 
    public function communes($region_id)
    {
        $communes = Commune::where('region_id', $region_id)->pluck('name', 'id');
        $list = '';
        foreach ($communes as $key => $value) {
            $list .= "<option value='" . $key . "'>" . $value . "</option>";
        }
        return $list;
    }
    
    public function getCommuneList(Request $request)
        {
            $communes = DB::table("communes")
            ->where("region_id",$request->region_id)
            ->pluck("name","id");
            return response()->json($communes);
        }
}
