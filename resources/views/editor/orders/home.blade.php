@extends('layouts.manage')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('editor.orders.create') }}" class="btn btn-success mb-2">Add New Order</a>
    </div>

    <div class="table-responsive container-fluid">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm table-hover" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th class="th-sm">Order ID
                </th>
                <th class="th-sm">Total Price
                </th>
                <th class="th-sm">User Name
                </th>
                <th class="th-sm">Date Create
                </th>
                <th class="th-sm">Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderList as $order)
                <tr>
                    <td class="text-capitalize">{{ $order->id }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>
                        <a href="{{ route('editor.orders.show-user', $order->user_id) }}">{{ $order->user->username }}</a>
                    </td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <a href="{{ route('editor.orders.show', $order->id) }}"
                           class="btn btn-blue btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th class="th-sm">Order ID
                </th>
                <th class="th-sm">Total Price
                </th>
                <th class="th-sm">User Name
                </th>
                <th class="th-sm">Date Create
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
