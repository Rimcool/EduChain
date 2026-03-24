<div class="form-element-area">
    <div class="form-element-list">
        <h3>Add New University</h3>

        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form wire:submit.prevent="createUniversity">
            <div class="form-group">
                <label>University Name</label>
                <input type="text" wire:model="name" class="form-control" placeholder="e.g. Lahore Blockchain University">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" wire:model="email" class="form-control" placeholder="university@example.com">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Location</label>
                <input type="text" wire:model="location" class="form-control" placeholder="City, Country">
                @error('location') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-success">Add University</button>
        </form>
    </div>
</div>
