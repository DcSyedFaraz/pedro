@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : (Auth::user()->hasRole('vendor') ? 'vendor.layouts.app' : (Auth::user()->hasRole('account manager') ? 'manager.layouts.app' : (Auth::user()->hasRole('User') ? 'users.layouts.app': 'default.app'))))


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header mb-5">
                <h1>Inspection Checklist</h1>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            {{-- @dd($response) --}}
                            @foreach ($response as $response1)
                                <div class="card-header">
                                    <h3 class="card-title">Inspection Checklist for {{ $response1->checklist->name ?? '' }}
                                    </h3>
                                </div>

                                <div class="card-body">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th>Sheet</th> --}}
                                                <th>Task</th>
                                                <th>Rating</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($response1->checklist->checklistItems as $responses)
                                                {{-- @dd($responses) --}}
                                                {{-- <h3 class="card-title">Inspection Checklist for
                                                {{ $response1->checklist->name ?? '' }}</h3> --}}
                                                <tr>
                                                    <td>{{ $responses->description ?? '' }}</td>
                                                    {{-- <td>{{ $responses->checklistItem->description ?? '' }}</td> --}}
                                                    <td>
                                                        @if ($responses->inspectionResponses1->rating === 'red')
                                                            <span class="badge badge-danger">Red</span>
                                                        @elseif ($responses->inspectionResponses1->rating === 'yellow')
                                                            <span class="badge badge-warning">Yellow</span>
                                                        @elseif ($responses->inspectionResponses1->rating === 'green')
                                                            <span class="badge badge-success">Green</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $responses->inspectionResponses1->remarks }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Notes
                                        </th>
                                        <th>
                                            Image
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td colspan="">
                                        {{ $new->notess->notes ?? '' }}
                                    </td>
                                    <td>
                                        @if (isset($new->notess->file))
                                            <img src="{{ asset('storage/' . $new->notess->file) }}" alt=""
                                                srcset="" class="img-thumbnail">
                                        @endif
                                    </td>
                                </tbody>

                            </table>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>
@endsection
