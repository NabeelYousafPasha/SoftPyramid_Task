<div class="form-group @error('name') 'has-error' @enderror">
    <label class="control-label">First Name *</label>
    <input
        class="form-control"
        name="name"
        placeholder="Enter First Name"
        type="text"
        value="{!! isset($user->name) ? $user->name : old('name') !!}"
        required
    >

    @error('')
    <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<div class="form-group @error('name') 'has-error' @enderror">
    <label class="control-label">Address *</label>
    <textarea
        class="form-control"
        name="address"
        placeholder="Enter Address"
        type="text"
        required
    >{!! isset($user->address) ? $user->address : old('address') !!}</textarea>

    @error('')
    <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
