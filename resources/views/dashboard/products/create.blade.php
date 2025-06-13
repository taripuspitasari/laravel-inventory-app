@extends('dashboard.layouts.sidebar')
@section('container')
<form class="flex flex-col space-y-2" action="/dashboard/products" method="post" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-2 gap-2">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name Product</label>
            <input type="text" name="name" id="name" class="{{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type product name" required value="{{ old('name') }}" autofocus>
            @error('name')
            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select id="category" name="category_id" class="{{ $errors->has('category_id') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 " required value="{{ old('category') }}">
                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
            <input type="number" name="stock" id="stock" class="{{ $errors->has('stock') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 " placeholder="12" required value="{{ old('stock') }}">
            @error('stock')
            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
            <input type="number" name="price" id="price" class="{{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 " placeholder="Rp. 200000" required value="{{ old('price') }}">
            @error('price')
            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Image</label>
            <img class="img-preview mb-3 w-1/2">
            <input type="file" name="image" id="image" onchange="previewImage()" class="file-input file-input-bordered file-input-md max-w-xs" />
            @error('image')
            <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea id="description" name="description" id="description" rows="4" class="{{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Product description here" required>{{ old('description') }}</textarea>
            @error('description')
            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-span-2 flex justify-end">
            <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create Product</button>
        </div>
    </div>
    
</form>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent){
            imgPreview.src = oFREvent.target.result;
        }

    }
</script>
@endsection