@extends('manager.layouts.app')


@section('content')
<style>
    body {
      font-family: sans-serif;
    }



    .image {
      margin: 0 auto;
      width: 100%;
      max-width: 500px;
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
                  <div class="card-header">
                    <h3 class="card-title">Inspection Checklist for Shared Spaces</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    {{-- @foreach ($response->checklist as $checklist )
                    <h3>{{$checklist->description}}</h3>
                    @endforeach --}}
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
                            <td>{{$responses->checklistItem->inspectionChecklist->name}}</td>
                            <td>{{$responses->checklistItem->description}}</td>
                          <td>
                            @if ($responses->rating === 'red')
                            <span class="badge badge-danger">Red</span>
                        @elseif ($responses->rating === 'yellow')
                            <span class="badge badge-warning">Yellow</span>
                        @elseif ($responses->rating === 'green')
                            <span class="badge badge-success">Green</span>

                        @endif
                        </td>
                          <td>{{$responses->remarks}}</td>
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

</div>
@endsection
