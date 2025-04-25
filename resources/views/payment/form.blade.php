@extends('layouts.app')
@section('script')
<script>
    window.location.href = "{{ $url }}";
</script>
@endsection
