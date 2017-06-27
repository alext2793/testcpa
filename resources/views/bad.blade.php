@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{ Form::model(['route' => ['storebad'], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST']) }}
        <div class="row well">
            <div class="col-md-10">
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) }}
            </div>
            <div class="col-md-2">
                {{ Form::submit('добавить', ['class' => 'btn btn-success btn-block']) }}
            </div>
        </div>
        {{ Form::close() }}
        <div class="table-responsive">
            <table id="table" class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
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
                    url: '{{ route("getbad") }}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@stop