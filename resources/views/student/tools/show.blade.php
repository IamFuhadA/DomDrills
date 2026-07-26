<x-layouts.student>
    <x-slot name="title">
        @if($slug === 'risk-calculator') Risk Calculator
        @elseif($slug === 'position-size') Position Size Calculator
        @elseif($slug === 'daily-levels') Daily Levels
        @elseif($slug === 'market-bias') Market Bias Evaluator
        @elseif($slug === 'trading-journal') Trading Journal
        @elseif($slug === 'session-notes') Session Notes
        @else Trading Tool
        @endif
    </x-slot>
    <x-slot name="pageTitle">Trading Tool</x-slot>

    {{-- Back Link --}}
    <div class="mb-6">
        <a href="{{ route('student.tools.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to tools
        </a>
    </div>

    {{-- =========================================================================
         1. RISK CALCULATOR
         ========================================================================= --}}
    @if($slug === 'risk-calculator')
    <div class="card max-w-2xl" x-data="{
        balance: 100000,
        riskPercent: 1.0,
        stopLoss: 20.0,
        pointValue: 50,
        get maxRisk() { return (this.balance * (this.riskPercent / 100)).toFixed(2) },
        get positionSize() {
            if(this.stopLoss <= 0 || this.pointValue <= 0) return 0;
            return Math.floor(this.maxRisk / (this.stopLoss * this.pointValue));
        }
    }">
        <div class="card-body">
            <h2 class="font-heading font-bold text-xl text-charcoal mb-2">Institutional Risk Calculator</h2>
            <p class="text-charcoal-muted text-sm mb-6">Calculate optimal capital allocation and contract size relative to your risk tolerance parameters.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
                <div class="form-group">
                    <label class="form-label">Account Balance (₹)</label>
                    <input type="number" x-model.number="balance" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Risk Percentage (%)</label>
                    <input type="number" step="0.1" x-model.number="riskPercent" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Stop Loss (Points)</label>
                    <input type="number" step="0.5" x-model.number="stopLoss" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Point Value (₹ per Point)</label>
                    <select x-model.number="pointValue" class="form-input">
                        <option value="50">Nifty (Lot size 50)</option>
                        <option value="15">Bank Nifty (Lot size 15)</option>
                        <option value="1">Equities (1:1 Point Value)</option>
                        <option value="100">Custom (100)</option>
                    </select>
                </div>
            </div>

            <div class="bg-ivory-alt/50 border border-border rounded-xl p-5 grid grid-cols-2 gap-4">
                <div>
                    <span class="text-charcoal-muted text-xs block">Max Risk Allowed</span>
                    <span class="font-heading font-bold text-charcoal text-lg">₹<span x-text="maxRisk"></span></span>
                </div>
                <div>
                    <span class="text-charcoal-muted text-xs block">Optimal Position Size</span>
                    <span class="font-heading font-bold text-brand text-lg"><span x-text="positionSize"></span> Contracts/Qty</span>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================================================================
         2. POSITION SIZE CALCULATOR
         ========================================================================= --}}
    @elseif($slug === 'position-size')
    <div class="card max-w-2xl" x-data="{
        balance: 100000,
        riskAmount: 1000,
        entryPrice: 22000,
        stopPrice: 21900,
        get riskPerShare() { return Math.abs(this.entryPrice - this.stopPrice) },
        get shareQty() {
            if(this.riskPerShare <= 0) return 0;
            return Math.floor(this.riskAmount / this.riskPerShare);
        },
        get totalValue() { return (this.shareQty * this.entryPrice).toFixed(2) }
    }">
        <div class="card-body">
            <h2 class="font-heading font-bold text-xl text-charcoal mb-2">Position Size Calculator</h2>
            <p class="text-charcoal-muted text-sm mb-6">Calculate optimal share/contract quantity based on absolute entry and stop loss prices.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
                <div class="form-group">
                    <label class="form-label">Account Balance (₹)</label>
                    <input type="number" x-model.number="balance" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Max Risk Amount (₹)</label>
                    <input type="number" x-model.number="riskAmount" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Entry Price (₹)</label>
                    <input type="number" step="0.05" x-model.number="entryPrice" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Stop Loss Price (₹)</label>
                    <input type="number" step="0.05" x-model.number="stopPrice" class="form-input">
                </div>
            </div>

            <div class="bg-ivory-alt/50 border border-border rounded-xl p-5 grid grid-cols-2 gap-4">
                <div>
                    <span class="text-charcoal-muted text-xs block">Optimal Share Quantity</span>
                    <span class="font-heading font-bold text-brand text-lg"><span x-text="shareQty"></span> shares</span>
                </div>
                <div>
                    <span class="text-charcoal-muted text-xs block">Total Position Value</span>
                    <span class="font-heading font-bold text-charcoal text-lg">₹<span x-text="totalValue"></span></span>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================================================================
         3. DAILY LEVELS
         ========================================================================= --}}
    @elseif($slug === 'daily-levels')
    <div class="card max-w-2xl" x-data="{
        levels: JSON.parse(localStorage.getItem('domdrills_daily_levels')) || [
            { name: 'VWAP', price: '22,450.00' },
            { name: 'POC (Point of Control)', price: '22,420.00' },
            { name: 'VAH (Value Area High)', price: '22,480.00' },
            { name: 'VAL (Value Area Low)', price: '22,390.00' }
        ],
        newName: '',
        newPrice: '',
        addLevel() {
            if(this.newName && this.newPrice) {
                this.levels.push({ name: this.newName, price: this.newPrice });
                this.newName = '';
                this.newPrice = '';
                this.save();
            }
        },
        removeLevel(idx) {
            this.levels.splice(idx, 1);
            this.save();
        },
        save() {
            localStorage.setItem('domdrills_daily_levels', JSON.stringify(this.levels));
        }
    }">
        <div class="card-body">
            <h2 class="font-heading font-bold text-xl text-charcoal mb-2">Institutional Daily Levels</h2>
            <p class="text-charcoal-muted text-sm mb-6">Plan your session by recording high volume nodes, value area boundaries and volume-weighted indicators.</p>

            {{-- Custom level form --}}
            <form @submit.prevent="addLevel" class="flex flex-col sm:flex-row gap-3 mb-6">
                <input type="text" x-model="newName" placeholder="Level Name (e.g., Support 1)" class="form-input flex-1" required>
                <input type="text" x-model="newPrice" placeholder="Price (₹)" class="form-input w-full sm:w-40" required>
                <button type="submit" class="btn-primary flex-shrink-0 justify-center">Add Level</button>
            </form>

            {{-- Levels Table --}}
            <div class="overflow-x-auto">
                <table class="table-base">
                    <thead>
                        <tr>
                            <th>Level Reference</th>
                            <th>Value / Price Node</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(lvl, idx) in levels" :key="idx">
                            <tr>
                                <td class="font-semibold text-charcoal text-sm" x-text="lvl.name"></td>
                                <td class="text-brand font-medium text-sm" x-text="lvl.price"></td>
                                <td class="text-right">
                                    <button @click="removeLevel(idx)" class="text-state-error/70 hover:text-state-error text-xs font-semibold">Delete</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- =========================================================================
         4. MARKET BIAS
         ========================================================================= --}}
    @elseif($slug === 'market-bias')
    <div class="card max-w-2xl" x-data="{
        vwap: 'above',
        delta: 'up',
        range: 'breakout_up',
        volumeType: 'double',
        get biasScore() {
            let score = 0;
            if(this.vwap === 'above') score += 2; else score -= 2;
            if(this.delta === 'up') score += 2; else if(this.delta === 'down') score -= 2;
            if(this.range === 'breakout_up') score += 3; else if(this.range === 'breakout_down') score -= 3;
            if(this.volumeType === 'trend_up') score += 2; else if(this.volumeType === 'trend_down') score -= 2;
            return score;
        },
        get biasLabel() {
            let s = this.biasScore;
            if(s >= 5) return { label: 'Strong Bullish', color: 'text-state-success bg-state-success/10 border-state-success/20' };
            if(s >= 2) return { label: 'Bullish', color: 'text-state-success/80 bg-state-success/5 border-state-success/10' };
            if(s <= -5) return { label: 'Strong Bearish', color: 'text-state-error bg-state-error/10 border-state-error/20' };
            if(s <= -2) return { label: 'Bearish', color: 'text-state-error/80 bg-state-error/5 border-state-error/10' };
            return { label: 'Neutral / Rangebound', color: 'text-state-warning bg-state-warning/10 border-state-warning/20' };
        }
    }">
        <div class="card-body">
            <h2 class="font-heading font-bold text-xl text-charcoal mb-2">Market Bias Evaluator</h2>
            <p class="text-charcoal-muted text-sm mb-6">Score current market conditions based on order flow indicators, volume structures, and auction context.</p>

            <div class="space-y-4 mb-8">
                <div class="form-group">
                    <label class="form-label">Price Relative to VWAP</label>
                    <select x-model="vwap" class="form-input">
                        <option value="above">Trading Above VWAP (Bullish)</option>
                        <option value="below">Trading Below VWAP (Bearish)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Cumulative Delta Trend</label>
                    <select x-model="delta" class="form-input">
                        <option value="up">Positive Slope (Aggressive Buying)</option>
                        <option value="neutral">Flat (Balanced Auctions)</option>
                        <option value="down">Negative Slope (Aggressive Selling)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Opening Range Breakout</label>
                    <select x-model="range" class="form-input">
                        <option value="breakout_up">Aggressive Breakout Upward</option>
                        <option value="inside">Trading Inside Opening Range</option>
                        <option value="breakout_down">Aggressive Breakout Downward</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Volume Profile Structure</label>
                    <select x-model="volumeType" class="form-input">
                        <option value="trend_up">P-Shape (Short Covering/Buying Pressure)</option>
                        <option value="double">D-Shape (Balanced Value Areas)</option>
                        <option value="trend_down">b-Shape (Long Liquidation/Selling Pressure)</option>
                    </select>
                </div>
            </div>

            <div class="border rounded-xl p-5 flex items-center justify-between" :class="biasLabel.color">
                <div>
                    <span class="text-xs block opacity-70">Calculated Session Bias</span>
                    <span class="font-heading font-bold text-lg" x-text="biasLabel.label"></span>
                </div>
                <div class="text-xs opacity-85">
                    Score: <span x-text="biasScore"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================================================================
         5. TRADING JOURNAL
         ========================================================================= --}}
    @elseif($slug === 'trading-journal')
    <div class="space-y-6" x-data="{
        trades: JSON.parse(localStorage.getItem('domdrills_journal_trades')) || [],
        symbol: 'NIFTY',
        action: 'buy',
        entry: 22400,
        exit: 22450,
        qty: 50,
        notes: '',
        addTrade() {
            const pnl = (this.action === 'buy' ? (this.exit - this.entry) : (this.entry - this.exit)) * this.qty;
            const newTrade = {
                date: new Date().toLocaleDateString(),
                symbol: this.symbol,
                action: this.action.toUpperCase(),
                qty: this.qty,
                entry: this.entry,
                exit: this.exit,
                pnl: pnl
            };
            this.trades.push(newTrade);
            this.save();
            this.notes = '';
        },
        removeTrade(idx) {
            this.trades.splice(idx, 1);
            this.save();
        },
        save() {
            localStorage.setItem('domdrills_journal_trades', JSON.stringify(this.trades));
        },
        get totalPnL() {
            return this.trades.reduce((sum, t) => sum + t.pnl, 0);
        },
        get winRate() {
            if(this.trades.length === 0) return 0;
            const wins = this.trades.filter(t => t.pnl > 0).length;
            return Math.round((wins / this.trades.length) * 100);
        }
    }">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Log Form --}}
            <div class="card lg:col-span-1">
                <div class="card-body">
                    <h2 class="font-heading font-bold text-lg text-charcoal mb-4">Log Session Trade</h2>
                    <form @submit.prevent="addTrade" class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Symbol / Instrument</label>
                            <input type="text" x-model="symbol" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Action</label>
                            <select x-model="action" class="form-input">
                                <option value="buy">BUY (Long)</option>
                                <option value="sell">SELL (Short)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quantity</label>
                            <input type="number" x-model.number="qty" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Entry Price (₹)</label>
                            <input type="number" step="0.05" x-model.number="entry" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Exit Price (₹)</label>
                            <input type="number" step="0.05" x-model.number="exit" class="form-input" required>
                        </div>
                        <button type="submit" class="btn-primary w-full justify-center">Record Trade</button>
                    </form>
                </div>
            </div>

            {{-- Log Stats & Table --}}
            <div class="card lg:col-span-2 space-y-6 bg-transparent border-none shadow-none">
                
                {{-- Stats strip --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="stat-value text-2xl" :class="totalPnL >= 0 ? 'text-state-success' : 'text-state-error'">
                                    ₹<span x-text="totalPnL.toFixed(2)"></span>
                                </p>
                                <p class="stat-label text-xs">Total Realized P&L</p>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="stat-value text-2xl text-charcoal"><span x-text="winRate"></span>%</p>
                                <p class="stat-label text-xs">Win Rate (<span x-text="trades.length"></span> Trades)</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Table Card --}}
                <div class="card">
                    <div class="px-6 py-4.5 border-b border-border">
                        <h2 class="font-heading font-semibold text-charcoal text-base">Session Trades History</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table-base">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Symbol</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Entry</th>
                                    <th>Exit</th>
                                    <th>P&L</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(t, idx) in trades" :key="idx">
                                    <tr>
                                        <td x-text="t.date"></td>
                                        <td class="font-semibold text-charcoal" x-text="t.symbol"></td>
                                        <td x-text="t.action"></td>
                                        <td x-text="t.qty"></td>
                                        <td x-text="t.entry"></td>
                                        <td x-text="t.exit"></td>
                                        <td :class="t.pnl >= 0 ? 'text-state-success font-medium' : 'text-state-error font-medium'">
                                            ₹<span x-text="t.pnl.toFixed(2)"></span>
                                        </td>
                                        <td class="text-right">
                                            <button @click="removeTrade(idx)" class="text-state-error/70 hover:text-state-error text-xs font-semibold">Delete</button>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="trades.length === 0">
                                    <tr>
                                        <td colspan="8" class="text-center py-6 text-charcoal-muted text-sm">No trades logged in this session yet.</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================================================================
         6. SESSION NOTES
         ========================================================================= --}}
    @elseif($slug === 'session-notes')
    <div class="card max-w-2xl" x-data="{
        prepNotes: localStorage.getItem('domdrills_session_notes_prep') || '',
        reviewNotes: localStorage.getItem('domdrills_session_notes_review') || '',
        save() {
            localStorage.setItem('domdrills_session_notes_prep', this.prepNotes);
            localStorage.setItem('domdrills_session_notes_review', this.reviewNotes);
            alert('Session notes saved locally.');
        }
    }">
        <div class="card-body">
            <h2 class="font-heading font-bold text-xl text-charcoal mb-2">Session Notes Template</h2>
            <p class="text-charcoal-muted text-sm mb-6">Structured preparation worksheet for pre-market planning and post-market review.</p>

            <form @submit.prevent="save" class="space-y-6">
                <div class="form-group">
                    <label class="form-label font-bold">Pre-Market Prep & Levels Plan</label>
                    <p class="text-charcoal-muted text-2xs mb-2">Write down opening ranges, high volume node checks, news context, and your plan for the day.</p>
                    <textarea x-model="prepNotes" class="form-textarea" rows="6" placeholder="Example: Nifty opening above Friday's VAL. Expecting rejection at 22,480 Node. Plan is to look for absorption footprints at POC..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label font-bold">Post-Market Review & Lessons</label>
                    <p class="text-charcoal-muted text-2xs mb-2">Document what went right, what went wrong, and how you managed risk during the session.</p>
                    <textarea x-model="reviewNotes" class="form-textarea" rows="6" placeholder="Example: Followed execution rules. Took one stop loss. Did not overtrade. Learned that absorption can hold longer than anticipated..."></textarea>
                </div>

                <button type="submit" class="btn-primary w-full justify-center">Save Session Notes</button>
            </form>
        </div>
    </div>
    @endif
</x-layouts.student>
