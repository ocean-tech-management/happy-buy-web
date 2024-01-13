@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') ?? '-' }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <livewire:admin.order.create />
{{--        <form method="POST" action="{{ route("admin.orders.store") }}" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            --}}



{{--        </form>--}}
    </div>
</div>



@endsection

@section('scripts')
{{--    @parent--}}
{{--    <script>--}}

{{--        $(function () {--}}

{{--            $('.dynamic').change(function () {--}}
{{--                console.log($(this).val());--}}
{{--                if($(this).val() != '')--}}
{{--                {--}}
{{--                    $(document).on({--}}
{{--                        ajaxStart: function(){--}}
{{--                            $("body").addClass("loading");--}}
{{--                        },--}}
{{--                        ajaxStop: function(){--}}
{{--                            $("body").removeClass("loading");--}}
{{--                        }--}}
{{--                    });--}}

{{--                    var user_id = $(this).val();--}}
{{--                    var _token = $('input[name="_token"]').val();--}}

{{--                    $.ajax({--}}
{{--                        url: "{{ route('admin.carts.fetch.cart')}}",--}}
{{--                        method: "POST",--}}
{{--                        data: { user_id:user_id, _token:_token },--}}
{{--                        success: function(result)--}}
{{--                        {--}}
{{--                            console.log(result);--}}
{{--                            $('#cart_item').html(result);--}}
{{--                        }--}}
{{--                    })--}}
{{--                } else {--}}
{{--                    // $("#address").prop('disabled', true);--}}
{{--                    // $("#address > option").prop("selected", "");--}}
{{--                }--}}


{{--            });--}}
{{--        })--}}


{{--    </script>--}}
@endsection
