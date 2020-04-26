@extends('layouts.app')

@section('content')
@if(session()->get('message'))
    <div class="alert alert-success">
       {{ session()->get('message') }}
    </div>
@endif
<import-component>
</import-component />


@endsection
