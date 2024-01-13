<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Http\Resources\Admin\VoucherResource;
use App\Models\Voucher;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VoucherApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('voucher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VoucherResource(Voucher::with(['roles', 'product'])->get());
    }

    public function store(StoreVoucherRequest $request)
    {
        $voucher = Voucher::create($request->all());
        $voucher->roles()->sync($request->input('roles', []));

        return (new VoucherResource($voucher))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Voucher $voucher)
    {
        abort_if(Gate::denies('voucher_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VoucherResource($voucher->load(['roles', 'product']));
    }

    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $voucher->update($request->all());
        $voucher->roles()->sync($request->input('roles', []));

        return (new VoucherResource($voucher))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Voucher $voucher)
    {
        abort_if(Gate::denies('voucher_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $voucher->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
