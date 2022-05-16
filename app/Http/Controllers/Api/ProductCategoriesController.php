<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductCategories;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCategoriesRequest;
use App\Repositories\ProductCategoriesRepository;
use App\Http\Resources\ProductCategoriesResource;


class ProductCategoriesController extends Controller
{
    protected $repository;
  
    public function __construct(ProductCategoriesRepository $repository)
    {
        $this->repository = $repository;
    }
  
    /**
     * get list of all the productcategories.
     *
     * @param $request: Illuminate\Http\Request
     * @return json response
     */
    public function index(Request $request)
    {
        $items = $this->repository->paginate($request);
        return ProductCategoriesResource::collection($items);
    }
  
    /**
     * store productcategory data to database table.
     *
     * @param $request: App\Http\Requests\ProductCategoriesRequest
     * @return json response
     */
    public function store(ProductCategoriesRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            return new ProductCategoriesResource($item);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
  
    /**
     * update productcategory data to database table.
     *
     * @param $request: App\Http\Requests\ProductCategoriesRequest
     * @return json response
     */
    public function update($id, ProductCategoriesRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return new ProductCategoriesResource($item);
        } catch (Exception $e) {
           return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
  
    /**
     * get single item by id.
     * 
     * @param integer $id: integer productcategory id.
     * @return json response.
     */
    public function show($id)
    {
        try {
            $item = $this->repository->show($id);
            return new ProductCategoriesResource($item);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
 
    /**
     * delete post by id.
     * 
     * @param integer $id: integer productcategory id.
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
