@extends('users.layouts.app')


@section('content')
    <style>
        body {
            font-family: sans-serif;
        }





        .caption {
            text-align: center;
            margin-top: 20px;
        }
    </style>
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
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Rating</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($response as $responses)
                                            <tr>
                                                <td>{{ $responses->checklistItem->inspectionChecklist->name ?? '' }}</td>
                                                <td>{{ $responses->checklistItem->description ?? '' }}</td>
                                                <td>
                                                    @if ($responses->rating === 'red')
                                                        <span class="badge badge-danger">Red</span>
                                                    @elseif ($responses->rating === 'yellow')
                                                        <span class="badge badge-warning">Yellow</span>
                                                    @elseif ($responses->rating === 'green')
                                                        <span class="badge badge-success">Green</span>
                                                    @endif
                                                </td>
                                                <td>{{ $responses->remarks }}</td>
                                            </tr>
                                        @endforeach

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
        </section>
    </div>
@endsection
