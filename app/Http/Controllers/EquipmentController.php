<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $equipment = Equipment::with('user')->latest()->paginate(10);

        return view('equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('equipment.create', [
            'categories' => Equipment::CATEGORIES,
            'statuses'   => Equipment::STATUSES,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EquipmentRequest $request): RedirectResponse
    {
        // user_id is set automatically from the logged-in user
        $request->user()->equipment()->create($request->validated());

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment): View
    {
        return view('equipment.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment): View
    {
        return view('equipment.edit', [
            'equipment'  => $equipment,
            'categories' => Equipment::CATEGORIES,
            'statuses'   => Equipment::STATUSES,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipmentRequest $request, Equipment $equipment): RedirectResponse
    {
        $equipment->update($request->validated());

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment): RedirectResponse
    {
        $equipment->delete();

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }
}