@extends('admin.layouts.app')

@section('customer_manage')
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
                                <h4 class="card-title">Customers</h4>

                                <div class="ms-auto d-flex gap-2">
                                    <button id="btnPrint" class="btn btn-secondary btn-round">
                                        <i class="fas fa-print"></i> Print
                                    </button>


                                    <button class="btn btn-primary btn-round" data-bs-toggle="modal"
                                        data-bs-target="#addRowModal">
                                        <i class="fa fa-plus"></i>
                                        Add Customer
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal  Edit & Add New Customers-->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">Add Customer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="customerForm" method="POST"
                                                action="{{ route('admin.customers.store') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" id="addName"
                                                                name="addName" style="text-transform: uppercase;"
                                                                oninput="this.value = this.value.toUpperCase();" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Plan</label>
                                                            <select id="plan_id" name="plan_id" class="form-control">
                                                                @foreach ($plans as $plan)
                                                                    <option value="{{ $plan->id }}">{{ $plan->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Area</label>
                                                            <select id="area_id" name="area_id" class="form-control">
                                                                @foreach ($areas as $area)
                                                                    <option value="{{ $area->id }}">{{ $area->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>LPD</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    id="datepickerLPD" name="addLPD">
                                                                <span class="input-group-text"><i
                                                                        class="fa fa-calendar-check"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control text-uppercase" id="addAddress" name="addAddress" rows="3"
                                                                placeholder="E.G LEMONSITO (Address)"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0">
                                                    <button type="submit" id="addRowButton"
                                                        class="btn btn-primary">Add</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal  Payment Selected Customers-->
                            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">Add Payment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="transactionForm" enctype="multipart/form-data" method="POST">
                                                @csrf
                                                <input type="hidden" name="customer_id" id="customer_id"
                                                    value="">
                                                <div class="row">

                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" id="addName"
                                                                name="addName" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Receipt #</label>
                                                            <input type="text" class="form-control" id="addReceipt"
                                                                name="addReceipt" required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Area</label>
                                                            <input type="text" class="form-control" id="area_id"
                                                                name="area_id" required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Plan</label>
                                                            <input type="text" class="form-control" id="plan_id"
                                                                name="plan_id" required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control" id="addPrice"
                                                                    name="addPrice" required />

                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Payment Method</label>
                                                            <select class="form-select form-control" id="addPaymentMethod"
                                                                name="addPaymentMethod">
                                                                <option>CASH</option>
                                                                <option>GCASH</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" name="amount" class="form-control"
                                                                    maxlength="5" inputmode="numeric"
                                                                    oninput="this.value = this.value.replace(/\D/g, '').slice(0,5)"
                                                                    placeholder="Enter Amount" required />

                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>LPD<small class="form-text text-muted"></label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    id="datepickerPaymentLPD" name="addLPD">
                                                                <span class="input-group-text"><i
                                                                        class="fa fa-calendar-check"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Upload Picture</label>
                                                            <input type="file" class="form-control"
                                                                id="customerPicture" name="customerPicture"
                                                                accept="image/*">
                                                            <small class="form-text text-muted"><i>* for gcash payment add
                                                                    receipt picture.</i></small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group"> <label>Remarks <small
                                                                    class="form-text text-muted"><i>* Enter who process
                                                                        transcation payment.</i></small></label>
                                                            <textarea class="form-control text-uppercase" id="addRemarks" name="addRemarks" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0">
                                                    <button type="submit" id="submitPaymentButton"
                                                        class="btn btn-primary">Proceed</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Cancel</button>
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
                                            <th>NAME</th>
                                            <th>AREA</th>
                                            <th>ADDRESS</th>
                                            <th>PLAN</th>
                                            <th>PRICE</th>
                                            <th>LPD</th>
                                            <th>DD</th>

                                            <th>REMARKS</th>
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NAME</th>
                                            <th>AREA</th>
                                            <th>ADDRESS</th>
                                            <th>PLAN</th>
                                            <th>PRICE</th>
                                            <th>LPD</th>
                                            <th>DD</th>
                                            <th>REMARKS</th>
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->area->name ?? '-' }}</td>
                                                <td>{{ $customer->address ?? '-' }}</td>
                                                <td>{{ $customer->plan->name ?? '-' }}</td>
                                                <td>{{ number_format($customer->plan->price ?? 0, 2) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($customer->lpd)->toDateString() }}</td>
                                                <td>{{ \Carbon\Carbon::parse($customer->due_date)->toDateString() }}</td>

                                                <td>{{ $customer->remarks ?? '-' }}</td>
                                                <td>
                                                    @if ($customer->status === 'DUE')
                                                        <span class="badge bg-warning fs-7 px-2 py-2">
                                                            {{ $customer->status }}
                                                        </span>
                                                        <small class="text-danger">
                                                            (Overdue by {{ abs($customer->days_left) }} days)
                                                        </small>
                                                    @elseif ($customer->status === 'ON TIME')
                                                        <span class="badge bg-success fs-7 px-2 py-2">
                                                            {{ $customer->status }}
                                                        </span>
                                                        <small class="text-muted">
                                                            ({{ $customer->days_left }} days left)
                                                        </small>
                                                    @else
                                                        <span class="badge bg-secondary fs-7 px-2 py-2">
                                                            {{ $customer->status }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-button-action d-flex gap-2 justify-content-center align-items-center p-2">
                                                        <!-- Edit Button -->
                                                        <button type="button"
                                                            class="btn btn-sm btn-primary btn-edit-customer"
                                                            data-id="{{ $customer->id }}"
                                                            data-name="{{ $customer->name }}"
                                                            data-area="{{ $customer->area_id }}"
                                                            data-plan="{{ $customer->plan_id }}"
                                                            data-lpd="{{ $customer->lpd }}"
                                                            data-address="{{ $customer->address }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <!-- Delete Button -->
                                                        <form
                                                            action="{{ route('admin.customers.destroy', $customer->id) }}"
                                                            method="POST" class="d-inline delete-customer-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger btn-delete-customer"
                                                                data-name="{{ $customer->name }}">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>

                                                        <!-- Payment Button -->
                                                        <button type="button"
                                                            class="btn btn-sm btn-warning text-white btn-payment"
                                                            data-id="{{ $customer->id }}">
                                                            <i class="fas fa-calendar-check"></i>
                                                        </button>
                                                    </div>
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



    @push('customers')
        <!-- DataTables Buttons -->
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>


        <script>
            $(document).ready(function() {
                var table = $('#basic-datatables').DataTable({
                    pageLength: 50,
                    dom: 'lfrtip',
                    buttons: [{
                        extend: 'pdfHtml5',
                        download: 'open',
                        title: 'Customer List',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        customize: function(doc) {
                            // Default font size for better fit
                            doc.defaultStyle.fontSize = 10;

                            // Wrap text inside table cells
                            var objLayout = {};
                            objLayout['hLineWidth'] = function(i) {
                                return 0.5;
                            };
                            objLayout['vLineWidth'] = function(i) {
                                return 0.5;
                            };
                            objLayout['hLineColor'] = function(i) {
                                return '#aaa';
                            };
                            objLayout['vLineColor'] = function(i) {
                                return '#aaa';
                            };
                            objLayout['paddingLeft'] = function(i) {
                                return 4;
                            };
                            objLayout['paddingRight'] = function(i) {
                                return 4;
                            };
                            doc.content[1].layout = objLayout;

                            var table = doc.content[1].table;
                            table.widths = Array(table.body[0].length + 1).join('*').split('');
                        }
                    }]
                });

                $('#btnPrint').on('click', function() {
                    table.button('.buttons-pdf').trigger();
                });
            });



            $('#datepickerLPD').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: moment().subtract(32, 'days')
            });


            $('#datepickerPaymentLPD').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: moment().subtract(32, 'days')
            });
        </script>



        <script>
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



            $('.btn-delete-customer').click(function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let customerName = $(this).data('name');

                swal({
                    title: 'Are you sure?',
                    text: `You won't be able to revert this!`,
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: "Cancel",
                            value: false,
                            visible: true,
                            className: "btn btn-danger ", // red button
                            closeModal: true,
                        },
                        confirm: {
                            text: "Yes, delete it!",
                            value: true,
                            visible: true,
                            className: "btn btn-success", // green button
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



            // Edit button click
            $(document).ready(function() {

                // Initialize datepickers once

                $('#datepickerLPD').datetimepicker({
                    format: 'YYYY-MM-DD'
                });

                // Open Add Customer Modal
                $('.btn-add-customer, [data-bs-target="#addRowModal"]').click(function() {
                    let form = $('#customerForm');
                    form[0].reset();
                    form.find('input[name="_method"]').remove();
                    form.attr('action', '{{ route('admin.customers.store') }}');
                    $('#addRowModal .modal-title').text('Add Customer');
                    $('#addRowButton').text('Add');
                    $('#datepickerLPD').datetimepicker('date', new Date());
                    $('#addRowModal').modal('show');
                });

                // Disable submit to prevent multiple clicks
                $('#customerForm').on('submit', function() {
                    const btn = $('#addRowButton');
                    btn.prop('disabled', true).text('Adding...');
                });

                // Reset button when modal closes
                $('#addRowModal').on('hidden.bs.modal', function() {
                    const btn = $('#addRowButton');
                    btn.prop('disabled', false).text('Add');
                });

                // Open Edit Customer Modal
                $('.btn-edit-customer').click(function() {
                    let customerId = $(this).data('id');
                    let name = $(this).data('name');
                    let areaId = $(this).data('area');
                    let planId = $(this).data('plan');
                    let lpd = $(this).data('lpd');
                    let address = $(this).data('address');

                    let form = $('#customerForm');

                    // Fill modal inputs
                    $('#addName').val(name);
                    $('#area_id').val(areaId);
                    $('#plan_id').val(planId);
                    $('#addAddress').val(address);

                    // Set datepicker
                    $('#datepickerLPD').datetimepicker('date', lpd ? moment(lpd.split(' ')[0]) : null);

                    // Change form action to update route
                    form.attr('action', '/admin/customers/' + customerId);

                    // Add or update PUT method hidden input
                    if (form.find('input[name="_method"]').length === 0) {
                        form.append('<input type="hidden" name="_method" value="PUT">');
                    } else {
                        form.find('input[name="_method"]').val('PUT');
                    }

                    // Update modal title and submit button
                    $('#addRowButton').text('Update');
                    $('#addRowModal .modal-title').text('Edit Customer');

                    // Reset submit button in case it was disabled
                    $('#addRowButton').prop('disabled', false);

                    // Show modal
                    $('#addRowModal').modal('show');
                });

                // Disable submit button on form submit (works for both Add and Edit)
                $('#customerForm').on('submit', function() {
                    const btn = $('#addRowButton');
                    btn.prop('disabled', true).text('Saving...');
                });

                // Reset submit button when modal closes
                $('#addRowModal').on('hidden.bs.modal', function() {
                    const btn = $('#addRowButton');
                    btn.prop('disabled', false).text('Add');
                });

            });


            // Open Edit Customer Modal
            $('.btn-edit-customer').click(function() {
                let customerId = $(this).data('id');
                let name = $(this).data('name');
                let areaId = $(this).data('area');
                let planId = $(this).data('plan');
                let lpd = $(this).data('lpd');
                let address = $(this).data('address');

                let form = $('#customerForm');

                // Fill modal inputs
                $('#addName').val(name);
                $('#area_id').val(areaId);
                $('#plan_id').val(planId);
                $('#datepickerLPD').val(lpd ? lpd.split(' ')[0] : '');
                $('#addAddress').val(address);

                // Change form action to update
                form.attr('action', '/admin/customers/' + customerId);

                // Add PUT method hidden input if not exists
                if (form.find('input[name="_method"]').length === 0) {
                    form.append('<input type="hidden" name="_method" value="PUT">');
                } else {
                    form.find('input[name="_method"]').val('PUT');
                }

                $('#addRowButton').text('Update');
                $('#addRowModal .modal-title').text('Edit Customer');
                $('#addRowModal').modal('show');
            });





            // When clicking the payment button for a customer
            $('.btn-payment').click(function() {
                let customerId = $(this).data('id');

                // Get customer info
                $.ajax({
                    url: '/admin/customers/' + customerId + '/payment-info',
                    type: 'GET',
                    success: function(response) {
                        const customer = response.customer;
                        $('#customer_id').val(customer.id);
                        $('#paymentModal #addName').val(customer.name);
                        $('#paymentModal #area_id').val(customer.area);
                        $('#paymentModal #plan_id').val(customer.plan_name);
                        $('#paymentModal #addPrice').val(Math.floor(customer.price));
                        $('#paymentModal #addRemarks').val('');
                        $('#paymentModal input[name="addLPD"]').val(customer.lpd);

                        // Generate receipt number
                        $.getJSON('/admin/customers/new-receipt', function(data) {
                            $('#paymentModal #addReceipt').val(data.receipt_number);

                            let $form = $('#paymentModal form');
                            if ($form.find('input[name="receipt_number"]').length) {
                                $form.find('input[name="receipt_number"]').val(data.receipt_number);
                            } else {
                                $form.append('<input type="hidden" name="receipt_number" value="' +
                                    data.receipt_number + '">');
                            }
                        });

                        // Show modal (Bootstrap 5)
                        var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
                        paymentModal.show();
                    },
                    error: function(err) {
                        console.log('Error fetching customer data', err);
                    }
                });
            });





            // Disable Picture
            $(document).ready(function() {
                function toggleUpload() {
                    const method = $('#addPaymentMethod').val();
                    if (method === 'Cash') {
                        $('#customerPicture').prop('disabled', true).val(''); // disable and clear
                    } else {
                        $('#customerPicture').prop('disabled', false);
                    }
                }

                // Initial check on page load
                toggleUpload();

                // Listen for changes
                $('#addPaymentMethod').change(function() {
                    toggleUpload();
                });
            });
        </script>

        {{-- Payment Button When Add --}}
        <script>
            $(document).ready(function() {
                $('#transactionForm').submit(function(e) {
                    e.preventDefault(); // prevent page reload

                    var formData = new FormData(this);
                    var submitBtn = $(this).find('button[type="submit"]');

                    // Disable button to prevent multiple clicks
                    submitBtn.prop('disabled', true).text('Processing...');

                    $.ajax({
                        url: "{{ route('admin.customers.storeTransaction') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.success) {
                                swal({
                                    title: "Good job!",
                                    text: data.message,
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            text: "Confirm Me",
                                            className: "btn btn-success"
                                        }
                                    }
                                }).then(() => {
                                    // Reload the page to show updated customer data
                                    window.location.reload();
                                });

                                $('#paymentModal').modal('hide');
                                $('#customerForm')[0].reset(); // optional: reset form
                            }
                        },
                        error: function(err) {
                            console.log(err);
                            swal({
                                title: "Oops!",
                                text: err.responseJSON?.error ||
                                    'Failed to save transaction.',
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        text: "Close",
                                        className: "btn btn-danger"
                                    }
                                }
                            });
                        },
                        complete: function() {
                            // Re-enable button after request (optional)
                            submitBtn.prop('disabled', false).text('Pay');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
