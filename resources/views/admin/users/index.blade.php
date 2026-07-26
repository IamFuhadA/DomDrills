<x-layouts.admin>
    <x-slot name="title">Users</x-slot>
    <x-slot name="pageTitle">Users</x-slot>

    <div class="card overflow-hidden">
        <div class="px-6 py-4 border-b border-border flex items-center justify-between">
            <h2 class="font-heading font-semibold text-charcoal">All Users ({{ $users->total() }})</h2>
        </div>
        @if($users->isEmpty())
            <div class="p-12 text-center">
                <p class="text-charcoal-muted">No users registered yet.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="table-base">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined</th>
                            <th>Verified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="font-medium text-charcoal">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge-success">Verified</span>
                                @else
                                    <span class="badge-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.users.show', $user) }}" class="text-brand text-xs font-medium hover:text-brand-hover">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-border">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>
