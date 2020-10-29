<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Country as ModelsCountry;
use Illuminate\Http\Request;
use Validator;
// use Dotenv\Validator;
class CountryController extends Controller
{
    public function country(){
        return response()->json(ModelsCountry::get(),200);
    }

    public function countryFindById($id){
        $data = ModelsCountry::find($id);
        if(is_null($data)){
            return response()->json(["message"=>"Data not Found"],404);
        }
        return response()->json($data,200);
    }

    public function CreateCountry(Request $request){

        $rules = [
            'name' => 'required|min:3',
            'iso'  => 'required|min:2|max:2'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        $country = ModelsCountry::create($request->all());
        return response()->json($country,201);
    }

    public function countryUpdate(Request $request,$id){
        $country = ModelsCountry::find($id);
        if(is_null($country)){
            return response()->json(['message','Error Update'],404);
        }
        $country->update($request->all());
       return response()->json($country,200);
    }

    public function countryDelete($id){
        $data = ModelsCountry::find($id);
        if(is_null($data)){
            return response()->json(["message"=>"Data not Found"],404);
        }
        $data->delete();
            $data->delete();
            return response()->json(null,204);
    }


    // public function countryDelete(Request $request, ModelsCountry $country){
    //     $country->delete();
    //     return response()->json(null,204);
    // }

}