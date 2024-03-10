<div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->

    <div class="alert alert-success"> {{ session('message') }} </div>
    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <p>
            The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh
        </p>

    </div>
    <h2>Permissions</h2>

    <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create a new permission</a>

    @foreach ($permissions as $permission)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $permission->name }}</h5>
            <p class="card-text">{{ $permission->description }}</p>
            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    @endforeach

</div>
