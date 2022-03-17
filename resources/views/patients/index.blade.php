@extends('layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    {{ __('Patients') }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('patients.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add New Patient
                    </a>
                    <a href="{{ route('patients.create') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <div class="mb-3 input-icon">
                            <form>
                                <input type="text" name="q" value="{{ $q }}" class="form-control"
                                    placeholder="Filter Data">
                            </form>
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="10" cy="10" r="7"></circle>
                                    <line x1="21" y1="21" x2="15" y2="15"></line>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Hospitals') }}</th>
                                <th>{{ __('Updated in') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                            <tr>
                                <td>{{ $patient->id }}</td>
                                <td>
                                    <div class="d-inline-block text-truncate" style="max-width: 150px;">{{
                                        $patient->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-inline-block text-truncate" style="max-width: 150px;">{{
                                        $patient->address
                                        }}</div>
                                </td>
                                <td>{{ $patient->phone }}</td>
                                <td>
                                    <div class="d-inline-block text-truncate" style="max-width: 150px;">{{
                                        $patient->Hospital->name }}</div>
                                </td>
                                <td>{{ $patient->updated_at->diffForhumans() }}</td>
                                <td>
                                    <a href="{{ route('patients.show',$patient->id) }}" class="w-30 btn btn-info btn-sm btn-pill">View</a>
                                    <a href="{{ route('patients.edit',$patient->id) }}"class="w-30 btn btn-warning btn-sm btn-pill">Edit</a>
                                    <button data-id="{{ $patient->id }}" data-token="{{ csrf_token() }}" class="w-30 btn btn-danger btn-sm btn-pill delete">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if( $patients->hasPages() )
                <div class="pb-0 card-footer">
                    {{ $patients->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script type="text/javascript">
    $(".delete").click(function(){
        var id = $(this).data("id");
        var token = $(this).data("token");
        $.ajax(
        {
            url: "patients/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_token": token,
            },
            success: function ()
            {
                console.log("it Work");
            }
        });
        $(this).closest("tr").remove();
    });
</script>
@endsection
