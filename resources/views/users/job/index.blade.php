@extends('users.layouts.app')

@section('content')

    <style>
        .rating {
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
        }

        .rating label:hover,
        .rating input:checked~label {
            color: #d37312;
        }

        .rating input:checked+label {
            color: #d37312;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }


        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .rating {
            font-size: 24px;
            cursor: pointer;
        }

        .star {
            color: #ccc;
            margin: 0 5px;
        }

        .star.active {
            color: #ffcc00;
        }

        textarea {
            width: 100%;
            height: 100px;
            margin-top: 10px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        #submitBtn {
            margin-top: 10px;
        }

        #selectedRating {
            font-weight: bold;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Job List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Job List</li>
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
                                            <th>S.N</th>
                                            <th>Job#</th>
                                            <th>Customer Name</th>
                                            <th>Jobs</th>
                                            <th>Assigned Manager</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($job)
                                            @foreach ($job as $key=> $jobs)
                                                @php
                                                    $phones = isset($jobs->phone) ? $jobs->phone : [];
                                                    $ext_ids = isset($jobs->ext_id) ? $jobs->ext_id : [];
                                                    $exts = isset($jobs->ext) ? $jobs->ext : [];
                                                    $emailAddresses = isset($jobs->email) ? $jobs->email : [];
                                                    $phone = implode(',', $phones);
                                                    $ext_id = implode(',', $ext_ids);
                                                    $ext = implode(',', $exts);
                                                    $emailList = implode(',', $emailAddresses);
                                                @endphp
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ isset($jobs->id) ? $jobs->id : '' }}</td>
                                                    <td>{{ isset($jobs->customer->name) ? $jobs->customer->name : '' }}</td>
                                                    <td>{{ isset($jobs->job_category->name) ? $jobs->job_category->name : '' }}
                                                    </td>
                                                    <td>
                                                        {{ isset($jobs->account_manager_id) ? $jobs->manager->name : 'null' }}
                                                    </td>
                                                    @if ($jobs->current_status == 1)
                                                        <td class="text-primary">
                                                            <strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong>
                                                        </td>
                                                    @elseif($jobs->current_status == 2)
                                                        <td class="text-secondary">
                                                            <strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong>
                                                        </td>
                                                    @elseif($jobs->current_status == 3)
                                                        <td class="text-warning">
                                                            <strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong>
                                                        </td>
                                                    @elseif($jobs->current_status == 4)
                                                        <td class="text-info">
                                                            <strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong>
                                                        </td>
                                                    @elseif($jobs->current_status == 5)
                                                        <td class="text-light bg-dark">
                                                            <strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong>
                                                        </td>
                                                    @elseif($jobs->current_status == 6)
                                                        <td class="text-dark">
                                                            <strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong>
                                                        </td>
                                                    @elseif($jobs->current_status == 7)
                                                        <td class="text-danger">
                                                            <strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong>
                                                        </td>
                                                    @elseif($jobs->current_status == 8)
                                                        <td class="text-muted">
                                                            <strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong>
                                                        </td>
                                                    @elseif($jobs->current_status == 9)
                                                        <td class="text-success">
                                                            <strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong>
                                                        </td>
                                                    @else
                                                        <td class="text-success"><strong>---</strong></td>
                                                    @endif
                                                    <td>
                                                        @if ($jobs->current_status == 9)
                                                            @if (optional($jobs->feedback)->count() > 0)
                                                                <span class="badge badge-btn badge-success">Feedback Submitted
                                                                </span>
                                                            @else
                                                                <button type="button" class="btn btn-success"
                                                                    data-toggle="modal"
                                                                    data-target="#exampleModal{{ $jobs->id }}">
                                                                    Feedback
                                                                </button>
                                                            @endif
                                                        @endif

                                                        <a class="btn btn-primary"
                                                            href="{{ route('joblist.show', $jobs->id) }}">show</a>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="exampleModal{{ $jobs->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Feedback
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('joblist.update', $jobs->id) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <h2>Rate the Work</h2>
                                                                    <div class="rating">
                                                                        <input class="star" data-rating="5" type="radio"
                                                                            id="star5" name="rating" value="5">
                                                                        <label for="star5">&#9733;</label>

                                                                        <input class="star" data-rating="4" type="radio"
                                                                            id="star4" name="rating" value="4">
                                                                        <label for="star4">&#9733;</label>

                                                                        <input class="star" data-rating="3" type="radio"
                                                                            id="star3" name="rating" value="3">
                                                                        <label for="star3">&#9733;</label>

                                                                        <input class="star" data-rating="2" type="radio"
                                                                            id="star2" name="rating" value="2">
                                                                        <label for="star2">&#9733;</label>

                                                                        <input class="star" data-rating="1" type="radio"
                                                                            id="star1" name="rating" value="1">
                                                                        <label for="star1">&#9733;</label>

                                                                    </div>
                                                                    <p>Your Rating: <span id="selectedRating">0</span>/5</p>
                                                                    <textarea id="comments" placeholder="Add Comments" name="comment"></textarea>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputFile">File </label>
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                    class="custom-file-input"
                                                                                    id="exampleInputFile" name="file">
                                                                                <p class="custom-file-label"
                                                                                    id="selectedFileName"
                                                                                    for="exampleInputFile">Choose
                                                                                    file</p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
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
                                                </div>
                            </div>
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
        const stars = document.querySelectorAll(".star");
        const selectedRating = document.getElementById("selectedRating");
        stars.forEach((star) => {
            star.addEventListener("click", () => {
                stars.forEach((s) => s.classList.remove("active"));
                star.classList.add("active");
                selectedRating.textContent = star.getAttribute("data-rating");
            });
        });

        const fileInput = document.getElementById('exampleInputFile');

        const selectedFileName = document.getElementById('selectedFileName');

        fileInput.addEventListener('change', function() {
            if (fileInput.files && fileInput.files[0]) {
                selectedFileName.textContent = fileInput.files[0].name;
            } else {
                selectedFileName.textContent = 'No file selected';
            }
        });
    </script>

    {{-- <script src="{{ asset('js/style.js') }}"></script> --}}
@endsection
