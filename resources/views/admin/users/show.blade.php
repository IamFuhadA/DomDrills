<x-layouts.admin>
    <x-slot name="title">User Details — {{ $user->name }}</x-slot>
    <x-slot name="pageTitle">User Details</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to Users List
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        {{-- Profile card --}}
        <div class="card lg:col-span-2">
            <div class="card-body">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-brand/10 flex items-center justify-center">
                        <span class="font-heading font-bold text-brand text-xl">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h2 class="font-heading font-bold text-xl text-charcoal">{{ $user->name }}</h2>
                        <p class="text-charcoal-muted text-sm">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="border-t border-border pt-5 space-y-4">
                    <h3 class="font-heading font-semibold text-charcoal text-base">Account Security & Actions</h3>
                    
                    <div class="flex flex-wrap gap-3">
                        @if($user->isSuspended())
                            <form method="POST" action="{{ route('admin.users.activate', $user) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-primary bg-state-success hover:bg-state-success/90 border-state-success text-white btn-sm">
                                    Re-Activate Account
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.users.suspend', $user) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-primary bg-state-warning hover:bg-state-warning/90 border-state-warning text-white btn-sm">
                                    Suspend Account
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to permanently delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-primary bg-state-error hover:bg-state-error/90 border-state-error text-white btn-sm">
                                Delete Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Meta stats --}}
        <div class="card lg:col-span-1">
            <div class="card-body">
                <h3 class="font-heading font-semibold text-charcoal text-base mb-4 font-heading">Meta Information</h3>
                <div class="text-xs text-charcoal-muted space-y-2.5">
                    <p><strong>System Role:</strong> <span class="capitalize text-charcoal">{{ $user->role }}</span></p>
                    <p><strong>Registered On:</strong> <span class="text-charcoal">{{ $user->created_at->format('d M Y, h:i A') }}</span></p>
                    <p><strong>Status:</strong> 
                        @if($user->isSuspended())
                            <span class="badge-error text-state-error font-semibold">Suspended</span>
                        @else
                            <span class="badge-success text-state-success font-semibold">Active</span>
                        @endif
                    </p>
                    <p><strong>Email Verified:</strong> 
                        @if($user->email_verified_at)
                            <span class="badge-success text-state-success font-semibold">Verified</span>
                        @else
                            <span class="badge-warning text-state-warning font-semibold">Unverified</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

    </div>
</x-layouts.admin>
