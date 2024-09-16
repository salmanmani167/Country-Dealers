<div>
    <form wire:submit.prevent="update" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <x-form.wire.input name="checkin" type="time" label="Punch In Time"></x-form.wire.input>
        </div>
        <div class="form-group">
            <x-form.wire.input name="checkout" type="time" label="Punch Out Time"></x-form.wire.input>
        </div>
        <div class="submit-section">
            <button type="submit" class="btn btn-primary submit-btn">Save</button>
        </div>
    </form>
</div>
