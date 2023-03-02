@extends('Layouts.header')
@section('title')
    Home page
    @endsection

<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Request a Demo</h3>
            <p class="blue-text">Please paste here your token and json<br> so that we can personalize you and save the info.</p>
            <div class="card">
                @if(isset($response))
                    <h1>Json report id:{{$response['id']}}</h1>
                    <h1>Memory : {{$response['memory']}}</h1>
                    <h1>Time : {{$response['time']}}</h1>
                    @endif
                <h5 class="text-center mb-4">Save your json</h5>
                @if(session('message'))
                    <h1 style="color:green;">SUCCESSFULLY ADDED</h1>
                @endif
                <form class="form-card" action="{{route('save-json-report')}}" method='{{$method}}' id="myForm">
                    @csrf
{{--                    <div class="row justify-content-between text-left">--}}
{{--                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">First name<span class="text-danger"> *</span></label> <input type="text" id="fname" name="fname" placeholder="Enter your first name" onblur="validate(1)"> </div>--}}
{{--                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Last name<span class="text-danger"> *</span></label> <input type="text" id="lname" name="lname" placeholder="Enter your last name" onblur="validate(2)"> </div>--}}
{{--                    </div>--}}
{{--                    <div class="row justify-content-between text-left">--}}
{{--                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Business email<span class="text-danger"> *</span></label> <input type="text" id="email" name="email" placeholder="" onblur="validate(3)"> </div>--}}
{{--                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Phone number<span class="text-danger"> *</span></label> <input type="text" id="mob" name="mob" placeholder="" onblur="validate(4)"> </div>--}}
{{--                    </div>--}}
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Request method<span class="text-danger"> *</span></label>
                            <label for="job"></label>
                            <select name="method"  onchange="document.getElementById('myForm').method = this.value;">
                                <option value="post">Post</option>
                                <option value="get">Get</option></select></div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Token<span class="text-danger"> *</span></label>
                            <label for="job"></label><textarea type="text" id="job" name="token" placeholder="" cols="20" rows="20" onblur="validate(5)"> </textarea></div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex"> <label class="form-control-label px-3">Type here your json<span class="text-danger"> *</span></label>
                            <label for="ans"></label><textarea rows='30' type="text" id="data" name="data" placeholder=""></textarea> </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">Save a json record</button> </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@include('Layouts.footer')
