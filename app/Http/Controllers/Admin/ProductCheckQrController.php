<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductCheckQrRequest;
use App\Http\Requests\StoreProductCheckQrRequest;
use App\Http\Requests\UpdateProductCheckQrRequest;
use App\Models\ProductQuantity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCheckQrController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_check_qr_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrCode = request('code');

        $productQuantity = ProductQuantity::whereQrCode($qrCode)->first();

//        dd($qrCode);
        return view('admin.productCheckQrs.index', compact('productQuantity'));
    }

    public function indexNew(Request $request)
    {
        abort_if(Gate::denies('product_check_qr_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrCode = request('code');

        $productQuantity = ProductQuantity::whereQrCode($qrCode)->first();
        if($productQuantity){
            $productQuantity2 = ProductQuantity::whereQrCode($qrCode)->first();
            if($productQuantity2->actual_stock == 0){
                $productQuantity2->update([
                    'actual_stock' => 1
                ]);
            }else{
                $productQuantity2->update([
                    'actual_stock' => 2
                ]);
            }

        }

//        dd($qrCode);
        return view('admin.productCheckQrs.new', compact('productQuantity'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_check_qr_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productCheckQrs.create');
    }

    public function store(StoreProductCheckQrRequest $request)
    {
        $productCheckQr = ProductCheckQr::create($request->all());

        return redirect()->route('admin.product-check-qrs.index');
    }

    public function edit(ProductCheckQr $productCheckQr)
    {
        abort_if(Gate::denies('product_check_qr_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productCheckQrs.edit', compact('productCheckQr'));
    }

    public function update(UpdateProductCheckQrRequest $request, ProductCheckQr $productCheckQr)
    {
        $productCheckQr->update($request->all());

        return redirect()->route('admin.product-check-qrs.index');
    }

    public function show(ProductCheckQr $productCheckQr)
    {
        abort_if(Gate::denies('product_check_qr_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productCheckQrs.show', compact('productCheckQr'));
    }

    public function destroy(ProductCheckQr $productCheckQr)
    {
        abort_if(Gate::denies('product_check_qr_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCheckQr->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductCheckQrRequest $request)
    {
        ProductCheckQr::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
