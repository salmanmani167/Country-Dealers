<div>
    <x-modals.modal type="modal-md">
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Product
        </x-slot>
        <form wire:submit.prevent="update">
            <div class="form-group">
                <x-form.wire.input name="name" label="Product Name"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="supplier" label="Product Supplier"></x-form.wire.input>
            </div>

            <div class="form-group">
                <x-form.wire.input name="quantity" type="number" label="Quantity"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="cost" type="number" label="Cost Price"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="retail" type="number" label="Retail Price"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.textarea name="desc" label="Description"></x-form.wire.input>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Product <b>{{$name}}</b></h3>
            <p>Are you sure want to delete?</p>
        </div>
        <form wire:submit.prevent="delete">
            <div class="modal-btn delete-action">
                <div class="row">
                    <div class="col-6">
                        <button type="submit"  class="btn btn-primary w-100 continue-btn">Delete</button>
                    </div>
                    <div class="col-6">
                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
        @else
        <x-slot:title>
            Add Product
        </x-slot>
        <form wire:submit.prevent="store">
            <div class="form-group">
                <x-form.wire.input name="name" label="Product Name"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="supplier" label="Product Supplier"></x-form.wire.input>
            </div>

            <div class="form-group">
                <x-form.wire.input name="quantity" type="number" label="Quantity"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="cost" type="number" label="Cost Price"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.input name="retail" type="number" label="Retail Price"></x-form.wire.input>
            </div>
            <div class="form-group">
                <x-form.wire.textarea name="desc" label="Description"></x-form.wire.input>
            </div>

            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>
</div>
