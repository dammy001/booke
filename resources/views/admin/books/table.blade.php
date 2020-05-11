<div class="table-responsive-sm">
    <table class="table table-striped" id="books-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Author</th>
        <th>Type</th>
        <th>Pages</th>
        <th>Category</th>
        <th>Description</th>
        <th>Released</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->type }}</td>
            <td>{{ $book->pages }}</td>
            <td>{{ $book->category->name }}</td>
            <td>{{ $book->description }}</td>
            <td>{{ $book->released }}</td>
                <td>
                    {!! Form::open(['route' => ['admin.books.destroy', $book->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admin.books.show', [$book->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.books.edit', [$book->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
