<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductQuantityRequest;
use App\Http\Requests\UpdateProductQuantityRequest;
use App\Http\Resources\Admin\ProductQuantityResource;
use App\Models\ProductQuantity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductQuantityApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_quantity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductQuantityResource(ProductQuantity::with(['product', 'batch', 'sold_to_user'])->get());
    }

    public function store(StoreProductQuantityRequest $request)
    {
        $productQuantity = ProductQuantity::create($request->all());

        return (new ProductQuantityResource($productQuantity))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductQuantity $productQuantity)
    {
        abort_if(Gate::denies('product_quantity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductQuantityResource($productQuantity->load(['product', 'batch', 'sold_to_user']));
    }

    public function update(UpdateProductQuantityRequest $request, ProductQuantity $productQuantity)
    {
        $productQuantity->update($request->all());

        return (new ProductQuantityResource($productQuantity))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductQuantity $productQuantity)
    {
        abort_if(Gate::denies('product_quantity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productQuantity->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
