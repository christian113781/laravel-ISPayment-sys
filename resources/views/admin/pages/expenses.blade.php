@extends('admin.layouts.app')
@section('expenses')
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
                                <h4 class="card-title">Expenses</h4>
                                <button type="button" class="btn btn-primary btn-round ms-auto btn-add-expense">
                                    <i class="fa fa-plus"></i>
                                    Add Expenses
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Expenses Modal -->
                            <div class="modal fade" id="expenseModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" id="expenseModalTitle">Add Expense</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="expenseForm" method="POST"
                                                action="{{ route('admin.expenses.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="_method" id="formMethod" value="POST">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>TYPE</label>
                                                            <input type="text" name="type" id="expenseType"
                                                                class="form-control" placeholder="e.g Rent, Supplies"
                                                                required style="text-transform: uppercase">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="number" class="form-control"
                                                                    id="expenseAmount" name="amount" aria-label="Amount"
                                                                    required>
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="expenseDate"
                                                                    name="expenses_date" required>
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-calendar-check"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Upload Picture</label>
                                                            <input type="file" class="form-control" id="expenseReceipt"
                                                                name="receipt_image" accept="image/*">
                                                            <small class="form-text text-muted"><i>* for receipt payment add
                                                                    picture.</i></small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" id="expenseDescription" name="description" rows="3"
                                                                style="text-transform: uppercase" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0">
                                                    <button type="submit" id="expenseSubmitBtn"
                                                        class="btn btn-primary">Add</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>TYPE</th>
                                            <th>DATE</th>
                                            <th>AMOUNT</th>
                                            <th>DESCRIPTION</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>TYPE</th>
                                            <th>DATE</th>
                                            <th>AMOUNT</th>
                                            <th>DESCRIPTION</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($expenses as $expense)
                                            <tr>
                                                <td>{{ $expense->id }}</td>
                                                <td>{{ $expense->type }}</td>
                                                <td>{{ \Carbon\Carbon::parse($expense->expenses_date)->format('m/d/Y') }}
                                                </td>
                                                <td>₱{{ number_format($expense->amount, 2) }}</td>
                                                <td>{{ $expense->description }}</td>
                                                <td
                                                    class="form-button-action d-flex gap-2 justify-content-center align-items-center p-2">
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-primary btn-edit-expense"
                                                        data-id="{{ $expense->id }}" data-type="{{ $expense->type }}"
                                                        data-amount="{{ $expense->amount }}"
                                                        data-date="{{ $expense->expenses_date }}"
                                                        data-description="{{ $expense->description }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('admin.expenses.destroy', $expense->id) }}"
                                                        method="POST" class="d-inline delete-expense-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger btn-delete-expense"
                                                            data-name="{{ $expense->type }}">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>

                                                    <!-- View Receipt Button -->
                                                    @if ($expense->receipt_image)
                                                        <a href="{{ asset('storage/' . $expense->receipt_image) }}"
                                                            target="_blank" class="btn btn-sm btn-info text-white">
                                                            <i class="fas fa-receipt"></i>
                                                        </a>
                                                    @endif
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

    @push('expenses')
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable({
                    "order": [
                        [0, "asc"] // NAME column descending
                    ]
                });
            });

            $('#expenseDate').datetimepicker({
                format: 'MM/DD/YYYY',
                defaultDate: moment()
            });

            @if (session('sweet_alert_success'))
                swal({
                    title: "Good job!",
                    text: "{{ session('sweet_alert_success') }}",
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: "Confirm",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModal: true
                        }
                    }
                });
            @endif




            $(document).ready(function() {
                // Open modal for NEW EXPENSE
                $('.btn-add-expense').click(function() {
                    $('#expenseModalTitle').text('New Expense');
                    $('#expenseForm').attr('action', "{{ route('admin.expenses.store') }}");
                    $('#formMethod').val('POST'); // reset to POST

                    // Reset form fields
                    $('#expenseType').val('');
                    $('#expenseAmount').val('');
                    $('#expenseDescription').val('');
                    $('#expenseReceipt').val('');
                    $('#expenseSubmitBtn').text('Add');
                    $('#expenseModal').modal('show');
                });

                // Open modal for EDIT EXPENSE
                $('.btn-edit-expense').click(function() {
                    let id = $(this).data('id');
                    let type = $(this).data('type');
                    let amount = $(this).data('amount');
                    let date = $(this).data('date');
                    let description = $(this).data('description');

                    $('#expenseModalTitle').text('Edit Expense');
                    $('#expenseForm').attr('action', '/admin/expenses/' + id);
                    $('#formMethod').val('PUT'); // Use PUT for update

                    // Prefill form fields
                    $('#expenseType').val(type);
                    $('#expenseAmount').val(amount);
                    $('#expenseDate').val(date);
                    $('#expenseDescription').val(description);
                    $('#expenseSubmitBtn').text('Update');
                    $('#expenseModal').modal('show');
                });
            });

            $('.btn-delete-expense').click(function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let expenseType = $(this).data('type'); // use the type of expense for confirmation

                swal({
                    title: 'Are you sure?',
                    text: `You are about to delete expense: ${expenseType}`,
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
