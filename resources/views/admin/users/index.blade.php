@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'User List')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users <a href="{{ url('/admin/users/create') }}" class="btn btn-primary btn-xs"
                                            title="Add New User"><span
                            class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        @include('admin.layouts.alert')
                        <table class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th> {{ trans('users.name') }} </th>
                                <th> {{ trans('users.email') }} </th>
                                <th> {{ trans('users.profession') }} </th>
                                <th> {{ trans('profiles.github') }} </th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $x = 0 @endphp
                            @foreach($users as $user)
                                @php $x++ @endphp
                                <tr class="{{ $x%2 == 0 ? 'even' : 'odd'}} gradeA">
                                    <td>{{ $x }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->profession['name'] }}</td>
                                    <td>{{ $user->profile['github'] }}</td>
                                    <td>
                                        <a href="{{ url('/admin/users/' . $user->id . '/edit') }}"
                                           class="btn btn-primary btn-xs"
                                           title="Edit User"><span class="glyphicon glyphicon-pencil"
                                                                  aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $user->id) }}"
                                           class="btn btn-primary btn-xs"
                                           title="View User"><span class="glyphicon glyphicon-eye-open"
                                                                   aria-hidden="true"/></a>


                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/admin/users', $user->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        @if($user->id !== Auth::user()->id)
                                            @php $disabled = '' @endphp
                                        @else
                                            @php $disabled = 'disabled' @endphp
                                        @endif
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete User" />', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                $disabled,
                                                'onclick'=>'return confirm("Are you sure you want to delete ' . $user->name . '?")'
                                        ))!!}

                                        {!! Form::close() !!}


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection

@push('css')
{{-- DataTables CSS --}}
<link href="{{ asset('sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}"
      rel="stylesheet">
{{-- DataTables Responsive CSS --}}
<link href="{{ asset('sb-admin/bower_components/datatables-responsive/css/dataTables.responsive.css') }}"
      rel="stylesheet">
@endpush

@push('scripts')
{{-- DataTables JavaScript --}}
<script src="{{ asset('sb-admin/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#dataTables').DataTable({
            responsive: true
        });
    });
</script>
@endpush