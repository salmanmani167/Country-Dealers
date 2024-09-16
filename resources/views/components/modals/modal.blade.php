<div>
    <div wire:ignore.self class="modal custom-modal fade" id="{{$id ?? 'reusableModal'}}" tabindex="-1" role="dialog" aria-labelledby="reusableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered {{$type ?? ''}}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if (!empty($title))
                    <h5 class="modal-title">{{ ucwords($title) }}</h5>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    @push('page-scripts')
        <script>
            document.addEventListener("livewire:load", function () {
                Livewire.on('reusableModalOpened', function (e) {
                    var modal_id = e.modal;
                    if(modal_id != null && modal_id != "" && typeof modal_id != "undefined"){
                        $(modal_id).modal('show');
                    }else{
                        $("#{{$id ?? 'reusableModal'}}").modal('show');
                    }
                });

                Livewire.on('reusableModalClosed', function (e) {
                    var modal_id = e.modal;
                    if(modal_id != null && modal_id != "" && typeof modal_id != "undefined"){
                        $(`#${modal_id}`).modal('hide');
                    }else{
                        $("#{{$id ?? 'reusableModal'}}").modal('hide')
                    }
                });
            });
        </script>
    @endpush
</div>

