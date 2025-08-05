@extends('client.layouts.app')
@section('content')
    <div class="max-w-[1300px] mx-auto p-4">
            {!! $about->about_uz !!}
    </div>
@endsection



@push('structured-data')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
@endpush

@push('scripts')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush
