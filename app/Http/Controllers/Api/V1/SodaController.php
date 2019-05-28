<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
        return $this->sodaService->getPaginatedSodaList(1);
    }

    public function store(SodaRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            throw new \ErrorException($request->validator->messages());
        }

        return $this->sodaService->createSoda($request->all());

    }

    public function show($id)
    {
        return $this->sodaService->getSodaById($id);
    }

    public function update(SodaRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            throw new \ErrorException($request->validator->messages());
        }

        $this->sodaService->updateSoda($request->all(), $id);
    }

    public function destroy($id)
    {
        $this->sodaService->deleteSoda($id);
    }
}
