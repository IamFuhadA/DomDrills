<x-layouts.admin>
    <x-slot name="title">Platform Settings</x-slot>
    <x-slot name="pageTitle">Settings</x-slot>

    <div class="mb-6">
        <h1 class="font-heading font-bold text-2xl text-charcoal">Global Settings</h1>
        <p class="text-charcoal-muted text-xs">Configure site preferences, anti-piracy policies and bilingual support hooks.</p>
    </div>

    <div class="card max-w-2xl">
        <div class="card-body">
            <h2 class="font-heading font-semibold text-charcoal text-base mb-5">Configuration Panel</h2>
            <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">
                @csrf

                <div class="form-group">
                    <label for="site_title" class="form-label">Default Platform Name</label>
                    <input id="site_title" name="site_title" type="text" class="form-input" value="DomDrills">
                </div>

                <div class="form-group">
                    <label for="support_email" class="form-label">Support Notification Email Address</label>
                    <input id="support_email" name="support_email" type="email" class="form-input" value="support@domdrills.com">
                </div>

                <div class="border-t border-border pt-5 space-y-4">
                    <h3 class="font-heading font-semibold text-charcoal text-sm">Security & Piracy Controls</h3>
                    
                    <div class="flex items-center gap-3">
                        <input id="watermark" name="watermark" type="checkbox" value="1" class="w-4 h-4 rounded border-border text-brand focus:ring-brand/30 cursor-pointer" checked>
                        <label for="watermark" class="text-xs font-semibold text-charcoal cursor-pointer">Inject Identity Watermark on video stream player</label>
                    </div>

                    <div class="flex items-center gap-3">
                        <input id="block_pip" name="block_pip" type="checkbox" value="1" class="w-4 h-4 rounded border-border text-brand focus:ring-brand/30 cursor-pointer" checked>
                        <label for="block_pip" class="text-xs font-semibold text-charcoal cursor-pointer">Block native browser Picture-in-Picture mode</label>
                    </div>

                    <div class="flex items-center gap-3">
                        <input id="block_rc" name="block_rc" type="checkbox" value="1" class="w-4 h-4 rounded border-border text-brand focus:ring-brand/30 cursor-pointer" checked>
                        <label for="block_rc" class="text-xs font-semibold text-charcoal cursor-pointer">Disable right-clicks on video frames</label>
                    </div>
                </div>

                <div class="border-t border-border pt-5 space-y-4">
                    <h3 class="font-heading font-semibold text-charcoal text-sm">Bilingual Options</h3>
                    <div class="flex items-center gap-3">
                        <input id="lang_ml" name="lang_ml" type="checkbox" value="1" class="w-4 h-4 rounded border-border text-brand focus:ring-brand/30 cursor-pointer" checked>
                        <label for="lang_ml" class="text-xs font-semibold text-charcoal cursor-pointer">Enable Malayalam language switcher button</label>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Save Platform Settings</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
