<?php

namespace App\Http\Controllers;

use App\Http\Resources\KomersResource;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KomersController extends Controller
{

    public function __construct() {
        $this->middleware('auth:sanctum')->only('store','update','delete');
        $this->middleware('PemilikProduk')->only('update','delete');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = products::all();
        return KomersResource::collection($products);
    }

    function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request['user_id'] = auth()->id();



        $request->validate([
            'product' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);


        if(empty($request->file('img'))){


            $product = products::create($request->all());


        }else {


            $validate = $request->validate([
                'img' => 'mimes:jpg,jpeg,png,webp'
            ]);

            // ? mimes untuk extention yang di gunakan
            $filnem = $this->generateRandomString();
            $extension = $request->file('img')->extension();

            Storage::putFileAs('image', $request->file('img'), $filnem.'.'.$extension);

            $request['user_id'] = auth()->id();
            $request['image'] = $filnem . '.' . $extension;


            $product = products::create($request->all());
        }

        return new KomersResource($product);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $product = products::findOrFail($id);
        return new KomersResource($product);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product',
            'description',
            'price',
            'category_id',
        ]);

        $product = products::findOrFail($id);
        $product->update($request->all());

        return new KomersResource($product);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $product = products::findOrFail($id);
        $product->delete();

        return response()->json(['Product telah di hapus dari alam semesta']);

    }
}
