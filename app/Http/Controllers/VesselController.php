<?php

namespace App\Http\Controllers;

use App\Services\VesselOpexService;
use App\Services\VesselService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class VesselController extends Controller
{

    private $vesselService;
    private $vesselOpexService;

    public function __construct(VesselService $vesselService, VesselOpexService $vesselOpexService)
    {
        $this->vesselService = $vesselService;
        $this->vesselOpexService = $vesselOpexService;
    }

    public function createOpex(Request $request, Integer $vessel_id) {

    }

    public function generateFinancialReport(Request $request, Integer $vessel_id) {

    }
}
