@extends('layouts.app', ['activePage' => 'schools', 'titlePage' => __('Schools')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Schools List</h4>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-default float-right"
                                        data-toggle="modal" data-target="#createSchool">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <table id="schools-table-table" class="table table-bordered yajra-datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="45%">Name</th>
                                        <th class="text-center" width="45%">Students NO.</th>
                                        <th class="text-center" width="5%">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createSchool" tabindex="-1" role="dialog" aria-labelledby="createSchoolLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSchoolLabel">Create School</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="post" id="createSchoolForm" enctype='multipart/form-data'>
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter username">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitForm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            let table = $('#schools-table-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('schools.list') }}",
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'students_no', name: 'students_no'},
                    {data: 'action', name: 'action'},
                ]
            });


            $('#name').attr('required', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#createSchoolForm').on('submit', function (e){
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('schools.store') }}",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    success: function(msg) {
                        table.draw();
                        $('#createSchool').modal('toggle');
                        $('#createSchool form')[0].reset();
                    }
                });
            });

            $(document).on("click", "#deleteSchool", function () {
                let row = $(this).closest('tr');
                let data = table.row(row).data();
                let token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: "schools/" + data.id,
                    type: 'DELETE',
                    data: {
                        "id": data.id,
                        "_token": token,
                    },
                    success: function () {
                        console.log("it Works");
                        table.draw();
                    }
                });
            });
        });
    </script>
@endsection
