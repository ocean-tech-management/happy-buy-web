<?php

namespace App\Http\Requests;

use App\Models\ProductBatch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductBatchRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_batch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:product_batches,id',
        ];
    }
}
