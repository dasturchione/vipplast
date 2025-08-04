@extends('client.layouts.app')
@section('content')
    <div class="">
        <div class="p-4">
            <div class="flow-root ...">
                <div class="my-4 ...">Well, let me tell you something, ...</div>
            </div>
            <div class="flow-root ...">
                <div class="my-4 ...">Sure, go ahead, laugh if you want...</div>
            </div>
        </div>
    </div>
@endsection



@push('structured-data')
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
@endpush

@push('scripts')
    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endpush
