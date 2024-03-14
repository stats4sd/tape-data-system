<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">PDF Downloads <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
</svg>
</button>

<!-- Dropdown menu -->
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
      <li>
        <a href="{{ url('private/TAPE - GIZ MAP Project 2023-12-05 EN FULL PAGE.pdf') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">English (en) - 1 page per page</a>
      </li>
      <li>
        <a href="{{ url('private/TAPE - GIZ MAP Project 2023-12-05 EN 2-PER-PAGE.pdf') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">English (en) 2 Pages per Page</a>
      </li>
      <li>
        <a href="{{ url('private/TAPE - GIZ MAP Project 2023-12-05 FR FULL PAGE.pdf') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">French (fr) - 1 Page per Page</a>
      </li>
      <li>
        <a href="{{ url('private/TAPE - GIZ MAP Project 2023-12-05 FR 2-PER-PAGE.pdf') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">French (fr) 2 Pages per Page</a>
      </li>
        <li>
        <a href="{{ url('private/TAPE - GIZ MAP Project 2023-12-05 MG FULL PAGE.pdf') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Malagasy (mg) - 1 Page per Page</a>
      </li>
      <li>
        <a href="{{ url('private/TAPE - GIZ MAP Project 2023-12-05 MG 2-PER-PAGE.pdf') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Malagasy (mg) 2 Pages per Page</a>
      </li>
    </ul>
</div>
