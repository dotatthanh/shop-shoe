<div class="form-group">
    <label for="title">
        {{ isset($title_name) ? $title_name : __('Title') }}
        <small>({{ __('Total number of characters') }}: <span class="count_total"></span>)</small>
        <span class="required">*</span>
    </label>
    <input 
        type="text" 
        name="title" 
        class="form-control form-control-custom count_char" 
        value="{{ old('title', $dataEdit->title ?? '') }}"
        required
    >
    {!! $errors->first('title', '<span class="help-block error">:message</span>') !!}
</div>

<div class="form-group">
    <label for="slug">
        {{ __('Slug') }}
        <small>({{ __('Total number of characters') }} : <span class="count_total"></span>)</small>
        <span class="required">*</span>
    </label>
    <input 
        type="text" 
        name="slug" 
        class="form-control form-control-custom count_char" 
        value="{{ old('slug', $dataEdit->slug ?? '') }}"
        required
        readonly
    >
    {!! $errors->first('slug', '<span class="help-block error">:message</span>') !!}
</div>

<script>
    $('input[name=title]').keyup(function() {
        $('input[name=slug]').val(stringToSlug(this.value));
        $('input[name=slug]').trigger('keyup');
    });
</script>