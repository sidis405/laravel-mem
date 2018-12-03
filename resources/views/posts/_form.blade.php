<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="title">Article Title</label>
            <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', $post->title) }}">
            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="category_id">Pick a category</label>
            <select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}">
                <option></option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(old('category_id', $post->category_id) == $category->id) selected="" @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('category_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <label for="cover">Choose a cover</label>
    <input type="file" name="cover" class="form-control{{ $errors->has('cover') ? ' is-invalid' : '' }}">
    @if ($errors->has('cover'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('cover') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="preview">Preview</label>
    <textarea class="form-control{{ $errors->has('preview') ? ' is-invalid' : '' }}" name="preview" placeholder="Say a few words..">{{ old('preview', $post->preview) }}</textarea>
    @if ($errors->has('preview'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('preview') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="preview">Article body</label>
    <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" name="body" rows="7">{{ old('body', $post->body) }}</textarea>
    @if ($errors->has('body'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="tags[]">Select tags</label>
    <select name="tags[]" class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}" multiple="">
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}"
                @if(collect(old('tags',  $post->tags->pluck('id')))->contains($tag->id)) selected="" @endif>{{ $tag->name }}</option>
        @endforeach
    </select>
    @if ($errors->has('tags'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
    @endif
</div>
