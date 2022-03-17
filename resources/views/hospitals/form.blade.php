@if($action == 'create')
    <form class="card card-md" action="{{ route('hospitals.store') }}" method="POST" autocomplete="off">
@elseif($action == 'edit')
    <form class="card card-md" action="{{ route('hospitals.update',$hospital->id) }}" method="POST">
        @method('PUT')
@else
    <form class="card card-md">
@endif

    @csrf
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" value="{{ $hospital->name ?? "" }}" class="form-control @error('name') is-invalid @enderror"
                placeholder="{{ __('Name') }}" @if($action=='view') readonly @endif>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Address') }}</label>
            <textarea type="text" name="address" value="{{ $hospital->address ?? "" }}" class="form-control @error('address') is-invalid @enderror"
                placeholder="{{ __('Address') }}" @if($action=='view') readonly @endif>{{ $hospital->address ?? "" }}</textarea>
            @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" value="{{ $hospital->email ?? "" }}" class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ __('Email') }}" @if($action=='view') readonly @endif>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Phone') }}</label>
            <input type="text" name="phone" value="{{ $hospital->phone ?? "" }}" class="form-control @error('phone') is-invalid @enderror"
                placeholder="{{ __('Phone') }}" @if($action=='view') readonly @endif>
            @error('phone')
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
