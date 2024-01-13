<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBonusTeamCarRequest;
use App\Models\BonusTeamCar;

class BonusTeamCarController extends Controller
{
    public function update(UpdateBonusTeamCarRequest $request, BonusTeamCar $bonusTeamCar)
    {
        $bonusTeamCar->update($request->all());
        
        return redirect()->route('admin.bonus-settings.index')->with('tab', 'bonus7');
    }
}
