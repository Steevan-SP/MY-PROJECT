<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'payment_id',
        'card_type',
        'total_amount',
    ];
    public function payment()
    {
        return $this->belongsTo(Payment::class,'payment_id');
    if ($stock && $stock->quantity !== null) {
        if ($stock->quantity < $quantity) {
            // Define the item name and available quantity for the message
            $itemName = $stock->item_name;  // Assuming 'item_name' is the property that holds the item name
            $availableQuantity = $stock->quantity;
            
            // Log a detailed warning message
            \Log::warning("Attempted to deduct $quantity of $itemName, but only $availableQuantity available in stock. Deduction not performed.");
            
            // Redirect back with a detailed error message including the item name
            return redirect()->back()->with('error', "Insufficient stock for $itemName. Only $availableQuantity available.");
    }

    //billing 
//     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
// <script>
//     $(document).ready(function() {
//         var selectedItems = [];

//         // Function to update the available options in the dropdowns
//         function updateAvailableOptions() {
//             selectedItems = [];
//             $('#billing-table tbody select[name="item[]"]').each(function() {
//                 var selectedItem = $(this).val();
//                 if (selectedItem) {
//                     selectedItems.push(selectedItem);
//                 }
//             });

//             $('#billing-table tbody select[name="item[]"]').each(function() {
//                 var $select = $(this);
//                 $select.find('option').each(function() {
//                     var $option = $(this);
//                     if (selectedItems.includes($option.val()) && $option.val() !== $select.val()) {
//                         $option.prop('disabled', true);
//                     } else {
//                         $option.prop('disabled', false);
//                     }
//                 });
//                 $select.find('option:first').prop('disabled', false); // Always enable the "Select Item" option
//             });
//         }

//         // Function to add a new item row
//         function addItem() {
//             var newRow = `
//                 <tr>
//                     <td>
//                         <select name="item[]" class="form-control" onchange="updateCodeAndPrice(this)">
//                             <option value="" disabled selected>Select Item</option>
//                             @foreach($stocks as $stock)
//                                 <option value="{{ $stock->item_name }}" data-code="{{ $stock->code }}" data-price="{{ $stock->price }}">{{ $stock->item_name }}</option>
//                             @endforeach
//                         </select>
//                     </td>
//                     <td><input type="text" name="code[]" class="form-control" readonly></td>
//                     <td><input type="text" name="price[]" class="form-control" readonly></td>
//                     <td><input type="text" name="quantity[]" class="form-control"></td>
//                     <td><input type="text" name="subtotal[]" class="form-control" readonly></td>
//                     <td><button type="button" class="btn btn-danger" onclick="removeItem(this)">Remove</button></td>
//                 </tr>
//             `;
//             $('#billing-table tbody').append(newRow);
//             updateAvailableOptions(); // Update options after adding new row
//             calculateTotal(); // Recalculate total
//         }

//         // Function to remove an item row
//         function removeItem(btn) {
//             $(btn).closest('tr').remove();
//             updateAvailableOptions(); // Update options after removing row
//             calculateTotal(); // Recalculate total
//         }

//         // Function to calculate the subtotal for a row
//         function calculateSubtotal(row) {
//             var price = parseFloat(row.find('input[name="price[]"]').val()) || 0;
//             var quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
//             var subtotal = price * quantity;
//             row.find('input[name="subtotal[]"]').val(subtotal.toFixed(2));
//             calculateTotal(); // Recalculate total
//         }

//         // Function to calculate the total amount
//         function calculateTotal() {
//             var total = 0;
//             $('#billing-table tbody tr').each(function() {
//                 var subtotal = parseFloat($(this).find('input[name="subtotal[]"]').val()) || 0;
//                 total += subtotal;
//             });
//             $('#total_amount').val(total.toFixed(2));
//         }

//         // Function to update code and price fields when an item is selected
//         function updateCodeAndPrice(select) {
//             var $select = $(select);
//             var selectedOption = $select.find(':selected');
//             var codeNumber = selectedOption.data('code');
//             var price = selectedOption.data('price');
//             var $row = $select.closest('tr');
            
//             // Update code and price fields
//             $row.find('input[name="code[]"]').val(codeNumber || '');
//             $row.find('input[name="price[]"]').val(price || '');
//             calculateSubtotal($row); // Calculate subtotal for this row
//         }

//         // Function to validate quantities before form submission
//         function validateQuantities() {
//             var isValid = true;
//             $('#billing-table tbody tr').each(function() {
//                 var quantity = $(this).find('input[name="quantity[]"]').val();
//                 if (quantity === '' || parseFloat(quantity) <= 0) {
//                     isValid = false;
//                     return false; // Exit the loop
//                 }
//             });
//             return isValid;
//         }

//         // Event listener for form submission
//         $('#billing-form').submit(function(event) {
//             if (!validateQuantities()) {
//                 event.preventDefault(); // Prevent form submission
//                 alert('Please enter quantity for all items.');
//             }
//         });

//         // Event listener for quantity changes
//         $('#billing-table').on('input', 'input[name="quantity[]"]', function() {
//             calculateSubtotal($(this).closest('tr'));
//         });

//         // Expose functions to global scope for inline event handlers
//         window.addItem = addItem;
//         window.removeItem = removeItem;
//         window.updateCodeAndPrice = updateCodeAndPrice;
//     });
// </script>

}
    }
}

