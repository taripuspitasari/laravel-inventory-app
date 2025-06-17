<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <title>StockMate</title>
    <style>
        [x-cloak] { display: none; }
    </style>
</head>
<body>
    <div x-data="{ isOpen: false }" class="relative lg:flex min-h-screen  bg-slate-200">
        <!-- Sidebar -->
        <div class="absolute z-10 right-0 top-0 lg:static w-32 lg:w-40 lg:flex flex-col lg:justify-between bg-white lg:py-2 shadow-md rounded-r-lg">
            <div>
                <ul class="hidden lg:block">
                    <li class="p-4">
                        <div class="font-semibold">
                            <p class="text-primary-700 text-lg">StockMate</p>
                        </div>
                    </li>
                    <li class="p-1">
                        <a href="/dashboard" class="{{ Request::is('dashboard') ? 'bg-primary-700 text-white' : 'bg-white text-gray-800' }} flex items-center gap-2 p-2 rounded-lg hover:bg-primary-700 hover:text-white">
                            <svg class="w-4 h-4  dark:text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z" clip-rule="evenodd"/>
                            </svg> 
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="py-2 px-3 font-medium">Master Data</li>
                    <li class="p-1">
                        <a href="/dashboard/products" class="{{ Request::is('dashboard/products*') ? 'bg-primary-700 text-white' : 'bg-white text-gray-800'}} flex items-center gap-2 p-2 rounded-lg hover:bg-primary-700 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 ">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg> Products
                        </a>
                    </li>
                    <li class="p-1">
                        <a href="/dashboard/categories" class="{{ Request::is('dashboard/categories*') ? 'bg-primary-700 text-white' : 'bg-white text-gray-800' }} flex items-center gap-2 p-2 rounded-lg hover:bg-primary-700 hover:text-white">
                            <svg class=" w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
                            </svg> 
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="p-1">
                        <a href="/dashboard/suppliers" class="{{ Request::is('dashboard/suppliers*') ? 'bg-primary-700 text-white' : 'bg-white text-gray-800' }} flex items-center gap-2 p-2 rounded-lg hover:bg-primary-700 hover:text-white"> 
                            <svg class=" w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                            </svg> 
                            <p>Suppliers</p>
                        </a>
                    </li>
                    <li class="py-2 px-3 font-medium">Transaction</li>
                    <li class="p-1">
                        <a href="/dashboard/purchases" class="{{ Request::is('dashboard/purchases*') ? 'bg-primary-700 text-white' : 'bg-white text-gray-800' }} flex items-center gap-2 p-2 rounded-lg hover:bg-primary-700 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625ZM21 9.375A.375.375 0 0 0 20.625 9h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5ZM10.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5ZM3.375 15h7.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h7.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 10.875 9h-7.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Z" clip-rule="evenodd" />
                            </svg> 
                            <p>Purchases</p>
                        </a>
                    </li>
                    <li class="p-1">
                        <a href="/dashboard/orders" class="{{ Request::is('dashboard/orders*') ? 'bg-primary-700 text-white' : 'bg-white text-gray-800' }} flex items-center gap-2 p-2 rounded-lg hover:bg-primary-700 hover:text-white">
                            <svg class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.013 6.175 7.006 9.369l5.007 3.194-5.007 3.193L2 12.545l5.006-3.193L2 6.175l5.006-3.194 5.007 3.194ZM6.981 17.806l5.006-3.193 5.006 3.193L11.987 21l-5.006-3.194Z"/>
                                <path d="m12.013 12.545 5.006-3.194-5.006-3.176 4.98-3.194L22 6.175l-5.007 3.194L22 12.562l-5.007 3.194-4.98-3.211Z"/>
                            </svg>
                            <p> Orders</p>
                        </a>
                    </li>
                </ul>
                <ul x-bind:class="{'hidden': !isOpen, '': isOpen}" class="hidden lg:hidden">
                    <li @click="isOpen = !isOpen"  class="p-4 flex justify-end cursor-pointer">
                        <div>
                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                            </svg>
                        </div>
                    </li>
                    <li class="p-4">
                        <a href="/dashboard" class="w-4 h-4  dark:text-white hover:text-primary-700 {{ Request::is('dashboard') ? 'text-primary-700' : 'text-gray-800' }}">
                            Home
                        </a>
                    </li>
                    <li class="p-4">
                        <a href="/dashboard/products" class="size-5 {{ Request::is('dashboard/products*') ? 'text-primary-700' : 'text-gray-800' }} hover:text-primary-700">
                            Products
                        </a>
                    </li>
                    <li class="p-4">
                        <a href="/dashboard/categories" class="size-5 {{ Request::is('dashboard/categories*') ? 'text-primary-700' : 'text-gray-800' }} hover:text-primary-700">
                            Categories
                        </a>
                    </li>
                    <li class="p-4">
                        <a href="/dashboard/suppliers" class="size-5 {{ Request::is('dashboard/suppliers*') ? 'text-primary-700' : 'text-gray-800' }} hover:text-primary-700">
                            Suppliers
                        </a>
                    </li>
                    <li class="p-4">
                        <a href="/dashboard/purchases" class="size-5 {{ Request::is('dashboard/purchases*') ? 'text-primary-700' : 'text-gray-800' }} hover:text-primary-700">
                            Purchases
                        </a>
                    </li>
                    <li class="p-4">
                        <a href="/dashboard/orders" class="size-5 {{ Request::is('dashboard/orders*') ? 'text-primary-700' : 'text-gray-800' }} hover:text-primary-700">
                            Orders
                        </a>
                    </li>
                    <li class="p-4">
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="p-1 hidden lg:block">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="flex gap-2 p-2 hover:bg-primary-700 hover:text-white rounded-lg w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg> Logout
                    </button>
                </form>
            </div>
        </div>
        <!-- Main content -->
        <div class="py-2 px-5 lg:flex-1">
            <div class="h-14 min-w-full mb-2 flex justify-between items-center">
                <div class="text-center text-xl font-semibold">
                    <p>{{ $title }}</p>
                </div>
                <div class="hidden lg:block text-right text-sm font-semibold">
                    <p>{{ auth()->user()->name }}</p>
                </div>
                <div @click="isOpen = !isOpen"  class="lg:hidden">
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                    </svg>
                </div>
            </div>
            <div>
                @yield('container')
            </div>
        </div>
    </div>
</body>
</html>

