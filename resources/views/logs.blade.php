@include('layouts.header')
@section('title')
    Admin request page
@endsection

<div class="container-fluid px-1 py-5 mx-auto">
    <h1>Log Viewer</h1>
    <pre>
            @foreach($logLines as $line)
            {{ $line }}<br>
        @endforeach
        </pre>
    {{$logLines->links()}}

</div>

@include('layouts.footer')
