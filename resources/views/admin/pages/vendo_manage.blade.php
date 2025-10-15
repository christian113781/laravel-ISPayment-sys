@extends('admin.layouts.app')

@section('vendo_manage')
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
                                <h4 class="card-title">Vendos</h4>

                                <div class="ms-auto d-flex gap-2">
                                    <button id="btnPrint" class="btn btn-secondary btn-round">
                                        <i class="fas fa-print"></i> Print
                                    </button>

                                    <button class="btn btn-primary btn-round" data-bs-toggle="modal"
                                        data-bs-target="#addRowModal">
                                        <i class="fa fa-plus"></i>
                                        Add Vendos
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal  Edit & Add New vENDO-->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">Add Vendos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="vendoForm" method="POST" action="{{ route('admin.vendos.store') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control text-uppercase"
                                                                id="addName" name="addName" required>
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
                                                            <label>Key #</label>
                                                            <input type="number" class="form-control" id="addKeys"
                                                                name="addKeys" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Shares</label>
                                                            <div class="input-group mb-3">

                                                                <input type="number" class="form-control" id="addShares"
                                                                    name="addShares" value="30" required />

                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>LHD</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    id="datepickerLHD" name="addLHD">
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

                            <!-- Modal  Harvest Selected Vendos-->
                            <div class="modal fade" id="harvestModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">Vendo Harvest</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="transactionForm"
                                                action="{{ route('admin.vendos.storeTransaction') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="vendo_id" id="vendo_id" value="">
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
                                                            <label>Area</label>
                                                            <input type="text" class="form-control" id="area_id"
                                                                name="area_id" required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input type="text" class="form-control" id="getaddress"
                                                                name="getaddress" required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Shares Percentage</label>
                                                            <input type="text" class="form-control" id="getshares"
                                                                name="getshares" required readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>H.Amount</label>
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
                                                            <label>S.Amount</label>
                                                            <input type="text" class="form-control" id="samount"
                                                                name="samount" required readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>My Share</label>
                                                            <input type="text" class="form-control" id="myshare"
                                                                name="myshare" required readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Upload Picture</label>
                                                            <input type="file" class="form-control" id="vendoPicture"
                                                                name="vendoPicture" accept="image/*">
                                                            <small class="form-text text-muted"><i>* for harvest add
                                                                    picture.</i></small>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>LHD</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    id="datepickerHarvestLHD" name="addLHD">
                                                                <span class="input-group-text"><i
                                                                        class="fa fa-calendar-check"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-12">
                                                        <div class="form-group"> <label>Remarks <small
                                                                    class="form-text text-muted"><i>* Enter who process
                                                                        transcation harvest.</i></small></label>
                                                            <textarea class="form-control text-uppercase" id="addRemarks" name="addRemarks" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0">
                                                    <button type="submit" id="submitHarvestButton"
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
                                            <th>SHARES</th>
                                            <th>KEY #</th>
                                            <th>LHD</th>
                                            <th>DD</th>
                                           
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NAME</th>
                                            <th>AREA</th>
                                            <th>ADDRESS</th>
                                            <th>SHARES</th>
                                            <th>KEY #</th>
                                            <th>LHD</th>
                                            <th>DD</th>
                                            
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($vendos as $vendo)
                                            <tr>
                                                <td>{{ $vendo->name }}</td>
                                                <td>{{ $vendo->area->name ?? '-' }}</td>
                                                <td>{{ $vendo->address ?? '-' }}</td>
                                                <td>{{ $vendo->shares ?? '-' }}%</td>
                                                <td>{{ $vendo->key ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($vendo->lhd)->toDateString() }}</td>
                                                <td>{{ $vendo->due_date ? \Carbon\Carbon::parse($vendo->due_date)->toDateString() : '-' }}
                                                </td>
                                                
                                                <td>
                                                    @if ($vendo->status === 'HARVEST TIME')
                                                        <span class="badge bg-warning fs-7 px-2 py-2">
                                                            {{ $vendo->status }}
                                                        </span>
                                                        <small class="text-danger">
                                                            (Overdue by {{ abs($vendo->days_left) }} days)
                                                        </small>
                                                    @elseif ($vendo->status === 'ON TIME')
                                                        <span class="badge bg-success fs-7 px-2 py-2">
                                                            {{ $vendo->status }}
                                                        </span>
                                                        <small class="text-muted">
                                                            ({{ $vendo->days_left }} days left)
                                                        </small>
                                                    @else
                                                        <span class="badge bg-secondary fs-7 px-2 py-2">
                                                            {{ $vendo->status ?? '-' }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-button-action d-flex gap-2 justify-content-center align-items-center p-2">
                                                        <!-- Edit Button -->
                                                        <button type="button"
                                                            class="btn btn-sm btn-primary btn-edit-vendo"
                                                            data-id="{{ $vendo->id }}"
                                                            data-name="{{ $vendo->name }}"
                                                            data-area="{{ $vendo->area_id }}"
                                                            data-lhd="{{ $vendo->lhd }}"
                                                            data-address="{{ $vendo->address }}"
                                                            data-key="{{ $vendo->key }}"
                                                            data-shares="{{ $vendo->shares }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('admin.vendos.destroy', $vendo->id) }}"
                                                            method="POST" class="d-inline delete-vendo-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger btn-delete-vendo"
                                                                data-name="{{ $vendo->name }}">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                        <!-- Harvest Button -->
                                                        <button type="button"
                                                            class="btn btn-sm btn-warning text-white btn-harvest"
                                                            data-id="{{ $vendo->id }}">
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



    @push('vendos')
        <!-- DataTables Buttons -->
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>


        <script>
            $(document).ready(function() {
                var table = $('#basic-datatables').DataTable({
                    pageLength: 75,
                    dom: 'lfrtip',
                    buttons: [{
                        extend: 'pdfHtml5',
                        download: 'open',
                        title: 'Vendo List',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
              
                 columns: ':not(:eq(5)):not(:eq(7))'
            },
                        customize: function(doc) {
                            // Default font size for better fit
                            doc.defaultStyle.fontSize = 6;

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
        </script>
        <script>
            $('#datepickerLHD').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: moment() // today
            });

            $('#datepickerHarvestLHD').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: moment() // today
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


            $('.btn-delete-vendo').click(function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let vendoName = $(this).data('name');

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

                $('#datepickerLPH').datetimepicker({
                    format: 'YYYY-MM-DD'
                });

                // Open Add Vendo Modal
                $('.btn-add-vendo, [data-bs-target="#addRowModal"]').click(function() {
                    let form = $('#vendoForm');
                    form[0].reset();
                    form.find('input[name="_method"]').remove();
                    form.attr('action', '{{ route('admin.vendos.store') }}');
                    $('#addRowModal .modal-title').text('Add Vendo');
                    $('#addRowButton').text('Add');
                    $('#datepickerLHD').datetimepicker('date', new Date());
                    $('#addRowModal').modal('show');
                });
                
                // Reset button when modal closes
                $('#addRowModal').on('hidden.bs.modal', function() {
                    const btn = $('#addRowButton');
                    btn.prop('disabled', false).text('Add');
                });
            

                // Open Edit Vendo Modal
                $('.btn-edit-vendo').click(function() {
                    let vendoId = $(this).data('id');
                    let name = $(this).data('name');
                    let areaId = $(this).data('area');
                    let address = $(this).data('address');
                    let shares = $(this).data('shares');
                    let key = $(this).data('key');
                    let lhd = $(this).data('lhd');
                    let remarks = $(this).data('remarks');

                    let form = $('#vendoForm');

                    // Fill modal inputs
                    $('#addName').val(name);
                    $('#area_id').val(areaId);
                    $('#addAddress').val(address);
                    $('#addShares').val(shares);
                    $('#addKeys').val(key);
                    $('#addRemarks').val(remarks);

                    // Set datepicker for LHD (Last Harvest Date)
                    $('#datepickerLHD').datetimepicker('date', lhd ? moment(lhd.split(' ')[0]) : null);

                    // Change form action to update route
                    form.attr('action', '/admin/vendos/' + vendoId);

                    // Add or update PUT method hidden input
                    if (form.find('input[name="_method"]').length === 0) {
                        form.append('<input type="hidden" name="_method" value="PUT">');
                    } else {
                        form.find('input[name="_method"]').val('PUT');
                    }

                    // Update modal title and submit button
                    $('#addRowButton').text('Update');
                    $('#addVendoModal .modal-title').text('Edit Vendo');

                    // Show modal
                    $('#addVendoModal').modal('show');
                });

                // Disable submit button on form submit (works for both Add and Edit)
                $('#vendoForm').on('submit', function() {
                    const btn = $('#addRowButton');
                    btn.prop('disabled', true).text('Saving...');
                });

                // Reset submit button when modal closes
                $('#addRowModal').on('hidden.bs.modal', function() {
                    const btn = $('#addRowButton');
                    btn.prop('disabled', false).text('Add');
                });
            });


            // Open Edit Vendo Modal
            $('.btn-edit-vendo').click(function() {
                let vendoId = $(this).data('id');
                let name = $(this).data('name');
                let areaId = $(this).data('area');
                let address = $(this).data('address');
                let shares = $(this).data('shares');
                let key = $(this).data('key');
                let lhd = $(this).data('lhd');
                let remarks = $(this).data('remarks');

                let form = $('#vendoForm');

                // Fill modal inputs
                $('#addName').val(name);
                $('#area_id').val(areaId);
                $('#addAddress').val(address);
                $('#addShares').val(shares);
                $('#addKey').val(key);
                $('#addRemarks').val(remarks);

                // Set LHD datepicker
                $('#datepickerLHD').val(lhd ? lhd.split(' ')[0] : '');

                // Change form action to update
                form.attr('action', '/admin/vendos/' + vendoId);

                // Add PUT method hidden input if not exists
                if (form.find('input[name="_method"]').length === 0) {
                    form.append('<input type="hidden" name="_method" value="PUT">');
                } else {
                    form.find('input[name="_method"]').val('PUT');
                }

                // Update modal UI
                $('#addRowButton').text('Update');
                $('#addRowModal .modal-title').text('Edit Vendo');
                $('#addRowModal').modal('show');
            });





            // When clicking the harvest button for a vendo
            $('.btn-harvest').click(function() {
                let vendoId = $(this).data('id');

                // Get vendo info
                $.ajax({
                    url: '/admin/vendos/' + vendoId + '/harvest-info',
                    type: 'GET',
                    success: function(response) {
                        const vendo = response.vendo;

                        $('#vendo_id').val(vendo.id);
                        $('#harvestModal #addName').val(vendo.name);
                        $('#harvestModal #area_id').val(vendo.area);
                        $('#harvestModal #getaddress').val(vendo.address);
                        $('#harvestModal #getshares').val(vendo.shares + '%');
                        $('#harvestModal #s\\.amount').val('');
                        $('#harvestModal #my\\.share').val('');
                        $('#harvestModal #addRemarks').val('');
                        $('#harvestModal input[name="addLHD"]').val(vendo.lhd);

                        // Save share percent in modal for later calculation
                        $('#harvestModal').data('share-percent', parseFloat(vendo.shares));

                        // Remove any receipt field
                        $('#harvestModal #addReceipt').remove();
                        $('#harvestModal form input[name="receipt_number"]').remove();

                        // Show modal
                        const harvestModal = new bootstrap.Modal(document.getElementById('harvestModal'));
                        harvestModal.show();
                    },
                    error: function(err) {
                        console.error('Error fetching vendo data:', err);
                    }
                });
            });


            // Live calculation
            $(document).on('input', '#harvestModal input[name="amount"]', function() {
                let harvestAmount = parseFloat($(this).val()) || 0;
                let sharePercent = parseFloat($('#harvestModal').data('share-percent')) || 0;

                // Calculate shares
                let sAmount = (harvestAmount * (sharePercent / 100)).toFixed(2);
                let myShare = (harvestAmount - sAmount).toFixed(2);

                // Update fields
                $('#harvestModal #samount').val(sAmount);
                $('#harvestModal #myshare').val(myShare);
            });
        </script>


        <script>
$(document).ready(function() {
    $('#transactionForm').submit(function(e) {
        e.preventDefault(); // prevent page reload

        var formData = new FormData(this);
        var submitBtn = $(this).find('button[type="submit"]');

        // Disable button to prevent multiple clicks
        submitBtn.prop('disabled', true).text('Processing...');

        $.ajax({
            url: "{{ route('admin.vendos.storeTransaction') }}",
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
                                value: true,
                                visible: true,
                                className: "btn btn-success",
                                closeModal: true
                            }
                        }
                    }).then(() => {
                        // Optional: reload or update page if needed
                        window.location.reload();
                    });

                    $('#harvestModal').modal('hide');
                    $('#vendoForm')[0].reset(); // reset form
                }
            },
            error: function(err) {
                console.log(err);
                swal({
                    title: "Oops!",
                    text: err.responseJSON?.error || 'Failed to save transaction.',
                    icon: "error",
                    buttons: {
                        confirm: {
                            text: "Close",
                            value: true,
                            visible: true,
                            className: "btn btn-danger",
                            closeModal: true
                        }
                    }
                });
            },
            complete: function() {
                // Re-enable button after request
                submitBtn.prop('disabled', false).text('Pay');
            }
        });
    });
});
</script>

    @endpush
@endsection
