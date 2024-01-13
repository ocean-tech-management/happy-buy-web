<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonusFirstUplineRequest;
use App\Http\Requests\UpdateBonusFirstUplineRequest;
use App\Models\BonusFirstUpline;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BonusFirstUplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Is under Bonus Join Section
        abort_if(Gate::denies('bonus_join_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BonusFirstUpline::query()->select(sprintf('%s.*', (new BonusFirstUpline())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bonus_join_show';
                $editGate = 'bonus_join_edit';
                $deleteGate = 'bonus_join_delete';
                $crudRoutePart = 'bonus-first-upline';

                return view('partials.datatablesActions_BonusFirstUpline', compact(
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
            $table->editColumn('referral_count', function ($row) {
                return $row->referral_count ? $row->referral_count : '';
            });
            $table->editColumn('bonus_amount', function ($row) {
                return $row->bonus_amount ? $row->bonus_amount : '';
            });
            $table->editColumn('extra_top_up_bonus', function ($row) {
                return $row->extra_top_up_bonus ? $row->extra_top_up_bonus : '';
            });
            $table->editColumn('top_up_count', function ($row) {
                return $row->top_up_count ? $row->top_up_count : '';
            });
            $table->editColumn('days', function ($row) {
                return $row->days ? $row->days : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? BonusFirstUpline::STATUS_SELECT[$row->status] : '-';
            });

            $table->rawColumns(['actions', 'placeholder', 'status']);

            return $table->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBonusFirstUplineRequest $request)
    {
        $bonusFirstUpline = BonusFirstUpline::create($request->all());

        return response()->json([
            'responseCode' => 200,
            'msgType' => 'success',
            'message' => trans('global.record_created')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $id = $request->input('bonus_first_upline_id');
        $bonusFirstUpline = BonusFirstUpline::findOrFail($id);

        $output = array(
            'edit_bonus_first_upline_id' => $bonusFirstUpline->id,
            'edit_bonus_first_upline_referral_count' => $bonusFirstUpline->referral_count,
            'edit_bonus_first_upline_bonus_amount' => $bonusFirstUpline->bonus_amount,
            'edit_bonus_first_upline_extra_top_up_bonus' => $bonusFirstUpline->extra_top_up_bonus,
            'edit_bonus_first_upline_top_up_count' => $bonusFirstUpline->top_up_count,
            'edit_bonus_first_upline_days' => $bonusFirstUpline->days,
            'edit_bonus_first_upline_status' => $bonusFirstUpline->status,
        );

        echo json_encode($output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBonusFirstUplineRequest $request)
    {
        $edit_id = $request->edit_bonus_first_upline_id;

        $bonus_first_upline = BonusFirstUpline::findOrFail($edit_id)->update($request->all());

        return response()->json([
            'responseCode' => 200,
            'msgType' => 'success',
            'message' => trans('global.record_updated')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
