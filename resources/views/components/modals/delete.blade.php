<div>
    <div wire:ignore.self class="modal custom-modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete {{$title}}</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form wire:submit.prevent="delete">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn">Delete</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('page-script')
        <script>
            document.addEventListener("livewire:load", function () {
                Livewire.on('deleteModalOpened', function () {
                    $('#deleteModal').modal('show');
                });

                Livewire.on('deleteModalClosed', function () {
                    $('#deleteModal').modal('hide');
                });
            });
        </script>
    @endpush
</div>

