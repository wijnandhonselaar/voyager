<?php

namespace App\Http\Controllers;

use App\Services\VesselOpexService;
use App\Services\VoyageService;
use Exception;
use Illuminate\Http\Request;

class VesselOpexController extends Controller
{

    private $vesselOpexService;
    private $voyageService;

    public function __construct(VesselOpexService $vesselOpexService, VoyageService $voyageService )
    {
        $this->vesselOpexService = $vesselOpexService;
        $this->voyageService = $voyageService;
    }

    public function createOpex(Request $request, int $vessel_id) {
        $data = $request->only(["date", "expenses"]);
        $data["vessel_id"] = $vessel_id;
        $result = ["status" => 200];

        try {
            $res = $this->vesselOpexService->create($data);
            $result["data"] = $res;
            if(isset($res->id)) {
                $this->voyageService->updateVoyageProfitByDate($res->vessel_id, $res->date, $res->expenses);
            } else {
                $result["status"] = 400;
            }
        } catch (Exception $e) {
            $result = [
                "status" => 500,
                "error" => $e->getMessage()
            ];
        }

        return response()->json($result, $result["status"]);
    }

    public function generateFinancialReport(Request $request, int $vessel_id) {

    }
}
