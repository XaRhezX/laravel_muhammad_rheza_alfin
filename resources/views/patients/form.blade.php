@if($action == 'create')
    <form class="card card-md" action="{{ route('patients.store') }}" method="POST" autocomplete="off">
@elseif($action == 'edit')
    <form class="card card-md" action="{{ route('patients.update',$patient->id) }}" method="POST">
        @method('PUT')
@else
    <form class="card card-md">
@endif

    @csrf
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" value="{{ $patient->name ?? "" }}" class="form-control @error('name') is-invalid @enderror"
                placeholder="{{ __('Name') }}" @if($action=='view') readonly @endif>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Address') }}</label>
            <textarea type="text" name="address" value="{{ $patient->address ?? "" }}" class="form-control @error('address') is-invalid @enderror"
                placeholder="{{ __('Address') }}" @if($action=='view') readonly @endif>{{ $patient->address ?? "" }}</textarea>
            @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Phone') }}</label>
            <input type="text" name="phone" value="{{ $patient->phone ?? "" }}" class="form-control @error('phone') is-invalid @enderror"
                placeholder="{{ __('Phone') }}" @if($action=='view') readonly @endif>
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Hospital') }}</label>
            <select name="hospital_id" type="text" class="form-control select2" id="hospital_id" @if($action=='view') disabled @endif>
                @if(!empty($patient->hospital_id))
                    <option value="{{$patient->hospital_id}}" selected>{{$patient->hospital->name}}</option>
                @endif
            </select>
            @error('hospital_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if($action!='view')
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">{{ __('Submit') }}</button>
            </div>
        @endif
    </div>
</form>



@section('scripts')
<script type="text/javascript">
    $('#hospital_id').select2({
            placeholder: 'Pick Hospitals',
            ajax: {
                url: '/ajax/hospitals',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
</script>
@endsection
