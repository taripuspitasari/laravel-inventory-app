@extends('dashboard.layouts.sidebar')
@section('container')
<form class="lg:w-1/2" action="/dashboard/suppliers/{{ $supplier->id }}" method="post">
@method('put')
@csrf
<div class="space-y-2">
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name supplier</label>
        <input type="text" name="name" id="name" class="{{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type supplier name" required value="{{ old('name', $supplier->name) }}" autofocus>
        @error('name')
        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="email" name="email" id="email" class="{{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="example@gmail.com" required value="{{ old('email', $supplier->email) }}">
        @error('email')
        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
        <input 
            type="text" 
            name="phone" 
            id="phone" 
            class="bg-gray-50 border {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="089657969212" 
            required 
            value="{{ old('phone', $supplier->phone) }}"
            pattern="[0-9]{10,15}" 
            title="Masukkan nomor telepon valid (10-15 digit angka)">
        
        @error('phone')
        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>  

    <div>
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
        <textarea id="address" name="address" id="address" rows="4" class="{{ $errors->has('address') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Jl. Cikeleng Pesantren No. 2" required>{{ old('address', $supplier->address) }}</textarea>
        @error('address')
        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Edit supplier</button>
</div>
</form>
@endsection