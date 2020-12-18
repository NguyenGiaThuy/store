<div class="table-responsive container-fluid">
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm table-hover" cellspacing="0"
           width="100%">
        <thead>
        <tr>
            <th class="th-sm">Product Image
            </th>
            <th class="th-sm">Product ID
            </th>
            <th class="th-sm">Product Name
            </th>
            <th class="th-sm">Product Brand
            </th>
            <th class="th-sm">Product Price
            </th>
            <th class="th-sm">Product Type
            </th>
            <th class="th-sm">Product Catalog
            </th>
            <th class="th-sm">Quantity
            </th>
            <th class="th-sm">Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($productList as $product)
            <tr>
                <td class="table-img">
                    <img src="{{ $product->image }}" alt="img">
                </td>
                <td>{{ $product->id }}</td>
                <td class="text-capitalize">{{ $product->product_name }}</td>
                <td class="text-capitalize">{{ $product->brand }}</td>
                <td>{{ $product->price }}</td>
                <td class="text-capitalize">{{ $product->type }}</td>
                <td>
                    @if($product->catalog_id != null)
                        <div class="text-capitalize">{{ $product->catalog->catalog_name }}</div>
                    @endif
                </td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>
                    <a href="{{ route('editor.products.show', $product->id) }}"
                       class="btn btn-blue btn-sm" type="">Edit</a>
                    <a class="btn btn-orange btn-sm" href="{{ route('editor.orders.destroy-product', [$id, $product->id]) }}"
                            onclick="event.preventDefault();
                           document.getElementById('delete-order-product-form').submit();">
                        {{ __('Delete') }}
                    </a>

                    <form id="delete-order-product-form" action="{{ route('editor.orders.destroy-product', [$id, $product->id]) }}" method="POST"
                          class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
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
            "ordering": false,
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
