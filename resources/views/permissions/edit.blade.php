<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->

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
            I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger
        </p>

    </div>
    <h2>Edit Permission</h2>
    <a href="{{ route('permissions.index') }}" class="btn btn-primary">Back</a>

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
    
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" wire:model="description">
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" wire:model="slug">
            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



</div>
