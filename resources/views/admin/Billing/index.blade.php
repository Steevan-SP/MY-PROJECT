@extends('layouts.admin.master')

@section('title', 'Billing')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Billing</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Place the order</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payable</h4>
                </div>

                <div class="container">
                    <h2>Billing</h2>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form id="billing-form" method="post" action="{{ route('billing.store') }}" enctype="multipart/form-data">
                        @csrf

                        <table class="table" id="billing-table">
                            <thead>
                                <tr>
                                    <th>ITEM NAME</th>
                                    <th>CODE NUMBER</th>
                                    <th>PRICE</th>
                                    <th>QUANTITY</th>
                                    <th>SUBTOTAL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select id="item" name="item[]" class="form-control" onchange="updateCodeAndPrice(this)">
                                            <option value="" disabled selected>Select Item</option>
                                            @foreach($stocks as $stock)
                                                <option value="{{ $stock->item_name }}" data-code="{{ $stock->code }}" data-price="{{ $stock->price }}">{{ $stock->item_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="code[]" id="code" class="form-control" readonly></td>
                                    <td><input type="text" name="price[]" id="price" class="form-control" readonly></td>
                                    <td><input type="text" name="quantity[]" id="quantity" class="form-control"></td>
                                    <td><input type="text" name="subtotal[]" id="subtotal" class="form-control" readonly></td>
                                    <td><button type="button" class="btn btn-danger" onclick="removeItem(this)">Remove</button></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"><strong>Total</strong></td>
                                    <td> <input type ="text" name="total_amount" id="total_amount" class="form-control"></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="button" class="btn btn-primary" onclick="addItem()">Add Item</button>
                        <button type="submit" class="btn btn-secondary btn-icon-split">
                            <span class="text">Proceed to payment</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#billing-table tbody').on('input', 'input[name="quantity[]"]', function() {
            calculateSubtotal($(this).closest('tr'));
        });

        $('#billing-form').submit(function(event) {
            if (!validateQuantities()) {
                event.preventDefault(); // Prevent form submission
                alert('Please enter quantity for all items.');
            }
        });
    });

    function addItem() {
        var newRow = `
            <tr>
                <td>
                    <select name="item[]" class="form-control" onchange="updateCodeAndPrice(this)">
                        <option value="" disabled selected>Select Item</option>
                        @foreach($stocks as $stock)
                            <option value="{{ $stock->item_name }}" data-code="{{ $stock->code }}" data-price="{{ $stock->price }}">{{ $stock->item_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="code[]" class="form-control" readonly></td>
                <td><input type="text" name="price[]" class="form-control" readonly></td>
                <td><input type="text" name="quantity[]" class="form-control"></td>
                <td><input type="text" name="subtotal[]" class="form-control" readonly></td>
                <td><button type="button" class="btn btn-danger" onclick="removeItem(this)">Remove</button></td>
            </tr>
        `;
        $('#billing-table tbody').append(newRow);
        calculateTotal(); 
    }

    function removeItem(btn) {
        $(btn).closest('tr').remove();
        calculateTotal();
    }

    function calculateTotal() {
        var total = 0;
        $('#billing-table tbody tr').each(function() {
            var subtotal = parseFloat($(this).find('input[name="subtotal[]"]').val()) || 0;
            total += subtotal;
        });
        $('#total_amount').val(total.toFixed(2));
    }

    function updateCodeAndPrice(select) {
        var selectedOption = $(select).find(':selected');
        var codeNumber = selectedOption.data('code');
        var price = selectedOption.data('price');
        $(select).closest('tr').find('input[name="code[]"]').val(codeNumber);
        $(select).closest('tr').find('input[name="price[]"]').val(price);
        calculateSubtotal($(select).closest('tr'));
    }

    function calculateSubtotal(row) {
        var price = parseFloat(row.find('input[name="price[]"]').val()) || 0;
        var quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
        var subtotal = price * quantity;
        row.find('input[name="subtotal[]"]').val(subtotal.toFixed(2));
        calculateTotal();
    }

    function validateQuantities() {
        var isValid = true;
        $('#billing-table tbody tr').each(function() {
            var quantity = $(this).find('input[name="quantity[]"]').val();
            if (quantity === '' || parseFloat(quantity) <= 0) {
                isValid = false;
                return false; // Exit the loop
            }
        });
        return isValid;
    }
</script>
@endsection
