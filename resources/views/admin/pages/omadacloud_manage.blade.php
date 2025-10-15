@extends('admin.layouts.app')
@section('omada-cloud-manage')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex flex-column align-items-center">
                <br><br>
                <br><br>
                <br><br>
                <img src="{{ asset('assets/img/undraw/undraw_not_found_60pq.svg') }}" width="250" alt="Page Not Found">
                <h2 class="h1 mt-4 mb-4 fw-bold">Sorry! page not found.</h2>
                <p class="text-center op-7 mb-5 h5">Website is Under Construction. Check back later!<br></p>
            </div>

        </div>
    </div>

    @push('omada-cloud-manage')
        <script></script>
    @endpush
@endsection
