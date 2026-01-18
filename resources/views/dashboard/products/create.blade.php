@extends('dashboard.layouts.sidebar')
@section('container')
<form action="/dashboard/products" method="post" enctype="multipart/form-data" class="grid grid-cols-1">
    @csrf
    <label for="name" class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Name Product</span>
        </div>
        <input name="name" id="name" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" required value="{{ old('name') }}" autofocus/>
        @error('name')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <label for="category" class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Category</span>
        </div>
        <select id="category" name="category_id" class="select select-bordered" required value="{{ old('category') }}">
            <option disabled {{ old('category_id') ? '' : 'selected' }}>Select category</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
            </option>
            @endforeach
        </select>
        @error('category_id')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <label for="stock" class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Total Stock</span>
        </div>
        <input name="stock" id="stock" type="number" placeholder="Type here" class="input input-bordered w-full max-w-xs" required value="{{ old('stock') }}"/>
        @error('stock')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <label for="low_stock_threshold" class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Low Stock Threshold</span>
        </div>
        <input name="low_stock_threshold" id="low_stock_threshold" type="number" placeholder="Type here" class="input input-bordered w-full max-w-xs" required value="{{ old('low_stock_threshold') }}"/>
        @error('low_stock_threshold')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <label for="price" class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Selling Price</span>
        </div>
        <input name="price" id="price" type="number" placeholder="Type here" class="input input-bordered w-full max-w-xs" required value="{{ old('price') }}"/>
        @error('price')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <label for="description" class="form-control row-span-2">
        <div class="label">
            <span class="label-text">Description</span>
        </div>
        <textarea name="description" id="description" class="textarea textarea-bordered w-full max-w-xs" placeholder="Type here" required value="{{ old('description') }}"></textarea>
        @error('description')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <label for="image" class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Product Image</span>
        </div>
        <img class="img-preview mb-3 w-1/2 hidden">
        <input name="image" id="image" type="file" onchange="previewImage()" class="file-input file-input-bordered w-full max-w-xs" required value="{{ old('image') }}" />
        @error('image')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <div class="py-2.5">
        <button type="submit" class="btn w-full max-w-xs text-white bg-primary-600 hover:bg-primary-700">Create Product</button>
    </div>
</form>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.classList.remove('hidden');

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection