@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' :  'manager.layouts.app' )


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Location/Responce</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Location/Responce</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <!-- <div class="card-header">
                              <h3 class="card-title">User Managment</h3>
                            </div> -->
                            <!-- /.card-header -->
                            <div class="card-header">
                                {{-- <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal">
                                    New Location
                                </button> --}}
                                {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('location.store') }}" method="post">
                                                    @csrf
                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                        <div class="form-group">

                                                            @foreach ($locations as $location)
                                                                <div class="col-12">

                                                                    <label
                                                                        for="location_{{ $location->id }}">{{ $location->name }}</label>
                                                                    @foreach ($checklists as $checklist)
                                                                    <div class="d-flex">

                                                                        <input type="checkbox" class="form-check"
                                                                            name="assignments[{{ $location->id }}][]"
                                                                            value="{{ $checklist->id }}"
                                                                            id="location_{{ $location->id }}_checklist_{{ $checklist->id }}">
                                                                        <label
                                                                            for="location_{{ $location->id }}_checklist_{{ $checklist->id }}" class="form-label">{{ $checklist->name }}</label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" id="add-checklist-item">Add
                                                    Checklist Item</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save
                                                    changes</button>
                                                <a href="">

                                                </a>
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Job Name</th>
                                            <th>Assigned Manager Name</th>
                                            <th>Assigned Checklists</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($show)
                                            @foreach ($show as $shows)
                                                <tr>
                                                    <td>{{ $shows->name }}</td>
                                                    <td>{{ $shows->manager->name ?? 'null' }}</td>
                                                    <td>
                                                        @foreach ($shows->inspectionChecklists as $checklist)
                                                            <li>{{ $checklist->name }}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>

                                                            @if ($shows->inspectionResponse->count() > 0)
                                                            <a class="btn btn-info"
                                                                href="{{ route('adminresponse', $shows->id) }}">Show Response</a>
                                                                <button class="btn btn-primary" data-toggle="modal"
                                                            data-target="#checklistModal_{{ $shows->id }}">View
                                                            Checklist Items</button>
                                                            @else
                                                            <button class="btn btn-primary" data-toggle="modal"
                                                            data-target="#checklistModal_{{ $shows->id }}">View
                                                            Checklist Items</button>
                                                                @endif
                                                    </td>
                                                    <!-- Modal for Checklist Items -->
                                                    <div class="modal fade" id="checklistModal_{{ $shows->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="checklistModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="checklistModalLabel">
                                                                        Checklist Items for {{ $shows->name }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <ul>
                                                                        @foreach ($shows->inspectionChecklists as $checklist)
                                                                            <li
                                                                                class="text-uppercase font-weight-bold my-2">
                                                                                {{ $checklist->name }}</li>
                                                                            <ul>
                                                                                @foreach ($checklist->checklistItems as $item)
                                                                                    <li>{{ $item->description }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>



@endsection
