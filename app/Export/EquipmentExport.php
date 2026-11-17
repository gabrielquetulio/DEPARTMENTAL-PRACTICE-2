<?php

namespace App\Http\Controllers;

use App\Exports\EquipmentExport;
use App\Models\Equipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    private const TITLES = [
        'available'   => 'Available Equipment',
        'unavailable' => 'Unavailable Equipment',
        'category'    => 'Equipment by Category',
        'price'       => 'Equipment Price List',
    ];

    // One query shared by the page, PDF and Excel so exports always match the filters
    private function query(Request $r)
    {
        $q = Equipment::query();

        if ($r->report === 'available')   $q->where('availability_status', 'available');
        if ($r->report === 'unavailable') $q->where('availability_status', 'unavailable');

        if ($r->filled('category')) $q->where('category', $r->category);
        if ($r->filled('status'))   $q->where('availability_status', $r->status);

        return $q->orderBy('equipment_name');
    }

    private function title(Request $r): string
    {
        return self::TITLES[$r->report] ?? self::TITLES['price'];
    }

    public function index(Request $r)
    {
        return view('reports.index', [
            'rows'   => $this->query($r)->get(),
            'title'  => $this->title($r),
            'titles' => self::TITLES,
        ]);
    }

    public function pdf(Request $r)
    {
        return Pdf::loadView('reports.pdf', [
            'rows'  => $this->query($r)->get(),
            'title' => $this->title($r),
        ])->download('equipment-report.pdf');
    }

    public function excel(Request $r)
    {
        return Excel::download(new EquipmentExport($this->query($r)->get()), 'equipment-report.xlsx');
    }
}