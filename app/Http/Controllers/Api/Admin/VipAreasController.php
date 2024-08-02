<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VipAreas\StoreUserVipAreaRequest;
use App\Http\Requests\Admin\VipAreas\StoreVipAreaRequest;
use App\Http\Requests\Admin\VipAreas\UpdateVipAreaRequest;
use App\Models\UserVipArea;
use App\Models\VipArea;
use App\Repositories\VipAreasRepository;
use Illuminate\Http\Request;

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
        $areas = $this->vipAreasRepository->all();
        return response()->json($areas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVipAreaRequest $request)
    {
        $data = $request->validated();
        $area = $this->vipAreasRepository->create($data);
        return response()->json($area, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VipArea $vipArea)
    {
        $area = $this->vipAreasRepository->find($vipArea->id);
        return response()->json($area);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVipAreaRequest $request, VipArea $vipArea)
    {
        $data = $request->validated();
        $area = $this->vipAreasRepository->update($vipArea->id, $data);
        return response()->json($area);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VipArea $vipArea)
    {
        $this->vipAreasRepository->delete($vipArea->id);
        return response()->noContent();
    }

    public function addUser(VipArea $vipArea, StoreUserVipAreaRequest $request)
    {
        $input = $request->validated();

        UserVipArea::updateOrCreate([
            'user_id' => $input['user_id'],
            'vip_area_id' => $vipArea->id
        ], []);

        return response()->json([
            'message' => __("Usuário adicionado com sucesso à área Vip")
        ], 201);
    }

    public function removeUser(VipArea $vipArea, StoreUserVipAreaRequest $request)
    {
        $input = $request->validated();

        UserVipArea::where([
            'user_id' => $input['user_id'],
            'vip_area_id' => $vipArea->id
        ])->delete();

        return response()->json([
            'message' => __("Usuário removido com sucesso da área Vip")
        ], 204);
    }
}
