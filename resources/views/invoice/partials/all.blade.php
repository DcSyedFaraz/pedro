<div class="row">
    <div class="col-12">

        <div class="card">

            {{-- <!-- /.card-header -->
            <div class="card-header">
                <a class="btn btn-success" href="{{ route('invoice.create') }}"
                    class="btn btn-primary">Create New Invoice</a>
            </div> --}}
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped table-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th> {{ __('vendor/invoice/index.date') }}</th>
                            <th> {{ __('vendor/invoice/index.customer_name') }}</th>
                            <th> {{ __('vendor/invoice/index.invoice') }}</th>
                            <th> {{ __('vendor/invoice/index.po') }}</th>
                            <th> {{ __('vendor/invoice/index.status') }}</th>
                            <th> {{ __('vendor/invoice/index.total') }}</th>
                            <th> {{ __('vendor/invoice/index.total_due') }}</th>
                            <th> {{ __('vendor/invoice/index.actions') }}</th>
                            <th></th>


                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($recur) --}}
                        @if ($all->isEmpty())

                            <tr>
                                <td class="text-center" colspan="9">
                                    No Records Availabe

                                </td>
                            </tr>
                        @else
                            @foreach ($all as $inv)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($inv->updated_at)->format('l, F j, Y h:i A') }}</td>
                                    <td>{{ isset($inv->users->name) ? $inv->users->name : 'N/A' }}</td>
                                    <td>{{ isset($inv->job->customer->name) ? $inv->job->customer->name : 'N/A' }}</td>
                                    <td>{{ $inv->id }}</td>
                                    <td>{{ isset($inv->job) ? $inv->job->po_no : 'N/A' }}</td>
                                    <td class="">
                                        @if ($inv->status === 'unpaid')
                                            <label class="badge badge-danger">{{ Str::ucfirst($inv->status) }}</label>
                                        @elseif ($inv->status === 'paid')
                                            <label class="badge badge-success">{{ Str::ucfirst($inv->status) }}</label>
                                        @elseif ($inv->status === 'recurring')
                                            <label class="badge badge-warning">{{ Str::ucfirst($inv->status) }}</label>
                                        @endif
                                    </td>

                                    <td>{{ isset($inv->unpaid) ? $inv->unpaid->total : 'N/A' }}
                                    </td>



                                    <td class="btn-group">
                                        <a href="{{ route('invoice.show', $inv->id) }}" class="btn btn-info btn-sm "><i
                                                class="fa fa-eye"></i></a>
                                        &nbsp;
                                        <a href="{{ route('invoice.edit', $inv->id) }}" class="btn btn-primary btn-sm"><i
                                                class="fa fa-edit"></i></a>&nbsp;
                                        <form action="{{ route('invoice.destroy', $inv->id) }}" method="POST"
                                            class="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm dltBtn" data-id="{{$inv->id}}"
                                                ><i
                                                class="fas fa-trash"></i></a></button>
                                        </form>
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
@section('scripts')
<script>
    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $('.dltBtn').click(function(e){
          var form=$(this).closest('form');
            var dataID=$(this).data('id');
            // alert(dataID);
            e.preventDefault();
            swal({
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover this data!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                     form.submit();
                  } else {
                      swal("Your data is safe!");
                  }
              });
        })
    })
</script>
@endsection
