<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductColorRequest;
use App\Http\Requests\UpdateProductColorRequest;
use App\Http\Resources\Admin\ProductColorResource;
use App\Models\ProductColor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductColorApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_color_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductColorResource(ProductColor::all());
    }

    public function store(StoreProductColorRequest $request)
    {
        $productColor = ProductColor::create($request->all());

        return (new ProductColorResource($productColor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductColor $productColor)
    {
        abort_if(Gate::denies('product_color_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductColorResource($productColor);
    }

    public function update(UpdateProductColorRequest $request, ProductColor $productColor)
    {
        $productColor->update($request->all());

        return (new ProductColorResource($productColor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductColor $productColor)
    {
        abort_if(Gate::denies('product_color_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productColor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
