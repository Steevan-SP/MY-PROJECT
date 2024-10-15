@extends('layouts.admin.master')
@section('title', 'Daily Transaction Report')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="float-left ml-2">Daily Transaction Report</h6>
                <a href="{{ route('dailyTransaction.pdf', ['date' => $date, 'payment_mode' => $paymentMode]) }}" class="btn btn-primary float-right" target="_blank">PDF</a>
            </div>
            <div class="card-body">
                <div id="filters">
                    <form id="filterForm">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="date">Select Date:</label>
                                <input type="date" id="date" name="date" value="{{ $date }}" class="form-control" min="2024-01-01">

                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="payment_mode">Select Payment Mode:</label>
                                <select id="payment_mode" name="payment_mode" class="form-control">
                                    <option value="">All</option>
                                    <option value="Card" @if ($paymentMode == 'Card') selected @endif>Card</option>
                                    <option value="Cash" @if ($paymentMode == 'Cash') selected @endif>Cash</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                            <button type="submit" class="btn btn-success">Generate Report</button>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <table class="table table-striped" id="transactionTable">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Payment Mode</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->payment_mode }}</td>
                            <td>{{ $payment->total_amount }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No transactions found for the selected date or payment mode.</td>
                        </tr>
                        @endforelse
                        @if (!empty($payments))
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong>{{ $totalAmount }}</strong></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Submit form via AJAX
    $('#filterForm').submit(function(e) {
        e.preventDefault();
        generateReport();
    });

    // Function to generate report
    function generateReport() {
        var formData = $('#filterForm').serialize();
        $.ajax({
            url: "{{ route('dailyTransaction.filter') }}",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                $('#transactionTable tbody').html(response.html);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
</script>

@endsection
