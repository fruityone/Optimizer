@extends('layouts.header')
@section('title')
    View all reports
@endsection
<style>
    ul ul {
        display: none;
    }
    ul{
        color:darkgreen;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('li:has(ul)').click(function(event) {
            if (this == event.target) {
                $(this).children('ul').toggle('slow');
            }
            return false;
        });
    });
</script>
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            @include('layouts.navigation-links')

            <h3>View all json reports</h3>
            <p class="blue-text">You can view here all json reports<br>Also you can delete them , if you want to update/add one -> go to links under.</p>
            @if(session('success'))
                <h1 style="color:green;">SUCCESSFULLY DELETED</h1>
            @endif
            <div class="card">
                @foreach($errors->all() as $key => $error)
                    <div  style="position: relative">
                        <p>{{$error}}</p>
                        @endforeach
                    </div>
                @foreach($htmlArr as $key=> $html)
                    {!! $html !!}
                        <a style="color:red;" href="{{route('delete',$key)}}">Delete item</a>
                        <hr style="color:green;">
                    @endforeach
                          </div>
        </div>
    </div>
@include('layouts.footer')
