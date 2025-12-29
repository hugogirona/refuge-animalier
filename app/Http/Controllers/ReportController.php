<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use App\Models\Pet;
use App\Enums\PetStatus;
use App\Enums\AdoptionRequestStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function downloadMonthlyReport(Request $request)
    {
        $date = $request->has('month')
            ? Carbon::parse($request->month)
            : now()->subMonth();

        $start = $date->copy()->startOfMonth();
        $end = $date->copy()->endOfMonth();


        $arrivedCount = Pet::whereBetween('arrived_at', [$start, $end])->count();

        $adoptedCount = AdoptionRequest::where('status', AdoptionRequestStatus::ACCEPTED)
            ->whereBetween('adopted_at', [$start, $end])
            ->count();
        
        $currentInShelterCount = Pet::whereIn('status', [PetStatus::AVAILABLE, PetStatus::IN_CARE, PetStatus::ADOPTION_PENDING])->count();


        // 3. Générer le PDF
        $pdf = Pdf::loadView('pdf.monthly-report', [
            'monthName' => $date->translatedFormat('F Y'),
            'arrivedCount' => $arrivedCount,
            'adoptedCount' => $adoptedCount,
            'currentInShelterCount' => $currentInShelterCount,
            'generatedAt' => now()->format('d/m/Y'),
        ]);

        return $pdf->download('Rapport-Activite-' . $date->format('m-Y') . '.pdf');
    }
}
