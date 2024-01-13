<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['category'])->whereNull('parent_id')->search($request)->select(sprintf('%s.*', (new Product())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_show';
                $editGate = 'product_edit';
                $deleteGate = 'product_delete';
                $createVariantGate = 'product_variant_create';
                $statusChangeGate = 'product_status_change';
                $crudRoutePart = 'products';

                return view('partials.datatablesActions_Product', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'createVariantGate',
                'statusChangeGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name_en', function ($row) {
                return $row->name_en ? $row->name_en : '';
            });
            $table->editColumn('name_zh', function ($row) {
                return $row->name_zh ? $row->name_zh : '';
            });
            $table->editColumn('image_1', function ($row) {
                if ($photo = $row->image_1) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('image_2', function ($row) {
                if ($photo = $row->image_2) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('image_3', function ($row) {
                if ($photo = $row->image_3) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('image_4', function ($row) {
                if ($photo = $row->image_4) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('image_5', function ($row) {
                if ($photo = $row->image_5) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Product::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('category_name_en', function ($row) {
                return $row->category ? $row->category->name_en : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'category']);

            return $table->make(true);
        }

        return view('admin.products.index');
    }

    public function packageIndex(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['category'])->whereNotNull('parent_id')->search($request)->select(sprintf('%s.*', (new Product())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_show';
                $editGate = 'product_edit';
                $deleteGate = 'product_delete';
                $createVariantGate = 'product_variant_create';
                $statusChangeGate = 'product_status_change';
                $crudRoutePart = 'products';

                return view('partials.datatablesActions_Product', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'createVariantGate',
                    'statusChangeGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name_en', function ($row) {
                return $row->name_en ? $row->name_en : '';
            });
            $table->editColumn('name_zh', function ($row) {
                return $row->name_zh ? $row->name_zh : '';
            });
            $table->editColumn('image_1', function ($row) {
                if ($photo = $row->image_1) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('image_2', function ($row) {
                if ($photo = $row->image_2) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('image_3', function ($row) {
                if ($photo = $row->image_3) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('image_4', function ($row) {
                if ($photo = $row->image_4) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('image_5', function ($row) {
                if ($photo = $row->image_5) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Product::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('category_name_en', function ($row) {
                return $row->category ? $row->category->name_en : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'category']);

            return $table->make(true);
        }

        return view('admin.products.package_index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_lists = Product::whereType(1)->where('status', 1)->orWhereNull('type')->pluck('name_en', 'id'); // Pluck Individual Only

        return view('admin.products.create', compact('categories', 'product_lists'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        if($request->type == 2){
            $product->product_list()->sync($request->input('product_list', []));
        }

        if ($request->input('image_1', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_1'))))->toMediaCollection('image_1');
        }

        if ($request->input('image_2', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_2'))))->toMediaCollection('image_2');
        }

        if ($request->input('image_3', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_3'))))->toMediaCollection('image_3');
        }

        if ($request->input('image_4', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_4'))))->toMediaCollection('image_4');
        }

        if ($request->input('image_5', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_5'))))->toMediaCollection('image_5');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product->load('category','variant', 'product_list');

        $product_lists = Product::whereType(1)->where('status', 1)->orWhereNull('type')->pluck('name_en', 'id'); // Pluck Individual Only

        foreach($product->variant as $item) {
            $item->type = ProductVariant::TYPE_SELECT[$item->type];
        }
        return view('admin.products.edit', compact('categories', 'product', 'product_lists'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        if($request->type == 2){
            $product->product_list()->sync($request->input('product_list', []));
        }

        if ($request->input('image_1', false)) {
            if (!$product->image_1 || $request->input('image_1') !== $product->image_1->file_name) {
                if ($product->image_1) {
                    $product->image_1->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_1'))))->toMediaCollection('image_1');
            }
        } elseif ($product->image_1) {
            $product->image_1->delete();
        }

        if ($request->input('image_2', false)) {
            if (!$product->image_2 || $request->input('image_2') !== $product->image_2->file_name) {
                if ($product->image_2) {
                    $product->image_2->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_2'))))->toMediaCollection('image_2');
            }
        } elseif ($product->image_2) {
            $product->image_2->delete();
        }

        if ($request->input('image_3', false)) {
            if (!$product->image_3 || $request->input('image_3') !== $product->image_3->file_name) {
                if ($product->image_3) {
                    $product->image_3->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_3'))))->toMediaCollection('image_3');
            }
        } elseif ($product->image_3) {
            $product->image_3->delete();
        }

        if ($request->input('image_4', false)) {
            if (!$product->image_4 || $request->input('image_4') !== $product->image_4->file_name) {
                if ($product->image_4) {
                    $product->image_4->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_4'))))->toMediaCollection('image_4');
            }
        } elseif ($product->image_4) {
            $product->image_4->delete();
        }

        if ($request->input('image_5', false)) {
            if (!$product->image_5 || $request->input('image_5') !== $product->image_5->file_name) {
                if ($product->image_5) {
                    $product->image_5->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image_5'))))->toMediaCollection('image_5');
            }
        } elseif ($product->image_5) {
            $product->image_5->delete();
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('category');

        $variants = ProductVariant::whereProductId($product->id)->orderBy('color_id', 'asc')->orderBy('size_id', 'asc')->get();

        return view('admin.products.show', compact('product','variants'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function changeStatus(Request $request)
    {
        $model = Product::findOrFail(request('id'));

        $model->update([
            'status' => request('status')
        ]);

        return back();
    }
}
