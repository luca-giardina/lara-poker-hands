@extends('layouts.app')

@section('content')

<table-component class="py-5"
    :items="{{ json_encode($items) }}" 
    :clients="{{ $clients }}" 
    :deals="{{ $deals }}"
    :selectedclient="{{ request()->client ?? 0}}"
    :selecteddeal="{{ request()->deal ?? 0}}"
    >
</import-component>

@endsection
