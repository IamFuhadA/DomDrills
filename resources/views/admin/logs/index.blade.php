<x-layouts.admin>
    <x-slot name="title">Activity Audit Logs</x-slot>
    <x-slot name="pageTitle">Activity Logs</x-slot>

    <div class="mb-6">
        <h1 class="font-heading font-bold text-2xl text-charcoal">Activity Audit Logs</h1>
        <p class="text-charcoal-muted text-xs">Security logs tracking logins, subscription purchases, and content updates.</p>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>User</th>
                        <th>Activity Action</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                        ['time' => 'Just Now', 'user' => 'John Doe (Student)', 'act' => 'Watched Lesson: Market Orders vs Limit Orders', 'ip' => '127.0.0.1', 'ua' => 'Chrome / Windows'],
                        ['time' => '10 mins ago', 'user' => 'DomDrills Admin (Staff)', 'act' => 'Published Course: Footprint & Volume Profile', 'ip' => '127.0.0.1', 'ua' => 'Firefox / Windows'],
                        ['time' => '1 hour ago', 'user' => 'John Doe (Student)', 'act' => 'Logged Session Trade NIFTY +₹2,500.00', 'ip' => '127.0.0.1', 'ua' => 'Safari / Mac'],
                    ] as $log)
                    <tr>
                        <td class="text-xs text-brand font-semibold">{{ $log['time'] }}</td>
                        <td class="font-medium text-charcoal text-xs">{{ $log['user'] }}</td>
                        <td class="text-xs text-charcoal">{{ $log['act'] }}</td>
                        <td class="text-2xs font-mono text-charcoal-muted">{{ $log['ip'] }}</td>
                        <td class="text-2xs text-charcoal-muted max-w-[150px] truncate">{{ $log['ua'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
