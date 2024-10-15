<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Amount Calculator</title>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="invoice_number" class="form-label">Invoice Number:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ $guest->invoice_number }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="ticket_number" class="form-label">Ticket Number:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="ticket_number" name="ticket_number" value="{{ $guest->ticket_number }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="adult_count" class="form-label">Adults Count:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="adult_count" name="adult_count" value="{{ $guest->adult_count }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="kids_count" class="form-label">Kids Count:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="kids_count" name="kids_count" value="{{ $guest->kids_count }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="total_adults_price" class="form-label">Total Adults Price:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="total_adults_price" name="total_adults_price" value="{{ ($guest->guest_type == 'local') ? ($guest->adult_count * $guest->user->ticket->sl_price) : ($guest->adult_count * $guest->user->ticket->foreign_price + ($guest->kids_count ?? 0) * $guest->user->ticket->foreign_price_kids) }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="total_kids_price" class="form-label">Total Kids Price:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="total_kids_price" name="total_kids_price" value="{{ ($guest->guest_type == 'local') ? ($guest->kids_count ?? 0) * $guest->user->ticket->sl_price_kids : ($guest->kids_count ?? 0) * $guest->user->ticket->foreign_price_kids }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="total_amount" class="form-label">Total Amount:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="payment_mode" id="payment_mode" class="form-label">Payment Mode:</label>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_mode" id="payment_mode_card" value="card">
                    <label class="form-check-label" for="payment_mode_card">Card</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_mode" id="payment_mode_cash" value="cash">
                    <label class="form-check-label" for="payment_mode_cash">Cash</label>
                </div>
            </div>
        </div>

        <div class="row mb-3" id="card_fields" style="display: none;">
            <div class="col-md-4">
                <label for="card_type" class="form-label">Card Type:</label>
            </div>
            <div class="col-md-6">
                <select class="form-select" id="card_type" name="card_type">
                    <option value="visa_debit">Visa Debit</option>
                    <option value="visa_credit">Visa Credit</option>
                    <option value="mastercard">Mastercard</option>
                    <option value="amex">American Express</option>
                </select>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function calculateTotal() {
                var totalAdultsPrice = parseFloat($('#total_adults_price').val()) || 0;
                var totalKidsPrice = parseFloat($('#total_kids_price').val()) || 0;
                var totalAmount = totalAdultsPrice + totalKidsPrice;

                $('#total_amount').val(totalAmount.toFixed(2));
            }
            calculateTotal();
            $('#total_adults_price, #total_kids_price').on('input', calculateTotal);
            $('input[name="payment_mode"]').change(function() {
                var selectedMode = $(this).val();

                if (selectedMode === 'card') {
                    $('#card_fields').show(); 
                } else {
                    $('#card_fields').hide(); 
                }
            });

             // Validate the form before submission
        $('#payment-form').on('submit', function(event) {
            if (!$('input[name="payment_mode"]:checked').val()) {
                alert('Please select a payment mode.');
                event.preventDefault(); // Prevent form submission
            }
        });
        });
    </script>

