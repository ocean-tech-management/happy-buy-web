<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippingCompanyRequest;
use App\Http\Requests\UpdateShippingCompanyRequest;
use App\Http\Resources\Admin\ShippingCompanyResource;
use App\Models\ShippingCompany;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShippingCompanyApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shipping_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippingCompanyResource(ShippingCompany::all());
    }

    public function store(StoreShippingCompanyRequest $request)
    {
        $shippingCompany = ShippingCompany::create($request->all());

        return (new ShippingCompanyResource($shippingCompany))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ShippingCompany $shippingCompany)
    {
        abort_if(Gate::denies('shipping_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippingCompanyResource($shippingCompany);
    }

    public function update(UpdateShippingCompanyRequest $request, ShippingCompany $shippingCompany)
    {
        $shippingCompany->update($request->all());

        return (new ShippingCompanyResource($shippingCompany))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ShippingCompany $shippingCompany)
    {
        abort_if(Gate::denies('shipping_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingCompany->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
