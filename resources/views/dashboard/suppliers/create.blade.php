@extends('dashboard.layouts.sidebar')
@section('container')
<form action="/dashboard/suppliers" method="post" class="grid grid-cols-1">
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

    <label for="email" class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Email</span>
        </div>
        <input name="email" id="email" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" required value="{{ old('email') }}"/>
        @error('email')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <label for="phone" class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Phone</span>
        </div>
        <input name="phone" id="phone" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" required value="{{ old('phone') }}" pattern="[0-9]{10,15}"/>
        @error('phone')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <label for="address" class="form-control row-span-2">
        <div class="label">
            <span class="label-text">Address</span>
        </div>
        <textarea name="address" id="address" class="textarea textarea-bordered w-full max-w-xs" placeholder="Type here" required value="{{ old('address') }}"></textarea>
        @error('address')
        <div class="label">
            <span class="label-text-alt text-red-600">{{ $message }}</span>
        </div>
        @enderror
    </label>

    <div class="py-2.5">
        <button type="submit" class="btn w-full max-w-xs text-white bg-primary-600 hover:bg-primary-700">Create Supplier</button>
    </div>
</form>
@endsection