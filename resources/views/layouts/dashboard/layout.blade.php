<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sumut - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">
    <link rel="stylesheet" href="{{ asset('themes/dashboard/css/style.css') }}">
    <style>
        #caret {
            transition: transform 0.15s ease-in-out;
        }
    </style>
    @stack('css')
</head>

<body class="flex flex-col justify-start h-full" style="background-color: #FFF1E8;">
    <section class="flex">
        <!-- container -->
        <section class="flex flex-col w-full">
            <header class="bg-white relative px-6 w-full">
                <div class="flex justify-between">
                    <div class="flex flex-col justify-center">
                        <img src="{{ asset('themes/dashboard/assets/image/bank-sumut.png') }}" alt="Logo Bank Sumut" style="width: 92px;height: 43px;">
                    </div>
                    <div class="flex justify-end gap-4 py-3">
                        <div class="flex items-center h-fit gap-2">

                            <div class="relative inline-block text-left cursor-pointer">
                                <div id="dropdown-button" class="inline-flex justify-center items-center">
                                    <p class="text-sm font-medium text-black">{{auth()->user()->name}}</p>
                                    <img src="{{ asset('themes/dashboard/assets/p-5.jpeg') }}" alt="chevron" class="ml-3 w-10 h-10 rounded-full">
                                    <svg id="caret" class="ml-1 -mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6.293 7.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div id="dropdown-menu" class="origin-top-right hidden absolute z-50 bg-white w-full left-0 mt-2 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none bg-slate-700" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button" tabindex="-1">
                                    <div class="py-1" role="none">
                                        @role('admin')
                                        <a href="{{route('categories.index')}}" class="block px-4 py-2 text-left text-sm hover:text-blue-600" role="menuitem">Administrator</a>
                                        @endrole
                                        <a href="#" class="block px-4 pt-2 pb-3 text-left text-sm hover:text-blue-600" role="menuitem">Profile</a>
                                        {{-- <a href="{{route('logout')}}" class="block border-t px-4 py-2 text-left text-sm hover:text-blue-600" role="menuitem">logout</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            @yield('content')
        </section>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.js"></script>
    <script src="{{ asset('themes/dashboard/js/dropdown.js') }}"></script>
    {{-- <script src="{{ asset('themes/dashboard/js/bar-chart.js') }}"></script>
    <script src="{{ asset('themes/dashboard/js/chart-gauge.js') }}"></script> --}}

    @stack('js')
</body>
