@extends('admin.layout.master')

@section('title')
    Reviews & Ratings
@endsection

@push('styles')
    <link href="{{ asset('assets/css/reviews.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="reviews-wrapper px-3 px-md-4">
        @php
            $tab = request('tab', 'drivers');
        @endphp

        @if($tab === 'passengers')
            @include('admin.reviews.passengers')
        @else
            @include('admin.reviews.drivers')
        @endif
    </div>
</div>
@endsection
