<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\CartItems;
use Illuminate\Http\Request;
use App\Http\Requests\CartItemsRequest;
use App\Repositories\CartItemsRepository;
use App\Http\Resources\CartItemsResource;


class CartItemsController extends Controller
{
    protected $repository;
  
    public function __construct(CartItemsRepository $repository)
    {
        $this->repository = $repository;
    }
  
    /**
     * get list of all the cartitems.
     *
     * @param $request: Illuminate\Http\Request
     * @return json response
     */
    public function index(Request $request)
    {
        $items = $this->repository->paginate($request);
        return CartItemsResource::collection($items);
    }
  
    /**
     * store cartitem data to database table.
     *
     * @param $request: App\Http\Requests\CartItemsRequest
     * @return json response
     */
    public function store(CartItemsRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            return new CartItemsResource($item);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
  
    /**
     * update cartitem data to database table.
     *
     * @param $request: App\Http\Requests\CartItemsRequest
     * @return json response
     */
    public function update($id, CartItemsRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return new CartItemsResource($item);
        } catch (Exception $e) {
           return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
  
    /**
     * get single item by id.
     * 
     * @param integer $id: integer cartitem id.
     * @return json response.
     */
    public function show($id)
    {
        try {
            $item = $this->repository->show($id);
            return new CartItemsResource($item);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
 
    /**
     * delete post by id.
     * 
     * @param integer $id: integer cartitem id.
     * @return json response.
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}
