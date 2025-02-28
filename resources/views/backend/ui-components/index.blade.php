@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body text-center p-5">
                        <img src="{{asset('/images/no-data.svg')}}" class="w220" alt="No Data">
                        <div class="mt-4 mb-3">
                            <span class="text-muted">No data to show</span>
                        </div>
                        <a href="{{url()->previous()}}" type="button" class="btn btn-white border lift">Get Started</a>
                        <a href="{{route('admin.dashboard')}}" class="btn btn-primary border lift">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
