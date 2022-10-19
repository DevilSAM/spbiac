<?php

namespace App\Http\Controllers;
use App\Models\Breed;
use App\Models\Cat;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Контроллер для кошек
 *
 * Class CatsController
 *
 * @package App\Http\Controllers\Objects
 */
class CatsController extends Controller
{


    /**
     * @return Collection|array
     */
    public function catsList(): Collection|array
    {
        return Cat::with('breed')->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getCatData(Request $request): mixed
    {
        $id = $request->input('id');
        $breeds = Breed::all();
        $cat = Cat::find($id);
        if($id && !$cat) {
            return ['redirect'=>true];
        }
        return ['cat'=>$cat, 'breeds'=>$breeds];
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function saveCat(Request $request): mixed
    {
        $data = $request->input('data');
        $cat_id = $request->input('cat_id');
        if ($cat_id > 0) {
            $cat = Cat::find($cat_id);
        }  else {
            $cat = new Cat();
        }

        try {
            $cat->name = $data['name'];
            $cat->age = $data['age'];
            $cat->breed_id = $data['breed_id'];
            $cat->image = $data['image'];
            $cat->save();

            return ['success'=> true];

        } catch (\Exception $e) {
            d($e, 1);
            return ['success'=> false, 'error'=>$e];
        }
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function deleteCat(Request $request): mixed
    {
        try {
            $id = $request->input('id');
            $cat = Cat::find($id)->delete();

            return ['success' => $cat > 0];

        } catch (\Exception $e){
            return ['success' => false, 'error'=>$e];
        }

    }


    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function refreshPhoto(){
        $url = 'https://api.thecatapi.com/v1/images/search';
        $client = new Client();
        $response = $client->request('GET', $url);

        return json_decode($response->getBody(), true);;
    }








}
