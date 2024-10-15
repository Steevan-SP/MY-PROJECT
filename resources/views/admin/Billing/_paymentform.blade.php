<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="row mb-3">
    <div class="col-md-4">
        <label for="total_amount" class="form-label">Total Amount:</label>
    </div>
    <div class="col-md-6">
        <input type="text" class="form-control" id="total_amount" name="total_amount" value="{{$billing->total_amount}}" >
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <label for="payment_mode" class="form-label">Payment Mode:</label>
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

<script>
    $(document).ready(function() {
        // Show or hide card fields based on payment mode selection
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
