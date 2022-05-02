@extends('admin.layouts.app')

@section('title', __('labels.UserList'))

@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i
                            class="icon-home2 mr-2"></i>{{ __('menu.home') }}</a>
                    <span class="breadcrumb-item active">{{ __('menu.users') }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content">
        <!-- Profile info -->
        <div class="card">

            <div class="card-body">
            </div>

            <table class="table datatable-list">
            </table>
        </div>

        <!-- Bottom right menu -->
        <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right">
            <li>
                <a class="fab-menu-btn btn bg-blue btn-float rounded-round btn-icon cursor-pointer"
                   href="{{ route('admin.users.create') }}">
                    <i class="fab-icon-open icon-plus3"></i>
                </a>
            </li>
        </ul>
        <!-- /bottom right menu -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables_basic.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/custom.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ui/fab.min.js') }}"></script>
    <script>
        var PreVisionSoftTechDatatablesDataSourceAjaxServer = function () {

            var initTable1 = function () {
                var table = $('.datatable-list').DataTable({
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    order: [],
                    ajax: {
                        url: '{!! route('admin.users.fetch') !!}',
                        method: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: function (data) {
                            data.status = $('.status').val();
                        }
                    },
                    columns: [
                        {
                            data: 'first_name',
                            field: '{{ __('labels.firstName') }}',
                            title: '{{ __('labels.firstName') }}',
                        },
                        {
                            data: 'last_name',
                            field: '{{ __('labels.lastName') }}',
                            title: '{{ __('labels.lastName') }}',
                        },
                        {
                            data: 'email',
                            field: '{{ __('labels.email') }}',
                            title: '{{ __('labels.email') }}',
                        },
                        {
                            field: 'action',
                            title: '{{ __('labels.action') }}',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                //return "Yes";
                                return actionList(full);
                            },
                        },
                    ],
                });

                deleteAction(table);
                filter(table);
            };

            /**
             * @param data
             * @returns {string}
             */
            var actionList = function (data) {
                var editUrl = '{{ route('admin.users.edit', ['user' => ':user']) }}',
                    viewUrl = '{{ route('admin.users.show', ['user' => ':user']) }}',
                    editAction = '<a href="' + editUrl.replace(':user', data.id) + '" class="dropdown-item" data-id=' + data.id + '><i class="icon-pencil7"></i>{{ __('labels.edit') }}</a>';

                var actionHtml = '<div class="list-icons">';
                actionHtml += '<div class="dropdown">';
                actionHtml += '<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a>';
                actionHtml += '<div class="dropdown-menu dropdown-menu-right">' + editAction;
                actionHtml += '<a href="' + viewUrl.replace(':user', data.id) + '" class="dropdown-item"><i class="icon-eye2"></i>{{ __('labels.view') }}</a>';
                actionHtml += '<a href="javascript:void(0)" class="dropdown-item delete-action" data-status=' + data.status + ' data-id=' + data.id + '><i class="icon-trash"></i>{{ __('labels.delete') }}</a>';
                actionHtml += "<div>"
                actionHtml += "</div>";
                actionHtml += "</div>";
                return actionHtml;
            }

            var deleteAction = function (table) {
                $(document).on("click", ".delete-action", function () {
                    if (confirm("{{ __("messages.deleteMsg") }}")) {
                        var url = '{{ route('admin.users.destroy', ['user' => ':user'])}}';

                        $.ajax({
                            url: url.replace(':user', $(this).attr('data-id')),
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

            var filter = function (table) {
                $('.status').select2({
                    minimumResultsForSearch: Infinity
                });
                $(document).on('click', '#search-filter', function () {
                    table.draw(false)
                })
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
