<x-layouts.student>
    <x-slot name="title">My Profile</x-slot>
    <x-slot name="pageTitle">Profile</x-slot>

    <div class="max-w-2xl space-y-6">

        {{-- Profile Info --}}
        <div class="card">
            <div class="card-body">
                <h2 class="font-heading font-semibold text-charcoal text-lg mb-5">Profile Information</h2>

                @if(session('success'))
                    <div class="alert-success mb-4" role="alert">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('student.profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input id="name" name="name" type="text" class="form-input @error('name') border-state-error @enderror" value="{{ old('name', auth()->user()->name) }}" required autocomplete="name">
                        @error('name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" name="email" type="email" class="form-input @error('email') border-state-error @enderror" value="{{ old('email', auth()->user()->email) }}" required autocomplete="username">
                        @error('email')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="btn-primary">Save Changes</button>
                </form>
            </div>
        </div>

        {{-- Change Password --}}
        <div class="card">
            <div class="card-body">
                <h2 class="font-heading font-semibold text-charcoal text-lg mb-5">Change Password</h2>
                <form method="POST" action="{{ route('student.profile.password') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input id="current_password" name="current_password" type="password" class="form-input @error('current_password') border-state-error @enderror" autocomplete="current-password">
                        @error('current_password')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password" class="form-label">New Password</label>
                        <input id="new_password" name="password" type="password" class="form-input @error('password') border-state-error @enderror" autocomplete="new-password">
                        @error('password')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn-secondary">Update Password</button>
                </form>
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="card border-state-error/20 bg-state-error/3">
            <div class="card-body">
                <h2 class="font-heading font-semibold text-state-error text-lg mb-2">Delete Account</h2>
                <p class="text-charcoal-muted text-xs mb-5">Once your account is deleted, all of your progress, logs and active memberships will be permanently deleted.</p>
                
                <form method="POST" action="{{ route('student.profile.destroy') }}" class="space-y-4" onsubmit="return confirm('Are you sure you want to permanently delete your account? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')

                    <div class="form-group max-w-md">
                        <label for="delete_password" class="form-label text-state-error">Confirm Password to Delete</label>
                        <input id="delete_password" name="password" type="password" class="form-input border-state-error/30 focus:ring-state-error/20" placeholder="Enter your password" required>
                        @error('password', 'userDeletion')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="btn-primary bg-state-error hover:bg-state-error/90 border-state-error text-white">Delete Account</button>
                </form>
            </div>
        </div>

    </div>
</x-layouts.student>
