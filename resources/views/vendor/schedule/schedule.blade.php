@extends('vendor.layouts.app')

@section('content')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar/main.css') }}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Calendar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Calendar</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="calendar"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('scripts')
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/fullcalendar/main.js') }}"></script>
    <!-- CDN -->
    <!-- CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script>
        // function getRandomColor() {
        //     var letters = '0123456789ABCDEF';
        //     var color = '#';
        //     for (var i = 0; i < 6; i++) {
        //         color += letters[Math.floor(Math.random() * 16)];
        //     }
        //     return color;
        // }

        $(function() {


            /* initialize the external events
             -----------------------------------------------------------------*/

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: [
                    @foreach ($jobs as $job)
                        {
                            id: '{{ $job->id }}',
                            title: '{{ $job->location_name }}',
                            start: '{{ $job->start_date }}',
                            end: '{{ $job->end_date }}',
                            url: '{{ route('manage_work_orders.show', $job->id) }}'
                        },
                    @endforeach

                ],
                // eventRender: function(info) {
                //     // Add logic here to set a unique color for each job
                //     info.el.style.backgroundColor = getRandomColor();
                // },

                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
                eventDrop: function(info) {
                    var jobId = info.event.id;
                    // alert(jobId);
                    var newStartDate = info.event.startStr;
                    var newEndDate = info.event.endStr;

                    var formattedStartDate = moment(newStartDate).format('YYYY-MM-DD HH:mm:ss');

                    // Convert end date to a string without timezone information
                    var formattedEndDate = moment(newEndDate).format('YYYY-MM-DD HH:mm:ss');

                    console.log(formattedStartDate,formattedEndDate);

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('schedule.update', ':id') }}'.replace(':id', jobId),
                        method: 'POST',
                        data: {
                            start_date: formattedStartDate,
                            end_date: formattedEndDate
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log('done');
                            if (response.error) {

                                toastr.error(response.error, 'Error', {
                                    closeButton: false
                                });
                            } else {
                                toastr.success(response.message, 'Success', {
                                    closeButton: true
                                });

                            }
                        },
                        error: function(error) {
                            console.error('Error updating job schedule:', error);
                        }
                    });
                },

            });

            calendar.render();
            // $('#calendar').fullCalendar()



        })
    </script>
@endsection
