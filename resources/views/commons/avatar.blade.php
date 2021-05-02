<div id="{{ $avatarKey }}"  class="media-avatar-preview">
    <input type="hidden" class="form-control input_value" name="{{ $avatarName ?? $avatarKey }}" value="{{ $avatarValue }}">

    <div class="text-center img-preview" onclick="initMediaAvatar('{{ $avatarKey }}')">
        @if ($avatarCheck)
            <img src="{{ $avatarValue }}" class="img-thumbnail">
        @endif
    </div>
    
    <div class="text-center {{ ($avatarCheck) ? 'hidden' : '' }} get-media">
        <a 
            class="{{ $chooseClass ?? null }}"
            href="javascript:void(0)"
            onclick="initMediaAvatar('{{ $avatarKey }}')"
        >{!! (isset($chooseText)) ? $chooseText : __('Chọn ảnh') !!}</a>
    </div>
    
    <div class="remove-avatar text-center m-t-12 {{ ($avatarCheck) ? '' : 'hidden' }}">
        <a
            class="{{ $removeClass ?? null }}"
            href="javascript:void(0)"
            onclick="removeAvatar('{{ $avatarKey }}')"
        > {!! (isset($removeText)) ? $removeText : __('Xóa ảnh') !!}</a>
    </div>
    
    @if ($errors->has($avatarKey))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first($avatarKey) }}</small>
        </span>
    @endif
</div>