@extends('user.layouts.app')
@section('vendo_transaction')
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
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>AREA</th>
                                            <th>ADDRESS</th>
                                            <th>SHARE</th>
                                            <th>LHD</th>
                                            <th>H.AMOUNT</th>
                                            <th>S.AMOUNT</th>
                                            <th>MSHARE</th>
                                            <th>REMARKS</th>
                                            <th>D.CREATED</th>
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>AREA</th>
                                            <th>ADDRESS</th>
                                            <th>SHARE</th>
                                            <th>LHD</th>
                                            <th>H.AMOUNT</th>
                                            <th>S.AMOUNT</th>
                                            <th>M.SHARE</th>
                                            <th>REMARKS</th>
                                            <th>D.CREATED</th>
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->vendo->name }}</td>
                                                <td>{{ $transaction->vendo->area->name ?? '' }}</td>
                                                <td>{{ $transaction->vendo->address }}</td>
                                                <td>{{ $transaction->vendo->shares }}%</td>
                                                <td>{{ $transaction->vendo->lhd->format('Y-m-d') }}</td>
                                                <td>₱{{ number_format($transaction->amount, 2) }}</td>
                                                <td>₱{{ number_format($transaction->s_amount, 2) }}</td>
                                                <td>₱{{ number_format($transaction->my_share, 2) }}</td>
                                                <td>{{ $transaction->remarks }}</td>
                                               
                                                <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                                                 <td> <span class="badge bg-secondary fs-7 px-2 py-2">PAID</span></td>
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

    @push('vendos_transaction')
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
