<?php


namespace App\Http\Controllers;


use App\Http\Requests\PartRequest;
use App\Http\Requests\StorePartRequest;
use App\Http\Requests\UpdatePartRequest;
use App\Models\Car;
use App\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PartController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->string('q')->toString();
        $carId = $request->integer('car_id');


        $parts = Part::query()
            ->with('car')
            ->when($q, function ($query, $q) {
                $query->where(function ($w) use ($q) {
                    $w->where('name', 'like', "%{$q}%")
                        ->orWhere('serialnumber', 'like', "%{$q}%");
                });
            })
            ->when($carId, fn($q2) => $q2->where('car_id', $carId))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();


        $cars = Car::orderBy('name')->get(['id','name','registration_number']);


        return view('parts.index', compact('parts', 'cars', 'q', 'carId'));
    }


    public function create(): View
    {
        $cars = Car::orderBy('name')->get(['id','name','registration_number']);
        return view('parts.create', compact('cars'));
    }


    public function store(PartRequest $request): RedirectResponse
    {
        Part::create($request->validated());
        return redirect()->route('parts.index')->with('success', 'Diel bol vytvorený.');
    }


    public function edit(Part $part): View
    {
        $cars = Car::orderBy('name')->get(['id','name','registration_number']);
        return view('parts.edit', compact('part', 'cars'));
    }


    public function update(PartRequest $request, Part $part): RedirectResponse
    {
        $part->update($request->validated());
        return redirect()->route('parts.index')->with('success', 'Diel bol upravený.');
    }


    public function destroy(Part $part): RedirectResponse
    {
        $part->delete();
        return redirect()->route('parts.index')->with('success', 'Diel bol zmazaný.');
    }
}
