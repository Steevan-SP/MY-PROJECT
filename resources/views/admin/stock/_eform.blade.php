<div class="card-body">
    <div class="basic-form">
        <form>
            <div class="mb-3 row">
                <label for="itemName" class="col-sm-3 col-form-label">Item Name:</label>
                <div class="col-sm-9">
                    <input type="text" id="item_name" name="item_name" class="form-control" value="{{ $stock->item_name ?? '' }}">
                    
                </div>
            </div>
            <div class="mb-3 row">
                <label for="quantity" class="col-sm-3 col-form-label">Quantity:</label>
                <div class="col-sm-9">
                    <input type="number" id="quantity" name="quantity" class="form-control" min="0" value="{{ $stock->quantity ?? '' }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-sm-3 col-form-label">Price:</label>
                <div class="col-sm-9">
                    <input type="number" id="price" name="price" class="form-control" value="{{ $stock->price ?? '' }}">
                </div>
            </div>
        </form>
    </div>
</div>
