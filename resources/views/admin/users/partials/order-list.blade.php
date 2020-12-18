<div class="table-responsive container-fluid">
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm table-hover" cellspacing="0"
           width="100%">
        <thead>
        <tr>
            <th class="th-sm">Order ID
            </th>
            <th class="th-sm">Total Price
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
                <td>{{ $order->id }}</td>
                <td class="text-capitalize">{{ $order->total_price }}</td>
                <td class="text-capitalize">{{ $order->created_at }}</td>
                <td>
                    <a href="{{ route('admin.users.show-products', $order->id) }}"
                       class="btn btn-blue btn-sm" type="">Show Products</a>
                </td>
            </tr>
        @endforeach
        </tbody>
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
        $('#dtBasicExample').DataTable({
            "scrollY": "40vh",
            "scrollCollapse": true,
            "paging": false,
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
