@extends('layouts.manage')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('editor.products.create') }}" class="btn btn-success mb-2">Add New Product</a>
    </div>

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
                            <a class="text-capitalize" href="{{ route('editor.catalogs.show', $product->catalog_id) }}">{{ $product->catalog->catalog_name }}</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('editor.products.show', $product->id) }}"
                           class="btn btn-blue btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
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
