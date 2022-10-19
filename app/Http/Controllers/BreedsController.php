<?php

namespace App\Http\Controllers;
use App\Models\Breed;
use Illuminate\Http\Request;

/**
 * Контроллер кошачьих пород
 *
 * Class BreedsController
 *
 * @package App\Http\Controllers\Objects
 */
class BreedsController extends Controller
{


    /**
     * @return mixed
     */
    public function breedsList()
    {
        return Breed::orderBy('name')->get();
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function getBreedData(Request $request): mixed
    {
        $id = $request->input('id');
        return Breed::find($id);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function saveBreed(Request $request): mixed
    {
        $data = $request->input('data');
        $breed_id = $request->input('breed_id');
        if ($breed_id > 0) {
            $cat = Breed::find($breed_id);
        }  else {
            $cat = new Breed();
        }

        try {
            $cat->name = $data['name'];
            $cat->description = $data['description'];
            $cat->long_life = $data['long_life'];

            $cat->save();

            return ['success'=> true];

        } catch (\Exception $e) {
            d($e, 1);
            return ['success'=> false];
        }
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function deleteBreed(Request $request): mixed
    {
        try {
            $id = $request->input('id');
            $breed = Breed::find($id)->delete();

            return ['success' => $breed > 0];

        } catch (\Exception $e){
            return ['success' => false, 'error'=>$e];
        }

    }
}
