<?php

namespace App\Http\Requests;

use App\Models\ProductQuantity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductQuantityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_quantity_create');
    }

    public function rules()
    {
        return [
            'transaction' => [
                'string',
                'nullable',
            ],
            'qr_code' => [
                'string',
                'nullable',
                'max:125',
            ],
            'qr_generate_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'in_stock_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'sold_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'first_scan_at' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
