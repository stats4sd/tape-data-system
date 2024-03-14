<div class="h-100 flex">

    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg h-100 flex flex-col flex-grow">
        <div class="px-4 py-5 sm:px-6 flex-grow">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">{{ $title }}</h3>
            <p class="mt-1 max-w 2xl text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
        </div>


        @if($link)
        <div class="px-4 py-5 sm:px-6 mt-auto">
            <a href="{{ $link }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ $buttonText }}
            </a>
        </div>
            @endif
    </div>

</div>
