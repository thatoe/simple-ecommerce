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
    
    /**
     * set payload data for products table.
     * 
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        dd($request->image);
        return $request->all();
    }
}