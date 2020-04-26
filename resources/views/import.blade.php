@extends('layouts.app')

@section('content')
@if($error ?? false)
    <div class="alert alert-warning">
       Error
    </div>
@elseif($success ?? false)
    <div class="alert alert-success">
       File uploaded
    </div>
@endif

<import-component>
</import-component />


@endsection
