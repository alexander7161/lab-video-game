@extends('layouts.app')

@section('script')
    <script type="text/javascript">
        ReactDOM.render(<Example/>, document.getElementById('example'));
    </script>
@endsection

@section('content')
    <div id="example"></div>
@endsection