<div id="localForm" name="localForm" class="d-none">
    <h2>Local Form</h2>
    <form id="addressForm" class="needs-validation" novalidate>
        <!-- Address Line 1 -->
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="addressline1">Address Line - 01<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="addressline1" name="addressline1" placeholder="Enter the Address line - 01" value="" required>
                <div class="invalid-feedback">Enter the Address Line 1.</div>
            </div>
        </div>

        <!-- Address Line 2 -->
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="addressline2">Address Line - 02</label>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="addressline2" name="addressline2" placeholder="Enter the Address line - 02" value="">
                <div class="invalid-feedback">Enter the Address Line 2.</div>
            </div>
        </div>

        <!-- City -->
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="city">City<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="" required>
                <div class="invalid-feedback">Enter the City.</div>
            </div>
        </div>

        <!-- Phone -->
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="phone">Phone (SL)<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="0700000000" required>
                <span id="phoneError" class="text-danger"></span>
            </div>
        </div>
    </form>
    
    <!-- Search Form -->
    <form id="searchForm" action="{{ route('search.payments') }}" method="GET" class="ml-auto">
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="id_number">National ID Card Number<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <div class="input-group search-area">
                    <input type="text" name="search" class="form-control" id="id_number" placeholder="Search by id_number ..." required>
                    <span class="input-group-text">
                        <button type="button" id="searchButton"><i class="flaticon-381-search-2"></i></button>
                    </span>
                </div>
                <span id="IdError" class="text-danger"></span>
            </div>
        </div>
    </form>

    <!-- Results Display -->
    <div id="result" class="d-none">
        <!-- Content will be dynamically updated here -->
    </div>
</div>

<script>
document.getElementById('searchButton').addEventListener('click', function() {
    const idNumber = document.getElementById('id_number').value;
    const resultDiv = document.getElementById('result');
    const idError = document.getElementById('IdError');

    if (idNumber.trim() === '') {
        idError.textContent = 'ID number is required.';
        return;
    }

  
    fetch('{{ route('search.payments') }}?search=' + encodeURIComponent(idNumber))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update result display with the retrieved data
                resultDiv.classList.remove('d-none');
                resultDiv.innerHTML = `
                    <h3>Guest Details</h3>
                    <p><strong>Address Line 1:</strong> ${data.addressline1}</p>
                    <p><strong>Address Line 2:</strong> ${data.addressline2}</p>
                `;
            } else {
                idError.textContent = 'ID number not found.';
                resultDiv.classList.add('d-none');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            idError.textContent = 'An error occurred.';
            resultDiv.classList.add('d-none');
        });
});
</script>
