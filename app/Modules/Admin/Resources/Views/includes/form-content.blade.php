<div class="form-group">
    <label for="content">{{ $contentTitle ?? __('Content') }}</label> <br>
    <button type="button" class="btn btn-light btn-add-images mb-1" onclick="initMediaEditor(contentEditor)">
        <i class="fa fa-music" aria-hidden="true"></i>
        {{ __('Media') }}
    </button>
    <textarea
        name="content"
        id="content"
        class="form-control form-control-custom"
        rows="20"
    >{{ old('content',  $dataEdit->content ?? null) }}
    </textarea>
    {!! $errors->first('content', '<span class="help-block error">:message</span>') !!}
</div>

<script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('plugins/tinymce/content-editor.js') }}"></script>
