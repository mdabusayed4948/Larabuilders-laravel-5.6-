@extends('layouts.backend.app')

@section('title','Client')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet" />

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <a class="btn bg-blue-grey  m-t-15 waves-effect" href="{{ route('admin.client.create') }}">
                <i class="material-icons">add_circle</i><span> Add New Client</span>
            </a>
        </div>

        <!-- Exportable Table -->
        @if($clients->count() > 0 )
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL Client's Information
                            <span class="badge bg-blue">{{ $clients->count() }}</span>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>name</th>
                                    <th>Designation</th>
                                     <th>Company</th>
                                    <th>Status</th>
                                    <th>Updated_At</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>name</th>
                                    <th>Designation</th>
                                    <th>Company</th>
                                    <th>Status</th>
                                    <th>Updated_At</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($clients as $key => $client)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img src="{{ asset( 'public/images/clients/small/'.$client->image )}}" width="60" height="60" alt="client" /></td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->designation }}</td>
                                        <td>{{ $client->company }}</td>
                                        <td>
                                            @if($client->status == true)
                                                <span class="badge bg-blue">Published</span>
                                            @else
                                                <span class="badge bg-pink">Pending</span>

                                            @endif
                                        </td>
                                        <td>{{ $client->updated_at }}</td>
                                        <td class="text-center">

                                            <a class="btn btn-xs bg-teal waves-effect waves-float" href="{{ route('admin.client.edit',$client->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button class="btn btn-danger btn-xs waves-effect waves-float" type="button" onclick="deleteClient({{ $client->id }})" data-toggle="tooltip" data-placement="top" title="Remove">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $client->id }}" action="{{ route('admin.client.destroy',$client->id) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>

    <script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteClient(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>

@endpush