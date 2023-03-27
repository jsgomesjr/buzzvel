@extends('layouts.system')
@section('body')
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6">
            <div class="card bg-dark">
                <div class="card-body p-4 p-sm-5">
                    <div class="row flex-between-center mb-3">
                        <div class="col-12 text-center">
                            <h3 class="text-light">Hello, welcome to my page!</h3>
                            <h3 class="text-light">My name is <span class="text-warning">{{ @$object->name }}</span></h3>
                            <h6 class="text-light pt-3">You can find me on:</h6>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <a href="{{ @$object->linkedin }}" target="_blank"><button
                                class="btn btn-lg btn-primary">LinkedIn</button></a>
                        <a href="{{ @$object->github }}" target="_blank"><button
                                class="btn btn-lg btn-secondary">GitHub</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('inject_scripts')
    @include('screens.people_information.script')
@endsection
@endsection
