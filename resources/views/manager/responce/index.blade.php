@extends('manager.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Responce</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Responce</li>
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

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Location Name</th>
                                            <th>Assigned Checklists</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($show)
                                            @foreach ($show as $shows)
                                                <tr>
                                                    <td>{{ $shows->name }}</td>
                                                    <td>
                                                        @foreach ($shows->inspectionChecklists as $checklist)
                                                            <li>{{ $checklist->name }}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if ($shows->inspectionResponse->count() > 0)
                                                            <a class="btn btn-info"
                                                                href="{{ route('responce.show', $shows->id) }}">Show</a>
                                                            <button class="btn btn-primary" data-toggle="modal"
                                                                data-target="#checklistModal_{{ $shows->id }}">Update
                                                                Response</button>

                                                            <!-- Modal for Checklist Items -->
                                                            <div class="modal fade" id="checklistModal_{{ $shows->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="checklistModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="checklistModalLabel">
                                                                                Checklist Items for {{ $shows->name }}</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Given Response Form -->
                                                                            <form action="{{ route('responce.store') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="location_id"
                                                                                    value="{{ $shows->id }}">

                                                                                @foreach ($shows->inspectionResponse as $item)

                                                                                    <input type="hidden"
                                                                                        name="checklist_item_id[]"
                                                                                        value="{{ $item->checklist_item_id }}">

                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            for="rating_{{ $item->id }}"
                                                                                            class="form-label">{{ $item->checklistItem->description }}</label>
                                                                                        <select name="rating[]"
                                                                                            id="rating_{{ $item->id }}"
                                                                                            class="form-select">
                                                                                            <option
                                                                                                {{ old('rating', isset($item->rating) ? $item->rating : '') == 'green' ? 'selected' : '' }}
                                                                                                value="green">Green
                                                                                            </option>
                                                                                            <option
                                                                                                {{ old('rating', isset($item->rating) ? $item->rating : '') == 'yellow' ? 'selected' : '' }}
                                                                                                value="yellow">Yellow
                                                                                            </option>
                                                                                            <option
                                                                                                {{ old('rating', isset($item->rating) ? $item->rating : '') == 'red' ? 'selected' : '' }}
                                                                                                value="red">Red</option>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            for="remarks_{{ $item->id }}"
                                                                                            class="form-label">Remarks:</label>
                                                                                        <textarea class="form-control" name="remarks[]" id="remarks_{{ $item->id }}">{{ isset($item->remarks) ? old('remarks', $item->remarks) : '' }}</textarea>
                                                                                    </div>
                                                                                @endforeach

                                                                                <button type="submit"
                                                                                    class="btn btn-success">Update
                                                                                    Inspection</button>
                                                                            </form>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <button class="btn btn-primary" data-toggle="modal"
                                                                data-target="#checklistModal_{{ $shows->id }}">Response</button>
                                                            <!-- Modal for Checklist Items -->
                                                            <div class="modal fade" id="checklistModal_{{ $shows->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="checklistModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="checklistModalLabel">
                                                                                Checklist Items for {{ $shows->name }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Inspection Response Form -->
                                                                            <form action="{{ route('responce.store') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="location_id"
                                                                                    value="{{ $shows->id }}"
                                                                                    id="">
                                                                                @foreach ($shows->inspectionChecklists as $checklist)
                                                                                    <li
                                                                                        class="text-uppercase font-weight-bold my-2">
                                                                                        {{ $checklist->name }}</li>
                                                                                    <ul>
                                                                                        @foreach ($checklist->checklistItems as $item)
                                                                                            <li class="my-2">
                                                                                                {{ $item->description }}
                                                                                                <input type="hidden"
                                                                                                    name="checklist_item_id[]"
                                                                                                    value="{{ $item->id }}"
                                                                                                    id="">
                                                                                                <input type="hidden"
                                                                                                    name="checklist_id[]"
                                                                                                    value="{{ $checklist->id }}"
                                                                                                    id="">
                                                                                                    <br>
                                                                                                <label
                                                                                                    for="rating_{{ $item->id }}">Rating:</label>
                                                                                                <select name="rating[]"
                                                                                                    id="rating_{{ $item->id }}"
                                                                                                    class="form-select">
                                                                                                    <option value="green">
                                                                                                        Green</option>
                                                                                                    <option value="yellow">
                                                                                                        Yellow</option>
                                                                                                    <option value="red">
                                                                                                        Red</option>
                                                                                                </select>
                                                                                                <br>
                                                                                                <label
                                                                                                    for="remarks_{{ $item->id }}">Remarks:</label>
                                                                                                <textarea class="form-control" name="remarks[]" id="remarks_{{ $item->id }}"></textarea>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endforeach



                                                                                <button type="submit"
                                                                                    class="btn btn-success">Submit
                                                                                    Inspection</button>
                                                                            </form>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
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


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $('#add-checklist-item').click(function() {
            var newChecklistItem = $(
                '<div class="my-2 new-checklist-item">' +

                '<input type="text" class="form-control my-custom-class" name="checklist_items[]" placeholder="Enter Checklist Item">' +


                '<div class="col-md-3 my-1">' +
                '<button type="button" class="btn btn-danger remove-checklist-item">Remove</button>' +

                '</div>' +
                '</div>'
            );

            $('#checklist-items').append(newChecklistItem);
        });

        $(document).on('click', '.remove-checklist-item', function() {
            $(this).closest('.new-checklist-item').remove();
        });
    </script>
@endsection