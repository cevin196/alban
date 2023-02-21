<div class="w-3/4 mx-auto mb-3">
    <div class="flex justify-center my-2">
        <span class="font-bold">Spare Parts</span>
    </div>
    <table class="mb-1 w-full">
        <tr>
            <th>Spare Part Name</th>
            <th class="w-2/12">Qty</th>
            <th>Ammount</th>
            <th></th>
        </tr>
        @foreach ($jobSpareParts as $index => $jobSparePart)
            <tr>
                <td><input name="jobSpareParts[{{ $index }}][name]" type="text" class="w-full rounded"
                        wire:model="jobSpareParts.{{ $index }}.name">
                </td>
                <td><input name="jobSpareParts[{{ $index }}][qty]" type="text" class="w-full rounded"
                        wire:model="jobSpareParts.{{ $index }}.qty"></td>
                <td><input name="jobSpareParts[{{ $index }}][ammount]" type="text" class="w-full rounded"
                        wire:model='jobSpareParts.{{ $index }}.ammount'></td>
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
