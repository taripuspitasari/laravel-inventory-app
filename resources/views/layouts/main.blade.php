<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>StockMate</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
</head>
<body class="bg-white">
    <header x-data="{ isOpen: false }" class="absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1">
                <a href="/" class="flex items-center -m-1.5 p-1.5">
                <svg class="mr-1 text-primary-700 h-6 sm:h-9" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <span class="self-center text-xl font-semibold whitespace-nowrap">StockMate</span>
                </a>
            </div>
            <div @click="isOpen = !isOpen" class="flex lg:hidden">
                <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="/" class="{{ Request::is('/') ? 'bg-primary-700 text-white lg:text-primary-700 lg:bg-transparent' : ''}} text-sm/6 font-semibold text-gray-900">Home</a>
                <a href="/products" class="{{ Request::is('products') ? 'bg-primary-700 text-white lg:text-primary-700 lg:bg-transparent' : ''}} text-sm/6 font-semibold text-gray-900">Products</a>
                <a href="/contacts" class="{{ Request::is('contacts') ? 'bg-primary-700 text-white lg:text-primary-700 lg:bg-transparent' : ''}} text-sm/6 font-semibold text-gray-900">Contacts</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                @auth
                <a href="/dashboard" class="text-sm/6 font-semibold text-gray-900">Dashboard</a>
                @else
                <a href="/login" class="text-sm/6 font-semibold text-gray-900">Log in <span>&rarr;</span></a> 
                @endauth
            </div>
        </nav>
        <div x-bind:class="{'hidden': !isOpen, '': isOpen}">
            <div class="backdrop:bg-transparent lg:hidden">
                <div tabindex="0" class="fixed inset-0 focus:outline-none">
                    <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                        <div class="flex items-center justify-between">
                            <a href="/" class="-m-1.5 p-1.5">
                                <span class="self-center text-xl font-semibold whitespace-nowrap">StockMate</span>
                            </a>
                            <button @click="isOpen = !isOpen" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                                <span class="sr-only">Close menu</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-6 flow-root">
                            <div class="-my-6 divide-y divide-gray-500/10">
                                <div class="space-y-2 py-6">
                                    <a href="/" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Home</a>
                                    <a href="/products" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Products</a>
                                    <a href="/contacts" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Contacts</a>
                                    @auth
                                    <a href="/dashboard" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Dashboard</a>
                                    @endauth
                                </div>
                                @guest
                                <div class="py-6">
                                    <a href="/login" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
                                </div> 
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="relative isolate px-6 pt-14 lg:px-8">
        @yield('container')
    </section>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>