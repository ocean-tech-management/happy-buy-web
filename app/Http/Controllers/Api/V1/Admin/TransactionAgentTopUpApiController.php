<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTransactionAgentTopUpRequest;
use App\Http\Requests\UpdateTransactionAgentTopUpRequest;
use App\Http\Resources\Admin\TransactionAgentTopUpResource;
use App\Models\TransactionAgentTopUp;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionAgentTopUpApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('transaction_agent_top_up_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionAgentTopUpResource(TransactionAgentTopUp::with(['user', 'merchant'])->get());
    }

    public function store(StoreTransactionAgentTopUpRequest $request)
    {
        $transactionAgentTopUp = TransactionAgentTopUp::create($request->all());

        if ($request->input('receipt_photo', false)) {
            $transactionAgentTopUp->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt_photo'))))->toMediaCollection('receipt_photo');
        }

        return (new TransactionAgentTopUpResource($transactionAgentTopUp))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransactionAgentTopUp $transactionAgentTopUp)
    {
        abort_if(Gate::denies('transaction_agent_top_up_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionAgentTopUpResource($transactionAgentTopUp->load(['user', 'merchant']));
    }

    public function update(UpdateTransactionAgentTopUpRequest $request, TransactionAgentTopUp $transactionAgentTopUp)
    {
        $transactionAgentTopUp->update($request->all());

        if ($request->input('receipt_photo', false)) {
            if (!$transactionAgentTopUp->receipt_photo || $request->input('receipt_photo') !== $transactionAgentTopUp->receipt_photo->file_name) {
                if ($transactionAgentTopUp->receipt_photo) {
                    $transactionAgentTopUp->receipt_photo->delete();
                }
                $transactionAgentTopUp->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt_photo'))))->toMediaCollection('receipt_photo');
            }
        } elseif ($transactionAgentTopUp->receipt_photo) {
            $transactionAgentTopUp->receipt_photo->delete();
        }

        return (new TransactionAgentTopUpResource($transactionAgentTopUp))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransactionAgentTopUp $transactionAgentTopUp)
    {
        abort_if(Gate::denies('transaction_agent_top_up_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionAgentTopUp->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
