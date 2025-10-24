@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-3">Pridať diel</h1>
    <form action="{{ route('parts.store') }}" method="POST" class="card card-body">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Názov dielu</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required maxlength="255" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Serial number</label>
                <input type="text" class="form-control" name="serialnumber" value="{{ old('serialnumber') }}" required maxlength="255" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Auto</label>
                <select name="car_id" class="form-select" required>
                    <option value="" disabled @selected(!old('car_id'))>Vyber auto…</option>
                    @foreach($cars as $c)
                        <option value="{{ $c->id }}" @selected(old('car_id', request('car_id')) == $c->id)>
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
