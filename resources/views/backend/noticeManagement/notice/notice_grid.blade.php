<!DOCTYPE html>

<html>

<head>

    <title>Laravel Datatables Server Side Data Processing Example - ItSolutionStuff.com</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>



    <div class="container">

        <h1>Laravel Datatables Server Side Data Processing Example <br /> ItSolutionStuff.com</h1>

        <table class="table table-bordered data-table">

            <thead>

                <tr>

                    <th>@lang('Serial')</th>
                    <th>@lang('Subject')</th>
                    <th>@lang('From')</th>
                    <th>@lang('To')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Action')</th>

                </tr>

            </thead>

            <tbody>

            </tbody>

        </table>

    </div>



</body>



<script type="text/javascript">
    $(function() {



        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin/notice-management/noticeList') }}",
                dataType: "json",
                type: "GET",
                data: {
                    _token: "{{csrf_token()}}",
                    id: 5
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },

                {
                    data: 'rule_name',
                    name: 'Subject'
                },

                {
                    data: 'from_user_name',
                    name: 'From'
                },
                {
                    data: 'to_user_name',
                    name: 'To'
                },
                {
                    data: 'created_at',
                    name: 'Date'
                },
                {
                    data: 'status_name',
                    name: 'Status'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]

        });



    });
</script>

</html>