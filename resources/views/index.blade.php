@extends('layouts.main')
@section('container')
<div>
    <div class="mx-auto max-w-2xl py-16">
        <div class="hidden sm:mb-8 sm:flex sm:justify-center">
            <div class="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10">
            Inventory Management System
            </div>
        </div>
        <div class="text-center">
            <h1 class="text-5xl font-semibold tracking-tight text-balance text-gray-900">Organize stock, products, and transactions in one centralized system</h1>
            <p class="mt-8 text-md font-medium text-pretty text-gray-500">Stockmate is designed to help users monitor their inventory in real time.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="#" class="rounded-md bg-primary-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Get started</a>
            <a href="https://github.com/taripuspitasari/laravel-inventory-app" class="text-sm/6 font-semibold text-gray-900">Learn more <span aria-hidden="true">→</span></a>
            </div>
        </div>
    </div>
    <div class="text-xs text-center text-slate-400 mt-3 mb-2">&copy; {{ date('Y') }} Tari | Stockmate. All Rights Reserved.</div>
</div>
@endsection