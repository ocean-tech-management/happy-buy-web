<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEnquiryReplyRequest;
use App\Http\Requests\StoreEnquiryReplyRequest;
use App\Http\Requests\UpdateEnquiryReplyRequest;
use App\Models\Admin;
use App\Models\Enquiry;
use App\Models\EnquiryReply;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EnquiryReplyController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('enquiry_reply_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EnquiryReply::with(['enquiry', 'admin'])->search($request)->select(sprintf('%s.*', (new EnquiryReply())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'enquiry_reply_show';
                $editGate = 'enquiry_reply_edit';
                $deleteGate = 'enquiry_reply_delete';
                $crudRoutePart = 'enquiry-replies';

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
            $table->addColumn('enquiry_message', function ($row) {
                return $row->enquiry ? $row->enquiry->message : '';
            });

            $table->addColumn('admin_name', function ($row) {
                return $row->admin ? $row->admin->name : '';
            });

            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'enquiry', 'admin']);

            return $table->make(true);
        }

        return view('admin.enquiryReplies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('enquiry_reply_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiries = Enquiry::all()->pluck('message', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = Admin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.enquiryReplies.create', compact('enquiries', 'admins'));
    }

    public function store(StoreEnquiryReplyRequest $request)
    {
        $enquiryReply = EnquiryReply::create($request->all());

        return redirect()->route('admin.enquiry-replies.index');
    }

    public function edit(EnquiryReply $enquiryReply)
    {
        abort_if(Gate::denies('enquiry_reply_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiries = Enquiry::all()->pluck('message', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = Admin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $enquiryReply->load('enquiry', 'admin');

        return view('admin.enquiryReplies.edit', compact('enquiries', 'admins', 'enquiryReply'));
    }

    public function update(UpdateEnquiryReplyRequest $request, EnquiryReply $enquiryReply)
    {
        $enquiryReply->update($request->all());

        return redirect()->route('admin.enquiry-replies.index');
    }

    public function show(EnquiryReply $enquiryReply)
    {
        abort_if(Gate::denies('enquiry_reply_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiryReply->load('enquiry', 'admin');

        return view('admin.enquiryReplies.show', compact('enquiryReply'));
    }

    public function destroy(EnquiryReply $enquiryReply)
    {
        abort_if(Gate::denies('enquiry_reply_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiryReply->delete();

        return back();
    }

    public function massDestroy(MassDestroyEnquiryReplyRequest $request)
    {
        EnquiryReply::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
