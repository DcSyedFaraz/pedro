@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : 'manager.layouts.app')
@section('content')
<style>
    th {
    width: 15px;
}
</style>
    <div class="content-wrapper">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-primary">Check-In/Check-Out</h2>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Status</th>
                                <th scope="col">WorkOrder ID</th>
                                <th scope="col">Time</th>
                                <th scope="col">Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $key => $attendances)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $attendances->user->name }}</td>
                                    <td>{{ $attendances->address }}</td>
                                    <td>
                                        @switch($attendances->attendance)
                                            @case('checkIn')
                                                <span class="badge badge-success">Check In</span>
                                            @break

                                            @case('checkOut')
                                                <span class="badge badge-danger">Check Out</span>
                                            @break

                                            @default
                                                <span class="badge badge-secondary">Unknown</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('work_orders.show', $attendances->work_orders_id) }}"
                                            class="text-primary">{{ $attendances->work_orders_id }}</a>

                                    </td>
                                    <td>
                                        {{ $attendances->created_at->format('d-m-Y h:i:s A') }}
                                    </td>
                                    <td>

                                        {{ $attendances->duration }}

                                    </td>
                                </tr>
                            @endforeach

                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
