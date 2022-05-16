<?php
namespace App\Repositories;

use App\CartItems;
use App\Http\Requests\CartItemsRequest;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class CartItemsRepository extends AppRepository
{
    protected $model;
    
    public function __construct(CartItems $model)
    {
        $this->model = $model;
    }

    public function paginate(Request $request)
    {
        return $this->model->paginate($request->input('limit', 10));
    }
    
    /**
     * set payload data for cart_items table.
     * 
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        return $request->all();
    }
}