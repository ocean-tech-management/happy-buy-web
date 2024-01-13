<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductBatchRequest;
use App\Http\Requests\UpdateProductBatchRequest;
use App\Http\Resources\Admin\ProductBatchResource;
use App\Models\ProductBatch;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductBatchApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_batch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductBatchResource(ProductBatch::with(['product'])->get());
    }

    public function store(StoreProductBatchRequest $request)
    {
        $productBatch = ProductBatch::create($request->all());

        return (new ProductBatchResource($productBatch))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductBatch $productBatch)
    {
        abort_if(Gate::denies('product_batch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductBatchResource($productBatch->load(['product']));
    }

    public function update(UpdateProductBatchRequest $request, ProductBatch $productBatch)
    {
        $productBatch->update($request->all());

        return (new ProductBatchResource($productBatch))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductBatch $productBatch)
    {
        abort_if(Gate::denies('product_batch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBatch->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
