@extends('admin.layouts.app')

@section('title', ucfirst($user['first_name'].' '.$user['last_name']))

@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i
                            class="icon-home2 mr-2"></i>{{ __('menu.home') }}</a>
                    <span
                        class="breadcrumb-item active">{{ ucfirst($user['first_name'].' '.$user['last_name']) }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="content">
        <!-- Profile info -->
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#highlight-tab1" class="nav-link active"
                                            data-toggle="tab">{{ __('labels.userProduct') }}</a></li>
                    <li class="nav-item"><a href="#highlighted-tab2" class="nav-link"
                                            data-toggle="tab">{{ __('labels.userInfo') }}</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="highlight-tab1">
                        <table class="table datatable-list">
                        </table>
                    </div>

                    <div class="tab-pane fade" id="highlighted-tab2">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>{{ __('labels.firstName') }}</th>
                                <td>{{ $user['first_name'] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('labels.lastName') }}</th>
                                <td>{{ $user['last_name'] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('labels.email') }}</th>
                                <td>{{ $user['email'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables_basic.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/custom.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ui/fab.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/loaders/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script>
        var PreVisionSoftTechDatatablesDataSourceAjaxServer = function () {

            var initTable1 = function () {
                var reportedUserUrl = '{{ route('admin.user-products.list-user-products', ['user_products' => ':user_products']) }}';
                var table = $('.datatable-list').DataTable({
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    order: [],
                    ajax: {
                        url: reportedUserUrl.replace(':user_products', {{ $user->id }}),
                        method: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: function (data) {
                            data.report = $('.report').val();
                            data.start_end_date = $('.start-end-date').val();
                        }
                    },
                    columns: [
                        {
                            data: 'name',
                            field: '{{ __('labels.name') }}',
                            title: '{{ __('labels.name') }}',
                        },
                        {
                            field: 'action',
                            title: '{{ __('labels.action') }}',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                //return "Yes";
                                return actionList(full);
                            },
                        }
                    ],
                });

                deleteAction(table);
            };

            var actionList = function (data) {
                var editUrl = '{{ route('admin.user-products.edit', ['user_product' => ':user_product']) }}',
                    editAction = '<a href="' + editUrl.replace(':user_product', data.id) + '" class="dropdown-item" data-id=' + data.id + '><i class="icon-pencil7"></i>{{ __('labels.edit') }}</a>';

                var actionHtml = '<div class="list-icons">';
                actionHtml += '<div class="dropdown">';
                actionHtml += '<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a>';
                actionHtml += '<div class="dropdown-menu dropdown-menu-right">' + editAction;
                actionHtml += '<a href="javascript:void(0)" class="dropdown-item delete-action" data-status=' + data.status + ' data-id=' + data.id + '><i class="icon-trash"></i>{{ __('labels.delete') }}</a>';
                actionHtml += "<div>"
                actionHtml += "</div>";
                actionHtml += "</div>";
                return actionHtml;
            }


            var deleteAction = function (table) {
                $(document).on("click", ".delete-action", function () {
                    if (confirm("{{ __("messages.deleteMsg") }}")) {
                        var url = '{{ route('admin.products.destroy', ['product' => ':product'])}}';

                        $.ajax({
                            url: url.replace(':product', $(this).attr('data-id')),
                            type: 'delete',
                            datatype: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }, success: function (data) {
                                toastrMsg(data['status'], data.message);
                                table.draw(false);
                            }, error: function (error) {
                                toastrMsg("error", "{{ __('messages.serverError') }}");
                            }
                        });
                    }
                });
            }

            return {
                init: function () {
                    initTable1();
                },
            };
        }();

        jQuery(document).ready(function () {
            PreVisionSoftTechDatatablesDataSourceAjaxServer.init();
        });
    </script>
@endpush

