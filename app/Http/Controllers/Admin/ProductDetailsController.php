<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductDetailRequest;
use App\Http\Requests\StoreProductDetailRequest;
use App\Http\Requests\UpdateProductDetailRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductDetailsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productDetails.create');
    }

    public function store(StoreProductDetailRequest $request)
    {
        $productDetail = ProductDetail::create($request->all());

        return redirect()->route('admin.product-details.index');
    }

    public function edit(ProductDetail $productDetail)
    {
        abort_if(Gate::denies('product_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productDetails.edit', compact('productDetail'));
    }

    public function update(UpdateProductDetailRequest $request, ProductDetail $productDetail)
    {
        $productDetail->update($request->all());

        return redirect()->route('admin.product-details.index');
    }

    public function show(ProductDetail $productDetail)
    {
        abort_if(Gate::denies('product_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productDetails.show', compact('productDetail'));
    }

    public function destroy(ProductDetail $productDetail)
    {
        abort_if(Gate::denies('product_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductDetailRequest $request)
    {
        ProductDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
