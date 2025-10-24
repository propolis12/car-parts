@extends('layouts.app')


@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Autá</h1>
        <a href="{{ route('cars.create') }}" class="btn btn-primary">Pridať auto</a>
    </div>


    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" class="form-control" name="q" placeholder="Hľadať podľa názvu/EČV" value="{{ request('q') }}" />
        </div>
        <div class="col-md-3">
            <select name="registered" class="form-select">
                <option value="">Registrované: všetky</option>
                <option value="1" @selected(request('registered')==='1')>Len registrované</option>
                <option value="0" @selected(request('registered')==='0')>Len neregistrované</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-secondary w-100" type="submit">Filtrovať</button>
        </div>
    </form>


    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>Názov</th>
                <th>EČV</th>
                <th>Registrované</th>
                <th class="text-end">Akcie</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td><a href="{{ route('cars.show', $car) }}">{{ $car->name }}</a></td>
                    <td>{{ $car->registration_number }}</td>
                    <td>
                        @if($car->is_registered)
                            <span class="badge bg-success">Áno</span>
                        @else
                            <span class="badge bg-secondary">Nie</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('cars.edit', $car) }}">Upraviť</a>
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline" onsubmit="return confirm('Naozaj zmazať?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Zmazať</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Žiadne autá.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>


    {{ $cars->links() }}
@endsection
