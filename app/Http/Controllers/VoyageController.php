<?php

namespace App\Http\Controllers;

use App\Services\VoyageService;
use Exception;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    private $voyageService;

    public function __construct(VoyageService $voyageService)
    {
        $this->voyageService = $voyageService;
    }

    public function create(Request $request) {
        $data = $request->only(["vessel_id", "start", "end", "revenues", "expenses"]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->voyageService->create($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function update(Request $request, $id) {
        $data = $request->only(["vessel_id", "start", "status", "end", "revenues", "expenses"]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->voyageService->update($id, $data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
