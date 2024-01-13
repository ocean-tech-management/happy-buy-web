<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankListRequest;
use App\Http\Requests\UpdateBankListRequest;
use App\Http\Resources\Admin\BankListResource;
use App\Models\BankList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankListApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bank_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankListResource(BankList::all());
    }

    public function store(StoreBankListRequest $request)
    {
        $bankList = BankList::create($request->all());

        return (new BankListResource($bankList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BankList $bankList)
    {
        abort_if(Gate::denies('bank_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankListResource($bankList);
    }

    public function update(UpdateBankListRequest $request, BankList $bankList)
    {
        $bankList->update($request->all());

        return (new BankListResource($bankList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BankList $bankList)
    {
        abort_if(Gate::denies('bank_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
