@extends('admin.layouts.app')
@section('employee')
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
                                <h4 class="card-title">Employee</h4>
                                <button type="button" class="btn btn-primary btn-round ms-auto btn-add-employee"
                                    data-bs-toggle="modal" data-bs-target="#employeeModal">
                                    <i class="fa fa-plus"></i>
                                    Add Employee
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" id="employeeModalTitle">New Employee</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="employeeForm" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" id="formMethod" value="POST">

                                            <div class="modal-body">
                                               

                                                <div class="form-group form-group-default">
                                                    <label>Name</label>
                                                    <input type="text" name="name" id="employeeName" class="form-control"
                                                        placeholder="Employee Name" required>
                                                </div>


                                                 <div class="form-group form-group-default">
                                                    <label>Salary</label>
                                                    <input type="number" name="salary" id="employeeSalary" class="form-control"
                                                        placeholder="Salary" required>
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
                                            <th>SALARY</th>
                                            <th>DATE CREATED</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>SALARY</th>
                                            <th>DATE CREATED</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->id }}</td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->salary }}</td>
                                                <td>{{ $employee->created_at->format('m/d/Y') }}</td>
                                                <td
                                                    class="form-button-action d-flex gap-2 justify-content-center align-items-center p-2">

                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-primary btn-edit-employee"
                                                        data-id="{{ $employee->id }}" data-salary="{{ $employee->salary }}"
                                                        data-name="{{ $employee->name }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('admin.employees.destroy', $employee->id) }}"
                                                        method="POST" class="d-inline delete-employee-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger btn-delete-employee"
                                                            data-name="{{ $employee->name }}">
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

    @push('employee')
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable({});

            });


            $(document).ready(function() {
                // Open modal for NEW EMPLOYEE
                $('.btn-add-employee').click(function() {
                    $('#employeeModalTitle').text('New Employee');
                    $('#employeeForm').attr('action', "{{ route('admin.employees.store') }}");
                    $('#formMethod').val('POST'); // reset to POST
                    $('#employeeName').val('');
                    $('#employeeSalary').val('');
                    $('#employeeSubmitBtn').text('Add');
                    $('#employeeModal').modal('show');
                });



                
               


                // Open modal for EDIT EMPLOYEE
                $('.btn-edit-employee').click(function() {
                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let salary = $(this).data('salary');

                    $('#employeeModalTitle').text('Edit Employee');
                    $('#employeeForm').attr('action', '/admin/employees/' + id); // update route
                    $('#formMethod').val('PUT'); // use PUT for update
                    $('#employeeName').val(name);
                    $('#employeeSalary').val(salary);
                    $('#employeeSubmitBtn').text('Update');
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


           $('.btn-delete-employee').click(function (e) {
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

        </script>
    @endpush
@endsection
