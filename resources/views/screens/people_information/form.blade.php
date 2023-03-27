@extends('layouts.system')
@section('body')
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6">
            <div class="card bg-dark">
                <div class="card-body p-4 p-sm-5">
                    <div class="row flex-between-center mb-3">
                        <div class="col-12 text-center">
                            <h3 class="text-warning">QR Code Image Generator</h3>
                        </div>
                    </div>
                    <form id="people_information_form" action="{{ route('generate.store') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-text">Name</div>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-text">Linkedin</div>
                            <input type="url" name="linkedin" class="form-control"
                                placeholder="Enter your LinkedIn profile URL">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-text">Github</div>
                            <input type="url" name="github" class="form-control"
                                placeholder="Enter your GitHub profile URL">
                        </div>
                        <div class="row pt-3 flex-between-center">
                            <div class="col-12">
                                <button class="btn btn-lg btn-success d-block w-100" type="submit" name="submit">Generate
                                    Image</button>
                            </div>
                        </div>
                    </form>

                    <div id="qrcode"></div>
                </div>
            </div>
        </div>
    </div>

@section('inject_scripts')
    @include('screens.people_information.script')
@endsection
@endsection
