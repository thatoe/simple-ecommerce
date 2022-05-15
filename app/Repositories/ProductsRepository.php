<?php
namespace App\Repositories;

use App\Products;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class ProductsRepository extends AppRepository
{
    protected $model;
    
    public function __construct(Products $model)
    {
        $this->model = $model;
    }

    // public function store(Request $request)
    // {
    //     [$data,$path] = $this->setDataPayload($request);
    //     $item = $this->model;
    //     /$data['image'] = $path;
    //     $item->fill($data);
    //     $item->save();
    //      return $item;
    // }
    
    /**
     * set payload data for products table.
     * 
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        $data = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->store('public/products');
            $data['image'] = $path;
        }
        // dd($request->image);
        return $data;
    }
}