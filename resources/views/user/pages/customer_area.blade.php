@extends('user.layouts.app')
@section('customer_area')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">DataTables.Net</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Tables</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Datatables</a>
                    </li>
                </ul>
            </div>
            <div class="row">



                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Area</h4>
                                <button type="button" class="btn btn-primary btn-round ms-auto btn-add-area"
                                    data-bs-toggle="modal" data-bs-target="#areaModal">
                                    <i class="fa fa-plus"></i>
                                    Add Area
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->

                            <div class="modal fade" id="areaModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" id="areaModalTitle">New Area</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="areaForm" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" id="formMethod" value="POST">

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Code</label>
                                                    <input type="text" name="code" id="areaCode" class="form-control"
                                                        placeholder="Area Code" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" id="areaName" class="form-control"
                                                        placeholder="Area Name" required>
                                                </div>
                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="submit" id="areaSubmitBtn"
                                                    class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>CODE</th>
                                            <th>NAME</th>
                                            <th>DATE CREATED</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>CODE</th>
                                            <th>NAME</th>
                                            <th>DATE CREATED</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($areas as $area)
                                            <tr>
                                                <td>{{ $area->id }}</td>
                                                <td>{{ $area->code }}</td>
                                                <td>{{ $area->name }}</td>
                                                <td>{{ $area->created_at->format('m/d/Y') }}</td>
                                                <td
                                                    class="form-button-action d-flex gap-2 justify-content-center align-items-center p-2">

                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-primary btn-edit-area"
                                                        data-id="{{ $area->id }}" data-code="{{ $area->code }}"
                                                        data-name="{{ $area->name }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('user.customers.areas.destroy', $area->id) }}"
                                                        method="POST" class="d-inline delete-area-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger btn-delete-area"
                                                            data-name="{{ $area->name }}">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('customers_area')
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable({});

            });


            $(document).ready(function() {
                // Open modal for NEW AREA
                $('.btn-add-area').click(function() {
                    $('#areaModalTitle').text('New Area');
                    $('#areaForm').attr('action', "{{ route('user.customers.areas.store') }}");
                    $('#formMethod').val('POST'); // reset to POST
                    $('#areaCode').val('');
                    $('#areaName').val('');
                    $('#areaSubmitBtn').text('Add');
                    $('#areaModal').modal('show');
                });

                // Open modal for EDIT AREA
                $('.btn-edit-area').click(function() {
                    let id = $(this).data('id');
                    let code = $(this).data('code');
                    let name = $(this).data('name');

                    $('#areaModalTitle').text('Edit Area');
                    $('#areaForm').attr('action', '/user/areas/' + id); // update route
                    $('#formMethod').val('PUT'); // use PUT for update
                    $('#areaCode').val(code);
                    $('#areaName').val(name);
                    $('#areaSubmitBtn').text('Update');
                    $('#areaModal').modal('show');
                });
            });

            @if (session('sweet_alert_success'))
                swal({
                    title: "Good job!",
                    text: "{{ session('sweet_alert_success') }}",
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: "Confirm Me",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModal: true
                        }
                    }
                });
            @endif


           $('.btn-delete-area').click(function (e) {
    e.preventDefault();
    let form = $(this).closest('form');
    let areaName = $(this).data('name');

    swal({
        title: 'Are you sure?',
        text: `You are about to delete: ${areaName}`,
        icon: 'warning',
        buttons: {
            cancel: {
                text: "Cancel",
                value: false,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "Yes, delete it!",
                value: true,
                visible: true,
                className: "btn btn-success",
                closeModal: true
            }
        },
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});

        </script>
    @endpush
@endsection
