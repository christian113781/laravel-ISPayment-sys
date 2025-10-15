@extends('user.layouts.app')
@section('customer_transaction')
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
                                <h4 class="card-title">Transactions</h4>        
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>RECEIPT #</th>
                                            <th>NAME</th>
                                            <th>AREA</th>
                                            <th>ADDRESS</th>
                                            <th>PAYMENT METHOD</th>
                                            <th>AMOUNT</th>
                                            <th>REMARKS</th>
                                            <th>STATUS</th>
                                            <th>CREATED AT</th>
                                            <th>ACTIONS</th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>RECEIPT #</th>
                                            <th>NAME</th>
                                            <th>AREA</th>
                                            <th>ADDRESS</th>
                                            <th>PAYMENT METHOD</th>
                                            <th>AMOUNT</th>
                                            <th>REMARKS</th>
                                            <th>STATUS</th>
                                            <th>CREATED AT</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->receipt_number }}</td>
                                                <td>{{ $transaction->customer->name }}</td>
                                                <td>{{ $transaction->customer->area->name }}</td>
                                                <td>{{ $transaction->customer->address }}</td>
                                                <td>{{ $transaction->payment_method }}</td>
                                                <td>{{ $transaction->amount }}</td>
                                                <td>{{ $transaction->remarks }}</td>
                                                <td> <span class="badge bg-secondary fs-7 px-2 py-2">PAID</span></td>
                                                <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                                <td class="text-center">
                                                    @if ($transaction->receipt_image)
                                                        <a href="{{ asset('storage/' . $transaction->receipt_image) }}"
                                                            target="_blank" class="btn btn-sm btn-info text-white">
                                                            <i class="fas fa-receipt"></i>
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-warning" disabled>
                                                            <i class="fas fa-receipt"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('customers_transaction')
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable({
                    "pageLength": 100,
                    "order": [
                        [5, "desc"]
                    ]
                });
            });
        </script>
    @endpush
@endsection
