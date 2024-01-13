<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBonusTeamHouseRequest;
use App\Models\BonusTeamHouse;

class BonusTeamHouseController extends Controller
{
    public function update(UpdateBonusTeamHouseRequest $request, BonusTeamHouse $bonusTeamHouse)
    {
        $bonusTeamHouse->update($request->all());
        
        return redirect()->route('admin.bonus-settings.index')->with('tab', 'bonus8');
    }
}
