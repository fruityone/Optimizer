@extends('Layouts.header')
@section('title')
    Home page
    @endsection

<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            @include('Layouts.navigation-links')
            <h3>Request an update for json</h3>
            <p class="blue-text">Please paste here your token and json instructions<br> so that we can personalize you and save the info.</p>
            <div class="card">
                @foreach($errors->all() as $key => $error)
                    <div  style="position: relative">
                            <p>{{$error}}</p>
                @endforeach
{{--                @if(isset($response))--}}
{{--                    <h1>Json report id:{{$response['id']}}</h1>--}}
{{--                    <h1>Memory : {{$response['memory']}}</h1>--}}
{{--                    <h1>Time : {{$response['time']}}</h1>--}}
{{--                    @endif--}}
                <h5 class="text-center mb-4">Save your json</h5>
                @if(session('message'))
                    <h1 style="color:green;">SUCCESSFULLY UPDATED</h1>
                @endif
                <form class="form-card" action="{{route('update-json-report')}}" method='{{$method}}' id="myForm">
                    @csrf
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Request method<span class="text-danger"> *</span></label>
                            <label for="job"></label>
                            <select name="method"  onchange="document.getElementById('myForm').method = this.value;">
                                <option value="post">Post</option>
                                <option value="get">Get</option></select></div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Token<span class="text-danger"> *</span></label>
                            <label for="job"></label><textarea type="text" id="job" name="token" placeholder="" cols="20" rows="20"> </textarea></div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Token<span class="text-danger"> *</span></label>
                            <label for="job"></label><input type="text" id="jsonId" name="jsonId" placeholder="Please,input json id from DB"></div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex"> <label class="form-control-label px-3">Type here your json valid instructions<span class="text-danger"> *</span></label>
                            <label for="ans"></label><textarea rows='10' type="text" id="instructions" name="instructions" placeholder=""></textarea> </div>
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
