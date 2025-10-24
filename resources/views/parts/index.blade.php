@extends('layouts.app')


@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Diely</h1>
        <a href="{{ route('parts.create') }}" class="btn btn-primary">Pridať diel</a>
    </div>


    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" class="form-control" name="q" placeholder="Hľadať podľa názvu/serialu" value="{{ request('q') }}" />
        </div>
        <div class="col-md-4">
            <select name="car_id" class="form-select">
                <option value="">Auto: všetky</option>
                @foreach($cars as $c)
                    <option value="{{ $c->id }}" @selected(request('car_id') == $c->id)>
                        {{ $c->name }} @if($c->registration_number) ({{ $c->registration_number }}) @endif
                    </option>
                @endforeach
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
                <th>Serial</th>
                <th>Auto</th>
                <th class="text-end">Akcie</th>
            </tr>
            </thead>
            <tbody>
            @forelse($parts as $part)
                <tr>
                    <td>{{ $part->id }}</td>
                    <td>{{ $part->name }}</td>
                    <td>{{ $part->serialnumber }}</td>
                    <td>
                        @if($part->car)
                            <a href="{{ route('cars.show', $part->car) }}">{{ $part->car->name }}</a>
                        @else
                            —
                        @endif
                    </td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('parts.edit', $part) }}">Upraviť</a>
                        <form action="{{ route('parts.destroy', $part) }}" method="POST" class="d-inline" onsubmit="return confirm('Naozaj zmazať?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Zmazať</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Žiadne diely.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>


    {{ $parts->links() }}
@endsection
