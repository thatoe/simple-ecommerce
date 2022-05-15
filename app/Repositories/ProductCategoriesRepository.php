<?php
namespace App\Repositories;

use App\ProductCategories;
use App\Http\Requests\ProductCategoriesRequest;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class ProductCategoriesRepository extends AppRepository
{
    protected $model;
    
    public function __construct(ProductCategories $model)
    {
        $this->model = $model;
    }

    public function paginate(Request $request)
    {
        return $this->model->paginate($request->input('limit', 10));
    }
    
    /**
     * set payload data for product_categories table.
     * 
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        return $request->all();
    }
}