<?php


namespace App\Http\Controllers;


use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class CarController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->string('q')->toString();
        $registered = $request->filled('registered') ? $request->string('registered')->toString() : null; // '1' | '0' | null


        $cars = Car::query()
            ->when($q, function ($query, $q) {
                $query->where(function ($w) use ($q) {
                    $w->where('name', 'like', "%{$q}%")
                        ->orWhere('registration_number', 'like', "%{$q}%");
                });
            })
            ->when($registered !== null && in_array($registered, ['0','1'], true), function ($query) use ($registered) {
                $query->where('is_registered', $registered === '1');
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();


        return view('cars.index', compact('cars', 'q', 'registered'));
    }


    public function create(): View
    {
        return view('cars.create');
    }


    public function store(CarRequest $request): RedirectResponse
    {
        Car::create($request->validated());
        return redirect()->route('cars.index')->with('success', 'Auto bolo vytvorené.');
    }


    public function show(Car $car): View
    {
        $car->load('parts');
        return view('cars.show', compact('car'));
    }


    public function edit(Car $car): View
    {
        return view('cars.edit', compact('car'));
    }


    public function update(CarRequest $request, Car $car): RedirectResponse
    {
        $car->update($request->validated());
        return redirect()->route('cars.index')->with('success', 'Auto bolo upravené.');
    }


    public function destroy(Car $car): RedirectResponse
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Auto bolo zmazané.');
    }
}
