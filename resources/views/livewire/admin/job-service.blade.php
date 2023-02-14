<div class="w-3/4 mx-auto mb-3">
    <div class="flex justify-center my-2">
        <span class="font-bold">Services</span>
    </div>
    <table class="mb-1 w-full">
        <tr>
            <td>Service</td>
            <td class="w-2/12">Qty</td>
            <td>Ammount</td>
            <td></td>
        </tr>
        @foreach ($jobServices as $index => $jobService)
            <tr>
                <td><input name="jobServices[{{ $index }}][name]" type="text" class="w-full rounded"
                        wire:model="jobServices.{{ $index }}.name">
                </td>
                <td><input name="jobServices[{{ $index }}][qty]" type="text" class="w-full rounded"
                        wire:model="jobServices.{{ $index }}.qty"></td>
                <td><input name="jobServices[{{ $index }}][ammount]" type="text" class="w-full rounded"
                        wire:model='jobServices.{{ $index }}.ammount'></td>
                <td class="flex item-center">
                    <button wire:click.prevent="removeRow({{ $index }})"
                        class="bg-red-500 hover:bg-red-600 text-white rounded py-1 px-2" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>

    <button wire:click.prevent="addRow" class="bg-green-500 hover:bg-green-600 text-white rounded px-2 py-1"
        type="button">+
        Add New</button>
</div>
