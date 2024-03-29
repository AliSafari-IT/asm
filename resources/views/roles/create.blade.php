<div>
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
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
            Simplicity is the essence of happiness. - Cedric Bledsoe
        </p>

    </div>
    <h2>Create Role</h2>
    <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>

    <form wire:submit.prevent="store">
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
        <div class="form-group">
            <label for="permissions">Permissions</label>
            <select class="form-control" id="permissions" wire:model="permissions">
                <option value="">Select Permissions</option>
                @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
            @error('permissions') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</div>