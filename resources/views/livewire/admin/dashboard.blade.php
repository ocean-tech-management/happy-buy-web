<div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-4 d-flex mt-5">

                <div class=" col-3">
                    <select wire:model="productId" name="productId" class="form-control datatable-input">
                        <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.product.title')])}}</option>
                        @foreach($products as $key => $item)
                            <option value="{{$item->id}}">{{$item->name_en}}</option>>
                        @endforeach
                    </select>
                </div>

                <div class=" col-2">
                    <select wire:model="productSizeName" class="form-control datatable-input">
                        <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.productVariant.fields.size')])}}</option>
                        @foreach($productSize as $key => $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>>
                        @endforeach
                    </select>
                </div>

                <div class=" col-2">
                    <select wire:model="productColorName" class="form-control datatable-input" id="status">
                        <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.productVariant.fields.color')])}}</option>
                        @foreach($productColor as $key => $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>>
                        @endforeach
                    </select>
                </div>


                <div class="flex-grow-1 col-2" >
{{--                    <button wire:click="updateSearch()" type="button" id="search-btn" name="search" value="Search" class="btn btn-primary btn-primary--icon tw-mr-2 tw-rounded">--}}
{{--                        <i class="fa fa-search"></i> {{trans('global.search')}}--}}
{{--                    </button>--}}

                    <button wire:click="clearSearch()" type="reset" id="reset-btn" name="reset" value="Reset" class="btn btn-secondary btn-secondary--icon tw-rounded">
                        <i class="fa fa-times"></i> {{trans('global.reset')}}
                    </button>
                </div>

            </div>

            <h4 class="card-title mb-4">Top Redeem Products</h4>
            <div class="table-responsive">
                <table class="table table-nowrap table-hover mb-0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ trans('cruds.product.fields.name_en') }}</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Stock</th>
                        <th scope="col">Total Stock Balance</th>
                        <th scope="col">Total Stock ({{ \Carbon\Carbon::parse($startDate)->format('Y-m-d')}} to {{ \Carbon\Carbon::parse($endDate)->format('Y-m-d')}})</th>
                        <th scope="col">Total Balance ({{ \Carbon\Carbon::parse($startDate)->format('Y-m-d')}} to {{ \Carbon\Carbon::parse($endDate)->format('Y-m-d')}})</th>
                    </tr>
                    </thead>
                    @php $i = 1; @endphp
                    @foreach ($order as $item)
                        <tr>
                            <th scope="row">{{$i}} {{ $item->product_variant_id }}</th>
                            <td>{{$item->product_name_en}}<br/>Size: {{$item->product_size}}<br/>Color: {{$item->product_color}}</td>
                            <td>{{number_format($item->total)}}</td>
                            <td>{{number_format($item->stock_total)}}</td>
                            <td>{{number_format($item->stock_balance)}}</td>
                            <td>{{number_format($item->stock_total_time)}}</td>
                            <td>{{number_format($item->stock_balance_time)}}</td>
                            <?php $i++; ?>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>
