@include('commons.media')

@if ($errors->has('content'))
    <span class="help-block">
        <small class="text-danger">{{ $errors->first('content') }}</small>
    </span>
@endif

<div class="{{ (isset($editor_hidden) && $editor_hidden) ? 'hidden' : ''}}">
    <textarea name="content" class="form-control" id="content" rows="5">{{ $editor_value }}</textarea>
</div>

<script src="{{ asset('plugin/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('plugin/tinymce/content-editor.js') }}"></script>
