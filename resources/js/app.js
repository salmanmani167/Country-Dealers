import './bootstrap';
import.meta.glob([ '../assets/img/**', '../fonts/**']);
import Alpine from 'alpinejs'


window.Alpine = Alpine

Alpine.start()

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.livewire.on('closeModal', (e) =>
{
    if(e != undefined && e != ''){
        $(e).modal('hide');
    }else{
        $('.modal').modal('hide');
    }
    console.log('closed')
});
window.livewire.on('showModal', (e) =>
{
    if(e != undefined && e != ''){
        $(e).modal('show');
        console.log('opened')
    }
});

window.livewire.on('reloadTable', (e) => {
    $('.datatable').DataTable().ajax.reload();
});
window.livewire.on('reloadPage', (e) => {
    window.location.reload();
});


$('body').on('click','.trash',function(){
    var id = $(this).data('id');
    var route = $(this).data('route');
    var model = $(this).data('model');
    Swal.queue([
        {
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: '<i class="fa fa-trash mr-1"></i> Delete!',
            cancelButtonText: '<i class="fa fa-close"></i> Cancel !',
            confirmButtonClass: "btn btn-success mr-2",
            cancelButtonClass: "btn btn-danger ml-2",
            buttonsStyling: !1,
            preConfirm: function(){
                return new Promise(function(){
                    $.ajax({
                        url: route,
                        type: "DELETE",
                        data: {"id": id},
                        success: function(){
                            Swal.insertQueueStep(
                                Swal.fire({
                                    title: "Deleted!",
                                    text: `${model ?? 'Resource'} has been deleted.`,
                                    type: "success",
                                    showConfirmButton: !1,
                                    timer: 1500,
                                })
                            );
                            $('.datatable').DataTable().ajax.reload();
                        },
                        error: function(error){
                          var err = JSON.parse(error.responseText);
                          Swal.insertQueueStep(
                            Swal.fire({
                                  title: "Error!",
                                  text: err.message,
                                  type: "error",
                                  showConfirmButton: !1,
                                  timer: 2000,
                            })
                          )
                        }
                    })
                })
            }
        }
    ]).catch(Swal.noop);
});

if($('.datepicker').length > 0) {
    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            up: "fa fa-angle-up",
            down: "fa fa-angle-down",
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        }
    });
}


