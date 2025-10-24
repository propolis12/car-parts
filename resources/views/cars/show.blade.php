@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">{{ $car->name }}</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('cars.edit', $car) }}" class="btn btn-outline-primary">Upraviť</a>
            <a href="{{ route('parts.create', ['car_id' => $car->id]) }}" class="btn btn-primary">Pridať diel</a>
        </div>
    </div>


    <div class="mb-4">
        <div><strong>EČV:</strong> {{ $car->registration_number ?: '—' }}</div>
        <div><strong>Registrované:</strong> {{ $car->is_registered ? 'Áno' : 'Nie' }}</div>
    </div>


    <h2 class="h5">Diely</h2>
    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead><tr><th>#</th><th>Názov</th><th>Serial</th><th class="text-end">Akcie</th></tr></thead>
            <tbody>
            @forelse($car->parts as $part)
                <tr>
                    <td>{{ $part->id }}</td>
                    <td>{{ $part->name }}</td>
                    <td>{{ $part->serialnumber }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('parts.edit', $part) }}">Upraviť</a>
                        <form action="{{ route('parts.destroy', $part) }}" method="POST" class="d-inline" onsubmit="return confirm('Zmazať diel?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Zmazať</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Žiadne diely.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
