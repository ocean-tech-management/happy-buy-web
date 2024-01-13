<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductVariantRequest;
use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductVariantController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_variant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductVariant::with(['product', 'color', 'size'])->select(sprintf('%s.*', (new ProductVariant())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_variant_show';
                $editGate = 'product_variant_edit';
                $deleteGate = 'product_variant_delete';
                $crudRoutePart = 'product-variants';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('product_name_en', function ($row) {
                return $row->product ? $row->product->name_en : '';
            });

            $table->addColumn('color_name', function ($row) {
                return $row->color ? $row->color->name : '';
            });

            $table->addColumn('size_name', function ($row) {
                return $row->size ? $row->size->name : '';
            });

//            $table->editColumn('quantity', function ($row) {
//                return $row->quantity ? $row->quantity : '';
//            });
            $table->editColumn('sku', function ($row) {
                return $row->sku ? $row->sku : '';
            });
            $table->editColumn('sales_price', function ($row) {
                return $row->sales_price ? $row->sales_price : '';
            });
            $table->editColumn('merchant_president_price', function ($row) {
                return $row->merchant_president_price ? $row->merchant_president_price : '';
            });
            $table->editColumn('agent_director_price', function ($row) {
                return $row->agent_director_price ? $row->agent_director_price : '';
            });
            $table->editColumn('agent_executive_price', function ($row) {
                return $row->agent_executive_price ? $row->agent_executive_price : '';
            });
            $table->editColumn('price_add_on', function ($row) {
                return $row->price_add_on ? $row->price_add_on : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'color', 'size']);
            
            return $table->make(true);
        }

        return view('admin.productVariants.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('product_variant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = Product::findOrFail(request('id'));

        $colors = ProductColor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = ProductSize::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variants = ProductVariant::whereProductId(request('id'))->get();

        $types = ['' => trans('global.pleaseSelect')] + ProductVariant::TYPE_SELECT;
        
        foreach($variants as $item) {
            $item->type = ProductVariant::TYPE_SELECT[$item->type];
        }

        return view('admin.productVariants.create', compact('product', 'colors', 'sizes', 'variants', 'types'));
    }

    public function store(StoreProductVariantRequest $request)
    {
        DB::beginTransaction();
        try {
            // $color = ProductColor::where('id', $request->color_id)->first();
            // $size = ProductSize::where('id', $request->size_id)->first();
            // if(($color && trim($color->name, " ") != "NO COLOR") || ($size && trim($size->name, " ") != "NO SIZE")) {
            //     $modelExist = ProductVariant::whereProductId(request('product_id'))->whereColorId(request('color_id'))->whereSizeId(request('size_id'))->first();
            //     if($modelExist) {
            //         return back()->with('error', trans('cruds.productVariant.fields.variant_exists'))->withInput();;
            //     }
            // }

            $color = ProductColor::where('id', $request->color_id)->first();
            $size = ProductSize::where('id', $request->size_id)->first();
            if(($color && $color->name != "NO COLOR") || ($size && $size->name != "NO SIZE")) {
                $modelExist = ProductVariant::whereProductId(request('product_id'))->whereColorId(request('color_id'))->whereSizeId(request('size_id'))->first();
                if($modelExist) {
                    return back()->with('error', trans('cruds.productVariant.fields.variant_exists', ['sku' => $modelExist->sku]))->withInput();;
                }
            }

            $productVariant = ProductVariant::create($request->all());
    
            if ($request->input('photo', false)) {
                $productVariant->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
    
            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $productVariant->id]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('admin.products.edit', $productVariant->product->id);
    }

    public function edit(ProductVariant $productVariant)
    {
        abort_if(Gate::denies('product_variant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = Product::findOrFail($productVariant->product->id);

        $colors = ProductColor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = ProductSize::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productVariant->load('product', 'color', 'size');

        $types = ['' => trans('global.pleaseSelect')] + ProductVariant::TYPE_SELECT;
        
        return view('admin.productVariants.edit', compact('product', 'colors', 'sizes', 'productVariant', 'types'));
    }

    public function update(UpdateProductVariantRequest $request, ProductVariant $productVariant)
    {
        DB::beginTransaction();

        try {
            // $color = ProductColor::where('id', $request->color_id)->first();
            // $size = ProductSize::where('id', $request->size_id)->first();
            // if(($color && trim($color->name, " ") != "NO COLOR") || ($size && trim($size->name, " ") != "NO SIZE")) {
            //     $modelExist = ProductVariant::whereProductId($productVariant->product->id)->whereColorId(request('color_id'))->whereSizeId(request('size_id'))->first();
            //     if($modelExist) {
            //         return back()->with('error', trans('cruds.productVariant.fields.variant_exists'))->withInput();;
            //     }
            // }
            
            $color = ProductColor::where('id', $request->color_id)->first();
            $size = ProductSize::where('id', $request->size_id)->first();
            
            if(($color && $color->name != "NO COLOR") || ($size && $size->name != "NO SIZE")) {
                $modelExist = ProductVariant::whereProductId($productVariant->product->id)->whereColorId(request('color_id'))->whereSizeId(request('size_id'))->first();
                if($modelExist) {
                    // Ignore self check
                    if($productVariant->id != $modelExist->id) {
                        return back()->with('error', trans('cruds.productVariant.fields.variant_exists', ['sku' => $modelExist->sku]))->withInput();;
                    }
                }
            }
            $productId = $productVariant->product->id;
            $productVariant->update($request->all());
    
            if ($request->input('photo', false)) {
                if (!$productVariant->photo || $request->input('photo') !== $productVariant->photo->file_name) {
                    if ($productVariant->photo) {
                        $productVariant->photo->delete();
                    }
                    $productVariant->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
                }
            } elseif ($productVariant->photo) {
                $productVariant->photo->delete();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        
        return redirect()->route('admin.products.edit', $productId);
    }

    public function show(ProductVariant $productVariant)
    {
        abort_if(Gate::denies('product_variant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productVariant->load('product', 'color', 'size');

        return view('admin.productVariants.show', compact('productVariant'));
    }

    public function destroy(ProductVariant $productVariant)
    {
        abort_if(Gate::denies('product_variant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productVariant->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductVariantRequest $request)
    {
        ProductVariant::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_variant_create') && Gate::denies('product_variant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductVariant();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function statusChange(Request $request)
    {
        $model = ProductVariant::findOrFail(request('id'));
        $status = request('status');

        $model->update([
            'status' => ($status == 1)? "2":"1",
        ]);

        return back();
    }
}
