@extends('user.layouts.app')
@section('customer_plan')
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
                                <h4 class="card-title">Internet Plans</h4>
                                <button type="button" class="btn btn-primary btn-round ms-auto btn-add-plan"
                                    data-bs-toggle="modal" data-bs-target="#planModal">
                                    <i class="fa fa-plus"></i>
                                    Add Plan
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->

                            <div class="modal fade" id="planModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" id="planModalTitle">New Plan</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="planForm" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" id="formMethod" value="POST">

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" id="planName" class="form-control"
                                                        placeholder="Plan Name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="text" name="price" id="planPrice" class="form-control"
                                                        placeholder="Plan Price" required>
                                                </div>
                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="submit" id="planSubmitBtn"
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
                                            <th>NAME</th>
                                            <th>PRICE</th>
                                            <th>DATE CREATED</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>PRICE</th>
                                            <th>DATE CREATED</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($plans as $plan)
                                            <tr>
                                                <td>{{ $plan->id }}</td>
                                                <td>{{ $plan->name }}</td>
                                                <td>{{ $plan->price }}</td>
                                                <td>{{ $plan->created_at->format('m/d/Y') }}</td>
                                                <td
                                                    class="form-button-action d-flex gap-2 justify-content-center align-items-center p-2">

                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-primary btn-edit-plan"
                                                        data-id="{{ $plan->id }}" data-name="{{ $plan->name }}"
                                                        data-price="{{ $plan->price }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('user.customers.plans.destroy', $plan->id) }}"
                                                        method="POST" class="d-inline delete-plan-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger btn-delete-plan"
                                                            data-name="{{ $plan->name }}">
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

    @push('customers_plan')
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable({
                    "order": [
                        [0, "asc"] // NAME column descending
                    ]
                });
            });



            $(document).ready(function() {
                // Open modal for NEW PLAN
                $('.btn-add-plan').click(function() {
                    $('#planModalTitle').text('New Plan');
                    $('#planForm').attr('action', "{{ route('user.customers.plans.store') }}");
                    $('#formMethod').val('POST'); // reset to POST
                    $('#planName').val('');
                    $('#planPrice').val('');
                    $('#planSubmitBtn').text('Add');
                    $('#planModal').modal('show');
                });

                // Open modal for EDIT PLAN
                $('.btn-edit-plan').click(function() {
                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let price = $(this).data('price');

                    $('#planModalTitle').text('Edit Plan');
                    $('#planForm').attr('action', '/user/plans/' + id); // update route
                    $('#formMethod').val('PUT'); // use PUT for update
                    $('#planName').val(name);
                    $('#planPrice').val(price);
                    $('#planSubmitBtn').text('Update');
                    $('#planModal').modal('show');
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


            $('.btn-delete-plan').click(function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let planName = $(this).data('plan');

                swal({
                    title: 'Are you sure?',
                    text: `You are about to delete: ${planName}`,
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
