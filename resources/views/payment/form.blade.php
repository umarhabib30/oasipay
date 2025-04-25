@extends('layouts.app')
@section('content')
<div class="iframe_div" style="width: 100%; height: 100vh; overflow: hidden; position: relative;">
    <iframe src="{{ $url }}" frameborder="0" width="100%" height="100%"></iframe>

</div>

@endsection
