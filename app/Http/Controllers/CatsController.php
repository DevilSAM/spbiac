<?php

namespace App\Http\Controllers;
use App\Models\Breed;
use App\Models\Cat;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * Функция Получает всех кошек (с полными данными о их породах)
     *
     * @return Collection|array
     */
    public function catsList(): Collection|array
    {
        return Cat::with('breed')->get();
    }


    /**
     * Функция возвращает данные о конкретной кошке по её ID
     *
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
     * Изменение данных кошки по ее ID или создание новой записи
     *
     * @param Request $request
     * @return mixed
     */
    public function saveCat(Request $request): mixed
    {
        $data = $request->input('data');
        $cat_id = $request->input('cat_id');
        if ($cat_id > 0) {
            $cat = Cat::find($cat_id);
            // старую картинку удаляем, если она была
            $this->deleteImage($cat->image);
        }  else {
            $cat = new Cat();
        }

        try {
            // сохраняем новую картинку локально и получаем путь к ней
            $image_local_path = $this->storeImage($data['image']);
            // записываем новые данные и сохраняем в БД
            $cat->name = $data['name'];
            $cat->age = $data['age'];
            $cat->breed_id = $data['breed_id'];
            $cat->image = $image_local_path;
            $cat->save();

            return ['success'=> true];

        } catch (\Exception $e) {
            d($e, 1);
            return ['success'=> false, 'error'=>$e];
        }
    }

    /**
     * Сохранение фотографии котика в локальном хранилище
     *
     * @param $url
     * @return string
     */
    private function storeImage($url): string
    {
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        $path = 'images/' . time() . '_' . $name;
        Storage::put('public/' . $path, $contents);

        return '/storage/' . $path;
    }


    /**
     * Удаляем из локального хранилища старую фотку котика, чтобы не захламлять сторэдж
     *
     * @param $path
     */
    private function deleteImage($path): void
    {
        Storage::delete(str_replace('storage', 'public', $path));
    }


    /**
     * Удаление записи о конкретной кошке
     *
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
     * Получение рандомной фотографии кошки со стороннего сайта
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function refreshPhoto(){
        $url = 'https://api.thecatapi.com/v1/images/search';
        $client = new Client();
        $response = $client->request('GET', $url);

        return json_decode($response->getBody(), true);
    }


}
