<?php

namespace App\Http\Controllers;

use App\Http\Requests\SodaRequest;
use App\Services\SodaService;

class SodaController extends Controller
{
    private $sodaService;

    public function __construct(SodaService $sodaService)
    {
        $this->sodaService = $sodaService;
    }

    public function index()
    {
        $sodas = $this->sodaService->getPaginatedSodaList(1);
        return view('sodas.index', compact('sodas'));
    }

    public function create()
    {
        return view('sodas.create');
    }

    public function store(SodaRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            throw new \ErrorException($request->validator->messages());
        }

        $this->sodaService->createSoda($request->all());

        return redirect()->route('sodas.index')
                        ->with('success','Refrigerante adicionado com sucesso!');
    }

    public function show($id)
    {
        $soda = $this->sodaService->getSodaById($id);
        return view('sodas.show',compact('soda'));
    }

    public function edit($id)
    {
        $soda = $this->sodaService->getSodaById($id);
        return view('sodas.edit',compact('soda'));
    }

    public function update(SodaRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            throw new \ErrorException($request->validator->messages());
        }

        $this->sodaService->updateSoda($request->all(), $id);

        return redirect()->route('sodas.index')
                        ->with('success','Refrigerante atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->sodaService->deleteSoda($id);

        return redirect()->route('sodas.index')
                        ->with('success','Refrigerante excluido com sucesso!');
    }
}
