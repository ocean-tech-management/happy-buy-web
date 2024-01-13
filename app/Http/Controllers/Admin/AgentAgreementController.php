<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAgentAgreementRequest;
use App\Http\Requests\StoreAgentAgreementRequest;
use App\Http\Requests\UpdateAgentAgreementRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgentAgreementController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('agent_agreement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agentAgreements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('agent_agreement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agentAgreements.create');
    }

    public function store(StoreAgentAgreementRequest $request)
    {
        $agentAgreement = AgentAgreement::create($request->all());

        return redirect()->route('admin.agent-agreements.index');
    }

    public function edit(AgentAgreement $agentAgreement)
    {
        abort_if(Gate::denies('agent_agreement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agentAgreements.edit', compact('agentAgreement'));
    }

    public function update(UpdateAgentAgreementRequest $request, AgentAgreement $agentAgreement)
    {
        $agentAgreement->update($request->all());

        return redirect()->route('admin.agent-agreements.index');
    }

    public function show(AgentAgreement $agentAgreement)
    {
        abort_if(Gate::denies('agent_agreement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agentAgreements.show', compact('agentAgreement'));
    }

    public function destroy(AgentAgreement $agentAgreement)
    {
        abort_if(Gate::denies('agent_agreement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agentAgreement->delete();

        return back();
    }

    public function massDestroy(MassDestroyAgentAgreementRequest $request)
    {
        AgentAgreement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
