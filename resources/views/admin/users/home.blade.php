@extends('layouts.manage')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-2">Add New User</a>
    </div>

    <div class="table-responsive container-fluid">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm table-hover" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th class="th-sm">Avatar
                </th>
                <th class="th-sm">ID
                </th>
                <th class="th-sm">Username
                </th>
                <th class="th-sm">Email
                </th>
                <th class="th-sm">Role
                </th>
                <th class="th-sm">Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($userList as $user)
                <tr>
                    <td class="table-img">
                        <img src="{{ $user->profile->avatar }}" alt="img">
                    </td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->profile->email }}</td>
                    <td class="text-capitalize">{{ $user->role->role_name }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user->id) }}"
                           class="btn btn-blue btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th class="th-sm">Avatar
                </th>
                <th class="th-sm">ID
                </th>
                <th class="th-sm">Username
                </th>
                <th class="th-sm">Email
                </th>
                <th class="th-sm">Role
                </th>
                <th class="th-sm">Action
                </th>
            </tr>
            </tfoot>
        </table>
    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('dbtables/js/jquery.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('dbtables/js/popper.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('dbtables/js/mdb.min.js') }}"></script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="{{ asset('dbtables/js/addons/datatables.min.js') }}"></script>
    <!-- Your custom scripts (optional) -->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>

@endsection
