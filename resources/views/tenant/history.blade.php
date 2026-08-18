<x-layouts.portal title="Payment History">
    <h1 class="font-serif text-4xl">Payment History</h1>
    <p class="mt-2 text-sm text-forest/70">Demo records for local review. Live verification comes in a later phase.</p>
    <div class="card mt-6 overflow-x-auto">
        <table class="w-full min-w-[28rem] text-left text-sm">
            <thead class="bg-cream/70">
                <tr>
                    <th class="p-4 font-semibold">Date</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold">Amount</th>
                    <th class="p-4 font-semibold">Receipt</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $row)
                    <tr class="border-t border-cream">
                        <td class="p-4">{{ $row['date'] }}</td>
                        <td class="p-4"><span class="status-pill bg-green-50 text-green-800">Paid</span></td>
                        <td class="p-4 font-semibold">${{ $row['amount'] }}</td>
                        <td class="p-4"><span class="inline-flex items-center gap-1 text-forest/60"><x-icon name="download" class="h-4 w-4" /> Receipt</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.portal>
