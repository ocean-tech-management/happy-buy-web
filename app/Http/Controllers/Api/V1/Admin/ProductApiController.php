<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource(Product::with(['category'])->get());
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        if ($request->input('image_1', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_1'))))->toMediaCollection('image_1');
        }

        if ($request->input('image_2', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_2'))))->toMediaCollection('image_2');
        }

        if ($request->input('image_3', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_3'))))->toMediaCollection('image_3');
        }

        if ($request->input('image_4', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_4'))))->toMediaCollection('image_4');
        }

        if ($request->input('image_5', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_5'))))->toMediaCollection('image_5');
        }

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource($product->load(['category']));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        if ($request->input('image_1', false)) {
            if (!$product->image_1 || $request->input('image_1') !== $product->image_1->file_name) {
                if ($product->image_1) {
                    $product->image_1->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_1'))))->toMediaCollection('image_1');
            }
        } elseif ($product->image_1) {
            $product->image_1->delete();
        }

        if ($request->input('image_2', false)) {
            if (!$product->image_2 || $request->input('image_2') !== $product->image_2->file_name) {
                if ($product->image_2) {
                    $product->image_2->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_2'))))->toMediaCollection('image_2');
            }
        } elseif ($product->image_2) {
            $product->image_2->delete();
        }

        if ($request->input('image_3', false)) {
            if (!$product->image_3 || $request->input('image_3') !== $product->image_3->file_name) {
                if ($product->image_3) {
                    $product->image_3->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_3'))))->toMediaCollection('image_3');
            }
        } elseif ($product->image_3) {
            $product->image_3->delete();
        }

        if ($request->input('image_4', false)) {
            if (!$product->image_4 || $request->input('image_4') !== $product->image_4->file_name) {
                if ($product->image_4) {
                    $product->image_4->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_4'))))->toMediaCollection('image_4');
            }
        } elseif ($product->image_4) {
            $product->image_4->delete();
        }

        if ($request->input('image_5', false)) {
            if (!$product->image_5 || $request->input('image_5') !== $product->image_5->file_name) {
                if ($product->image_5) {
                    $product->image_5->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_5'))))->toMediaCollection('image_5');
            }
        } elseif ($product->image_5) {
            $product->image_5->delete();
        }

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
