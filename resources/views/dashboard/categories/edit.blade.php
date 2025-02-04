@extends('dashboard.layouts.sidebar')
@section('container')
<form class="lg:w-1/2" action="/dashboard/categories/{{ $category->id }}" method="post">
    @method('put')
    @csrf
<div class="space-y-2">
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name Category</label>
        <input type="text" name="name" id="name" class="{{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type category name" required value="{{ old('name', $category->name) }}" autofocus>
        @error('name')
        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
        <textarea id="description" name="description" id="description" rows="4" class="{{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Your description here" required>{{ old('description', $category->description) }}</textarea>
        @error('description')
        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Update Category</button>
</div>
</form>
@endsection