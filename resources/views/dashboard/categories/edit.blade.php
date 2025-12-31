@extends('dashboard.layouts.sidebar')
@section('container')
<form class="lg:w-1/2" action="/dashboard/categories/{{ $category->id }}" method="post">
    @method('put')
    @csrf
    <label for="name" class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Name Category</span>
        </div>
        <input name="name" id="name" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" required value="{{ old('name', $category->name) }}" autofocus/>
        @error('name')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <label for="description" class="form-control row-span-2">
        <div class="label">
            <span class="label-text">Description</span>
        </div>
        <textarea name="description" id="description" class="textarea textarea-bordered w-full max-w-xs" placeholder="Type here" required>{{ old('description', $category->description) }}</textarea>
        @error('description')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <div class="py-2.5">
        <button type="submit" class="btn w-full max-w-xs text-white bg-primary-600 hover:bg-primary-700">Update Cateogry</button>
    </div>
</form>
@endsection