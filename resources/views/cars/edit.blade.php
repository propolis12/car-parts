@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Upraviť auto</h1>

    @php
        /** @var \App\Models\Car $car */
        $initial = [
          'name' => old('name', $car->name),
          'is_registered' => (bool) old('is_registered', $car->is_registered),
          'registration_number' => old('registration_number', $car->registration_number),
        ];
    @endphp

    <form action="{{ route('cars.update', $car) }}" method="POST" class="card card-body">
        @csrf
        @method('PUT')

        <div id="car-form"
             data-initial='@json($initial, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_AMP|JSON_HEX_QUOT)'>
        </div>

        <div class="mt-3 d-flex gap-2">
            <a href="{{ route('cars.index') }}" class="btn btn-light">Späť</a>
            <button class="btn btn-primary">Uložiť</button>
        </div>
    </form>
@endsection
