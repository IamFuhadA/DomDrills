<x-layouts.admin>
    <x-slot name="title">Memberships Management</x-slot>
    <x-slot name="pageTitle">Memberships</x-slot>

    <div class="mb-6">
        <h1 class="font-heading font-bold text-2xl text-charcoal">Memberships</h1>
        <p class="text-charcoal-muted text-xs">Manage active and inactive subscriptions across plans.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @foreach([
            ['name' => 'Monthly Tier', 'count' => '0 active', 'price' => '₹1,999/mo'],
            ['name' => 'Quarterly Tier', 'count' => '1 active', 'price' => '₹4,999/quarter'],
            ['name' => 'Yearly Tier', 'count' => '0 active', 'price' => '₹14,999/yr'],
        ] as $plan)
        <div class="card p-5">
            <span class="text-xs text-charcoal-muted uppercase font-bold tracking-widest block mb-2">{{ $plan['name'] }}</span>
            <span class="font-heading font-bold text-xl text-charcoal block mb-1">{{ $plan['price'] }}</span>
            <span class="text-xs text-state-success font-semibold">{{ $plan['count'] }}</span>
        </div>
        @endforeach
    </div>

    <div class="card overflow-hidden">
        <div class="px-6 py-4.5 border-b border-border">
            <h2 class="font-heading font-semibold text-charcoal text-base">Active Memberships List</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Plan</th>
                        <th>Status</th>
                        <th>Renews/Expires</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-semibold text-charcoal text-sm">John Doe (student@domdrills.com)</td>
                        <td>Quarterly Tier</td>
                        <td><span class="badge-success">Active</span></td>
                        <td class="text-xs text-charcoal-muted">In 3 months</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
