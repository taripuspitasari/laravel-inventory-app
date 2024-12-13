@extends('layouts.main')
@section('container')
<div class="md:px-10">
    <div class="flex flex-col w-full mb-10 space-y-7">
        <div class="font-light text-gray-500 dark:text-gray-400 md:w-1/2 mx-auto">
            <h2 class="text-xl md:text-4xl font-extrabold text-gray-900 dark:text-white text-center my-4 ">A smart solution for managing inventory efficiently and effortlessly.</h2>
            <p class="text-center font-normal">Stockmate is designed to help users monitor their inventory in real time.</p>
            <div class="flex justify-center mt-3">
                <a href="/register" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Get Started</a>
            </div>
        </div>
        <div>
            <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white text-center"> Features</h3>
            <ul class="grid md:grid-rows-1 md:grid-flow-col gap-4">
                <li class="border border-slate-200 shadow-md py-2 px-6 rounded-md hover:scale-110 transform transition duration-150 ease-in-out">
                    <h4 class="font-bold mb-2">Manage Product </h4>
                    <p class="font-normal text-sm text-gray-500">Add, update, and track inventory items.</p>
                </li>
                <li class="border border-slate-200 shadow-md py-2 px-6  rounded-md hover:scale-110 transform transition duration-150 ease-in-out">
                    <h4 class="font-bold mb-2">Organize Categories </h4>
                    <p class="font-normal text-gray-500">Keep stock structured with categories.</p>
                </li>
                <li class="border border-slate-200 shadow-md py-2 px-6  rounded-md hover:scale-110 transform transition duration-150 ease-in-out">
                    <h4 class="font-bold mb-2">Supplier and Customer Records </h4>
                    <p class="font-normal text-gray-500">Manage business partners in one place.</p>
                </li>
                <li class="border border-slate-200 shadow-md py-2 px-6  rounded-md hover:scale-110 transform transition duration-150 ease-in-out">
                    <h4 class="font-bold mb-2">Track Transactions </h4>
                    <p class="font-normal text-gray-500">Record and monitor sales or purchases.</p>
                </li>
                <li class="border border-slate-200 shadow-md py-2 px-6  rounded-md hover:scale-110 transform transition duration-150 ease-in-out">
                    <h4 class="font-bold mb-2">eCommerce Integration (coming soon) </h4>
                    <p class="font-normal text-gray-500">Build a connected online store with an API.</p>
                </li>
            </ul>
        </div>
    </div>
    <hr>
    <p class="text-sm text-center md:text-right text-slate-400 my-2">&copy; {{ date('Y') }} Tari | Stockmate. All Rights Reserved.</p>
</div>
@endsection