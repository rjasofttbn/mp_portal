@php 
    $site_settings = App\SiteSetting::find(1); 
    // dd($site_settings->toArray());
@endphp

@if($site_settings->notification_type == 1)

    @if (session()->has('success'))                   {{-- Toastr success Notification --}}
        <script type="text/javascript">
            $(function () {
                toastr.success("","{{session()->get("success")}}");
            });
        </script>
    @endif

    @if (session()->has('info'))                      {{-- Toastr info Notification --}}
        <script type="text/javascript">
            $(function () {
               toastr.info("","{{session()->get("info")}}");
            });
        </script>
    @endif

    @if (session()->has('warning'))                  {{-- Toastr warning Notification --}}
        <script type="text/javascript">
            $(function () {
               toastr.warning("","{{session()->get("warning")}}");
            });
        </script>
    @endif  

    @if (session()->has('error'))                   {{-- Toastr error Notification --}}
        <script type="text/javascript">
            $(function () {
               toastr.error("","{{session()->get("error")}}");
            });
        </script>
    @endif

@elseif($site_settings->notification_type == 2)

    @if (session()->has('success'))                 {{-- swal success Notification --}}
        <script type="text/javascript">
            $(function () {
                const swal = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                });
                swal.fire({
                    type    : 'success',
                    title   : '{{session()->get("success")}}'
                });
            });
        </script>
    @endif

    @if (session()->has('info'))                  {{-- swal info Notification --}}
        <script type="text/javascript">
            $(function () {
                const swal = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                });
                swal.fire({
                    type    : 'info',
                    title   : '{{session()->get("info")}}'
                });
            });
        </script>
    @endif

    @if (session()->has('warning'))             {{-- swal warning Notification --}}
        <script type="text/javascript">
            $(function () {
                const swal = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                });
                swal.fire({
                    type    : 'warning',
                    title   : '{{session()->get("warning")}}'
                });
            });
        </script>
    @endif  

    @if (session()->has('error'))             {{-- swal error Notification --}}
        <script type="text/javascript">
            $(function () {
                const swal = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                });
                swal.fire({
                    type    : 'error',
                    title   : '{{session()->get("error")}}'
                });
            });
        </script>
    @endif

@elseif($site_settings->notification_type == 3)

    @if (session()->has('success'))         {{-- Notify js success Notification --}}
        <script type="text/javascript">
            $(function () {
                $.notify("{{session()->get("success")}}", {globalPosition: 'top right',className: 'success'});
            });
        </script>
    @endif

    @if (session()->has('info'))            {{-- Notify js info Notification --}}
        <script type="text/javascript">
            $(function () {
                $.notify("{{session()->get("info")}}", {globalPosition: 'top right',className: 'info'});
            });
        </script>
    @endif

    @if (session()->has('warning'))         {{-- Notify js warning Notification --}}
        <script type="text/javascript">
            $(function () {
                $.notify("{{session()->get("warning")}}", {globalPosition: 'top right',className: 'warn'});
            });
        </script>
    @endif

    @if (session()->has('error'))           {{-- Notify js error Notification --}}
        <script type="text/javascript">
            $(function () {
                $.notify("{{session()->get("error")}}", {globalPosition: 'top right',className: 'error'});
            });
        </script>
    @endif

@endif
