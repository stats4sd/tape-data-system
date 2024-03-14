<div {{ $attributes->class(['w-full']) }}>
    <div class="flex w-full h-5 bg-gray-200 overflow-hidden dark:bg-gray-700" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
        <div class="flex flex-col justify-center overflow-hidden {{ $percent === 100 ? 'bg-green-600' : 'bg-blue-600' }} text-xs text-white text-center whitespace-nowrap transition duration-500 dark:bg-blue-500" style="width: {{ $percent }}%"></div>
    </div>
    <div class="mt-2 flex flex-col justify-between items-center gap-y-1">
        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">{{ $stepName }}</h3>
        <span class="text-sm text-gray-800 dark:text-white">{{ $status }}</span>
    </div>
</div>
