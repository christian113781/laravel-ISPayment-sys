@extends('admin.layouts.app')
@section('employee_cashAdvance')
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
                                <h4 class="card-title">Cash Advance</h4>
                                <button type="button"
                                    class="btn btn-primary btn-round ms-auto btn-add-employee-cash-advance"
                                    data-bs-toggle="modal" data-bs-target="#employeeCashAdvanceModal">
                                    <i class="fa fa-plus"></i>
                                    Add Cash Advance
                                </button>
                            </div>
                        </div>



                        <div class="card-body">

                            <!-- Modal -->
                            <div class="modal fade" id="employeeCashAdvanceModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" id="employeeModalTitle">New Cash Advance</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="employeeForm" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" id="formMethod" value="POST">

                                            <div class="modal-body">


                                                <div class="form-group">
                                                    <label>Employee</label>
                                                    <select id="employee_id" name="employee_id" class="form-control">
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}">{{ $employee->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label>Amount</label>
                                                    <input type="number" name="amount" id="employeeAmount"
                                                        class="form-control" placeholder="Enter Amount" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="employeeDate"
                                                            name="date">
                                                        <span class="input-group-text"><i
                                                                class="fa fa-calendar-check"></i></span>
                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <label for="comment">Remarks</label>
                                                    <textarea class="form-control" id="employeeRemarks" name="remarks" rows="3"> </textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="submit" id="addRowButton"
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
                                            <th>AMOUNT</th>
                                            <th>DATE</th>
                                            <th>REMARKS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>AMOUNT</th>
                                            <th>DATE</th>
                                            <th>REMARKS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($employeeCashAdvances as $employeeCashAdvance)
                                            <tr>
                                                <td>{{ $employeeCashAdvance->id }}</td>
                                                <td>{{ $employeeCashAdvance->employee->name ?? '-' }}</td>
                                                <td>{{ $employeeCashAdvance->amount }}</td>
                                                <td>{{ $employeeCashAdvance->date }}</td>
                                                <td>{{ $employeeCashAdvance->remarks }}</td>
                                                <td
                                                    class="form-button-action d-flex gap-2 justify-content-center align-items-center p-2">

        
                                                    <!-- Delete Button -->
                                                    <form
                                                        action="{{ route('admin.employees.cashadvance.destroy', $employeeCashAdvance->id) }}"
                                                        method="POST" class="d-inline delete-employee-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger btn-delete-employee"
                                                            data-name="{{ $employeeCashAdvance->employee->name ?? 'this record' }}">
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

    @push('employee_cashAdvance')
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable({});

            });


            $(document).ready(function() {
                // ADD CASH ADVANCE
                $('.btn-add-employee-cash-advance').click(function() {
                    $('#employeeModalTitle').text('Add Cash Advance');
                    $('#employeeForm').attr('action', "{{ route('admin.employees.cashadvance.store') }}");
                    $('#formMethod').val('POST');
                    $('#employeeName').val('');
                    $('#employeeAmount').val('');
                    $('#employeeRemarks').val('');
                    $('#employeeSubmitBtn').text('Add');
                    $('#employeeDatePicker').datetimepicker('date', moment());
                    $('#employeeModal').modal('show');
                });
            });


            // Disable submit to prevent multiple clicks
                $('#employeeForm').on('submit', function() {
                    const btn = $('#addRowButton');
                    btn.prop('disabled', true).text('Saving');
                });

                // Reset button when modal closes
                $('#addRowModal').on('hidden.bs.modal', function() {
                    const btn = $('#addRowButton');
                    btn.prop('disabled', false).text('Save');
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


            $('.btn-delete-employee').click(function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let employeeName = $(this).data('name');

                swal({
                    title: 'Are you sure?',
                    text: `You are about to delete: ${employeeName}`,
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

            $('#employeeDate').datetimepicker({
                format: 'YYYY-MM-DD  HH:mm',
                defaultDate: moment() // today
            });
        </script>
    @endpush
@endsection
