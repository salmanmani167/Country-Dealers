@livewireScripts

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery-3.7.0.min.js')}}"></script>
<!-- Bootstrap Core JS -->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

<!-- Slimscroll JS -->
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>

<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('assets/js/app.js')}}"></script>
@vite([
    'resources/js/app.js',
])
<script>
    $(document).ready(function (){

        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', '') }}";
            var message = "{{ ucwords(Session::get('message')) }}"
            switch (type) {
                case 'info':
                    toastr.info(message);
                    break;

                case 'success':
                    toastr.success(message);
                    break;

                case 'warning':
                    toastr.warning(message);
                    break;

                case 'error':
                    toastr.error(message);
                    break;

                case 'danger':
                    toastr.error(message);
                    break;
                default:
                    toastr.success(message);
                    break;
            }
        @endif
        window.livewire.on('notify', (data) =>
        {
            var type = data['type'];
            var message = data['message'];
                switch (type) {
                    case 'info':
                        toastr.info(message);
                        break;

                    case 'success':
                        toastr.success(message);
                        break;

                    case 'warning':
                        toastr.warning(message);
                        break;

                    case 'error':
                        toastr.error(message);
                        break;

                    case 'danger':
                        toastr.error(message);
                        break;
                    default:
                        toastr.success(message);
                        break;
                }
        });
    });
</script>
@yield('page-scripts')
@stack('page-scripts')

