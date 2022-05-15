<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Products;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;
use App\Repositories\ProductsRepository;
use App\Http\Resources\ProductsResource;

class ProductsController extends Controller
{
    protected $repository;
  
    public function __construct(ProductsRepository $repository)
    {
        $this->repository = $repository;
    }
  
    /**
     * get list of all the proucts.
     *
     * @param $request: Illuminate\Http\Request
     * @return json response
     */
    public function index(Request $request)
    {
        $items = $this->repository->paginate($request);
        return response()->json(['items' => $items]);
    }
  
    /**
     * store product data to database table.
     *
     * @param $request: App\Http\Requests\ProductsRequest
     * @return json response
     */
    public function store(ProductsRequest $request)
    {
        $validated = $request->validated();
        
        try {
            $item = $this->repository->store($request);
            return ProductsResource::collection(['item' => $item]);
            // return response()->json(['item' => $item]);
        } catch (Exception $e) {
            die('aa');
            return ProductResource::collection(['message' => $e->getMessage()], $e->getStatus());
            // return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
  
    /**
     * update product data to database table.
     *
     * @param $request: App\Http\Requests\ProductsRequest
     * @return json response
     */
    public function update($id, ProductsRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return response()->json(['item' => $item]);
        } catch (Exception $e) {
           return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
  
    /**
     * get single item by id.
     * 
     * @param integer $id: integer product id.
     * @return json response.
     */
    public function show($id)
    {
        try {
            $item = $this->repository->show($id);
            return response()->json(['item' => $item]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
 
    /**
     * delete product by id.
     * 
     * @param integer $id: integer product id.
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
