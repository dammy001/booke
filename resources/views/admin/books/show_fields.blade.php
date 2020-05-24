<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p><img src="{{ $book->image }}" width="200" height="200"></p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $book->title }}</p>
</div>

<!-- Author Field -->
<div class="form-group">
    {!! Form::label('author', 'Author:') !!}
    <p>{{ $book->author }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $book->type }}</p>
</div>

<!-- Pages Field -->
<div class="form-group">
    {!! Form::label('pages', 'Pages:') !!}
    <p>{{ $book->pages }}</p>
</div>

<div class="form-group">
    {!! Form::label('category', 'Category:') !!}
    <p>{{ $book->category->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $book->description }}</p>
</div>

<!-- Released Field -->
<div class="form-group">
    {!! Form::label('released', 'Released:') !!}
    <p>{{ $book->released }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $book->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $book->updated_at }}</p>
</div>

