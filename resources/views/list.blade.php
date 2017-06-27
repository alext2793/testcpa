@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table id="table" class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>ua</th>
                        <th>ip</th>
                        <th>ref</th>
                        <th>param1</th>
                        <th>param2</th>
                        <th>error</th>
                        <th>bad_domain</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('after-scripts')
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("getlist") }}',
                },
                columns: [
                    {data: 'click_id', name: 'click_id'},
                    {data: 'ua', name: 'ua'},
                    {data: 'ip', name: 'ip'},
                    {data: 'ref', name: 'ref'},
                    {data: 'param1', name: 'param1'},
                    {data: 'param2', name: 'param2'},
                    {data: 'error', name: 'error'},
                    {data: 'bad_domain', name: 'bad_domain'},
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@stop