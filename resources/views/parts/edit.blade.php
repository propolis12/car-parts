@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-3">Upraviť diel</h1>
    <form action="{{ route('parts.update', $part) }}" method="POST" class="card card-body">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Názov dielu</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $part->name) }}" required maxlength="255" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Serial number</label>
                <input type="text" class="form-control" name="serialnumber" value="{{ old('serialnumber', $part->serialnumber) }}" required maxlength="255" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Auto</label>
                <select name="car_id" class="form-select" required>
                    @foreach($cars as $c)
                        <option value="{{ $c->id }}" @selected(old('car_id', $part->car_id) == $c->id)>
                            {{ $c->name }} @if($c->registration_number) ({{ $c->registration_number }}) @endif
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="mt-3 d-flex gap-2">
            <a href="{{ route('parts.index') }}" class="btn btn-light">Späť</a>
            <button class="btn btn-primary">Uložiť</button>
        </div>
    </form>
@endsection
