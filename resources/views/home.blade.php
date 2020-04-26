@extends('layouts.app')

@section('content')
<table-component class="py-5"
	:items="{{ json_encode($items) }}" 
    :players="{{ json_encode($players) }}" 
    >
</table-component>

@endsection
