<x-layouts.admin>
    <x-slot name="title">Membership Plans Management</x-slot>
    <x-slot name="pageTitle">Membership Plans</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="font-heading font-bold text-2xl text-charcoal">Membership Tiers</h1>
            <p class="text-charcoal-muted text-xs">Create, edit and manage client subscription tiers, pricing and features lists.</p>
        </div>
        <a href="{{ route('admin.memberships.create') }}" class="btn-primary btn-sm flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Create Plan
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Plans Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @foreach($plans as $plan)
        <div class="card p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-charcoal-muted uppercase font-bold tracking-widest">{{ $plan->name }}</span>
                    <span class="badge-brand capitalize text-3xs">{{ $plan->billing_period }}</span>
                </div>
                <span class="font-heading font-bold text-2xl text-charcoal block mb-2">₹{{ number_format($plan->price) }}</span>
                <p class="text-charcoal-muted text-xs mb-4 leading-relaxed line-clamp-3">{{ $plan->description }}</p>
                
                @if(!empty($plan->features))
                    <ul class="space-y-2 mb-6">
                        @foreach($plan->features as $feature)
                        <li class="flex items-center gap-2 text-2xs text-charcoal-muted">
                            <svg class="w-3.5 h-3.5 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="border-t border-border pt-4 flex gap-3">
                <a href="{{ route('admin.memberships.edit', $plan->id) }}" class="btn-outline-brand btn-xs flex-1 justify-center text-center">Edit Plan</a>
                
                <form method="POST" action="{{ route('admin.memberships.destroy', $plan->id) }}" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this plan?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-primary bg-state-error/10 hover:bg-state-error/20 border-state-error/20 text-state-error btn-xs w-full justify-center">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</x-layouts.admin>
