<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPickUpLocationRequest;
use App\Http\Requests\StorePickUpLocationRequest;
use App\Http\Requests\UpdatePickUpLocationRequest;
use App\Models\Country;
use App\Models\PickUpLocation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PickUpLocationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('pick_up_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PickUpLocation::with(['country'])->select(sprintf('%s.*', (new PickUpLocation())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pick_up_location_show';
                $editGate = 'pick_up_location_edit';
                $deleteGate = 'pick_up_location_delete';
                $crudRoutePart = 'pick-up-locations';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? PickUpLocation::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'country']);

            return $table->make(true);
        }

        return view('admin.pickUpLocations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pick_up_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::whereStatus(1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pickUpLocations.create', compact('countries'));
    }

    public function store(StorePickUpLocationRequest $request)
    {
        $pickUpLocation = PickUpLocation::create($request->all());

        return redirect()->route('admin.pick-up-locations.index');
    }

    public function edit(PickUpLocation $pickUpLocation)
    {
        abort_if(Gate::denies('pick_up_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::whereStatus(1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pickUpLocation->load('country');

        return view('admin.pickUpLocations.edit', compact('countries', 'pickUpLocation'));
    }

    public function update(UpdatePickUpLocationRequest $request, PickUpLocation $pickUpLocation)
    {
        $pickUpLocation->update($request->all());

        return redirect()->route('admin.pick-up-locations.index');
    }

    public function show(PickUpLocation $pickUpLocation)
    {
        abort_if(Gate::denies('pick_up_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pickUpLocation->load('country');

        return view('admin.pickUpLocations.show', compact('pickUpLocation'));
    }

    public function destroy(PickUpLocation $pickUpLocation)
    {
        abort_if(Gate::denies('pick_up_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pickUpLocation->delete();

        return back();
    }

    public function massDestroy(MassDestroyPickUpLocationRequest $request)
    {
        PickUpLocation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
