<div>
    <x-modals.modal>
        @if (!empty($data) && empty($data['delete']))
        <x-slot:title>
            Update Sale
        </x-slot>
        <form autocomplete="off" wire:submit.prevent="update">
            <div class="form-group">
                <x-form.wire.select name="product" label="Product">
                    @foreach ($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </x-form.wire.select>
            </div>
            <div class="form-group">
                <x-form.wire.input type="number" name="quantity" label="Quantity"></x-form.wire.input>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @elseif(!empty($data['delete']))
        <div class="form-header">
            <h3>Delete Sale</h3>
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
            Add Sale
        </x-slot>
        <form autocomplete="off" wire:submit.prevent="store">
            <div class="form-group">
                <x-form.wire.select name="product" label="Product">
                    @foreach ($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </x-form.wire.select>
            </div>
            <div class="form-group">
                <x-form.wire.input type="number" name="quantity" label="Quantity"></x-form.wire.input>
            </div>

            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
        @endif
    </x-modals.modal>
</div>
