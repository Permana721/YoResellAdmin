@extends('layout.app')
@section('title', 'Detail Transaksi')

@section('content')

@include('errors.success')

<div class="card">
    <div class="card-body">
        <div class="row mb-2" style="position: relative; top: 5px;">
            <div class="col-md-3">
                <p>From</p>
                <input type="month" id="fromDate" class="form-control" value="{{ date('Y-m', strtotime('first day of january this year')) }}">
            </div>
            <div class="col-md-3">
                <p>To</p>
                <input type="month" id="toDate" class="form-control" value="{{ date('Y-m') }}">
            </div>
            <div class="col-md-3">
                <p>Stores</p>
                <select id="store" class="form-control">
                    <option value="ALL">ALL</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->store_code }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <p>Type</p>
                <select id="typeCustomer" class="form-control">
                    <option value="ALL">ALL</option>
                    @foreach($typeCustomers as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mt-2">
                <button id="filter" class="btn btn-primary">Show</button>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5>Sales Overview</h5>
                <canvas id="salesChart"></canvas>
            </div>
        </div>        

        <div class="row mb-5 ml-2" style="position: relative; justify-content: end; top: 68px; right: 20px;">
            <div class="d-flex align-items-center">
                <h6 class="mb-0 me-5 mr-1">Search :</h6> 
                <input type="text" id="searchInput" class="form-control" style="width: auto;">
            </div>
        </div>        

        <section id="table-roles">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card-datatable table-responsive pt-0">
                        <table id="detailedTable" class="display table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Periode</th>
                                    <th>Cabang</th>
                                    <th id="tipeCustomerHeader">Type Customer</th>
                                    <th>Sales QTY</th>
                                    <th>Sales Rupiah</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

@section('scripts')
<style>
    div.dataTables_paginate {
        position: relative;
        top: -40px;
    }
</style>

<script>
    $(document).ready(function() {
        let table = $('#detailedTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('sales.getSalesMonthly') }}",
                data: function (d) {
                    d.page = Math.ceil(d.start / d.length) + 1;
                    d.per_page = d.length;
                    d.start_date = $('#fromDate').val();
                    d.end_date = $('#toDate').val();
                    d.store = $('#store').val();
                    d.type_customer = $('#typeCustomer').val();
                    d.search = $('#searchInput').val();
                }
            },
            columns: [
                { data: 'no', name: 'no' },
                { data: 'periode', name: 'periode' },
                { data: 'cabang', name: 'cabang' },
                { data: 'tipe_customer', name: 'tipe_customer' },
                { data: 'sales_qty', name: 'sales_qty' },
                { data: 'total_penjualan', name: 'total_penjualan' }
            ],
            dom: 'Brtip',
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn btn-primary',
                    text: 'Copy'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: 'Excel'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: 'CSV'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: 'PDF'
                }
            ],
            language: {
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoFiltered: "",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                paginate: {
                    previous: "&nbsp;",
                    next: "&nbsp;"
                }
            }
        });

        $('#store').on('change', function() {
            table.draw();
            updateChart();
        });

        $('#filter').on('click', function() {
            table.draw();
            updateChart();
        });

        $('#searchInput').on('keyup', function() {
            table.search($(this).val()).draw();
        });

        $('#typeCustomer').on('change', function() {
            let selectedType = $(this).val();
            let headerText = selectedType == 'ALL' ? 'Tipe Pelanggan (ALL)' : 'Tipe Pelanggan';
            $('#tipeCustomerHeader').text(headerText);
            updateChart();
        });

        function updateChart() {
            $.ajax({
                url: "{{ route('sales.getSalesChartData') }}",
                data: {
                    start_date: $('#fromDate').val(),
                    end_date: $('#toDate').val(),
                    store: $('#store').val(),
                    type_customer: $('#typeCustomer').val()
                },
                success: function(data) {
                    var ctx = document.getElementById('salesChart').getContext('2d');
                    var salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels, // e.g., ["January - 2024", "February - 2024"]
                            datasets: [{
                                label: 'Sales Quantity',
                                data: data.qtyData, // Array of sales quantities
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                tension: 0.4 // Smooth curve
                            }, {
                                label: 'Sales Amount',
                                data: data.priceData, // Array of sales amounts
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1,
                                tension: 0.4 // Smooth curve
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        }

        // Initial chart load
        updateChart();

    });
</script>
@endsection