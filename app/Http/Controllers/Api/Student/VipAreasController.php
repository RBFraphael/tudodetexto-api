<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\VipArea;
use App\Repositories\VipAreasRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VipAreasController extends Controller
{
    public function __construct(
        private VipAreasRepository $vipAreasRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vipAreas = $this->vipAreasRepository->currentUser()->all();
        return response()->json($vipAreas);
    }

    /**
     * Display the specified resource.
     */
    public function show(VipArea $vipArea)
    {
        $vipArea = $this->vipAreasRepository->currentUser()->find($vipArea->id);
        if ($vipArea) {
            return response()->json($vipArea);
        }

        return new NotFoundHttpException(__("Área VIP não encontrada"));
    }
}
