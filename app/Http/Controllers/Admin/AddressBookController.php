<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAddressBookRequest;
use App\Http\Requests\StoreAddressBookRequest;
use App\Http\Requests\UpdateAddressBookRequest;
use App\Models\AddressBook;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddressBookController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('address_book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AddressBook::with(['user'])->search($request)->select(sprintf('%s.*', (new AddressBook())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'address_book_show';
                $editGate = 'address_book_edit';
                $deleteGate = 'address_book_delete';
                $crudRoutePart = 'address-books';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('address_1', function ($row) {
                return $row->address_1 ? $row->address_1 : '';
            });
            $table->editColumn('address_2', function ($row) {
                return $row->address_2 ? $row->address_2 : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->editColumn('postcode', function ($row) {
                return $row->postcode ? $row->postcode : '';
            });
            $table->editColumn('set_default', function ($row) {
                return $row->set_default ? AddressBook::SET_DEFAULT_SELECT[$row->set_default] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? AddressBook::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.addressBooks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('address_book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addressBooks.create', compact('users'));
    }

    public function store(StoreAddressBookRequest $request)
    {
        $addressBook = AddressBook::create($request->all());

        return redirect()->route('admin.address-books.index');
    }

    public function edit(AddressBook $addressBook)
    {
        abort_if(Gate::denies('address_book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addressBook->load('user');

        return view('admin.addressBooks.edit', compact('users', 'addressBook'));
    }

    public function update(UpdateAddressBookRequest $request, AddressBook $addressBook)
    {
        $addressBook->update($request->all());

        return redirect()->route('admin.address-books.index');
    }

    public function show(AddressBook $addressBook)
    {
        abort_if(Gate::denies('address_book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addressBook->load('user');

        return view('admin.addressBooks.show', compact('addressBook'));
    }

    public function destroy(AddressBook $addressBook)
    {
        abort_if(Gate::denies('address_book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addressBook->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddressBookRequest $request)
    {
        AddressBook::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
