@extends('layouts.main')
@section('container')
<div class="mx-auto lg:w-1/2 p-6 space-y-4  md:space-y-6 sm:p-8">
    @if(session()->has('success'))
    <div x-data="{show:true}" x-init="setTimeout(()=> show = false, 5000)" x-show="show" role="alert" class="alert alert-success">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 shrink-0 stroke-current"
          fill="none"
          viewBox="0 0 24 24">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
      @endif

      @if(session()->has('error'))
      <div x-data="{show:true}" x-init="setTimeout(()=> show = false, 5000)" x-show="show" role="alert" class="alert alert-error">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 shrink-0 stroke-current"
          fill="none"
          viewBox="0 0 24 24">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('error') }}</span>
      </div>
      @endif
      
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Login
    </h1>
    <form class="space-y-4 md:space-y-6" action="/login" method="post">
        @csrf
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input type="email" name="email" id="email" class="{{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="tari@gmail.com" required autofocus value="{{ old('email') }}">
            @error('email')
            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required >
        </div>
        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            Don’t have an account yet? <a href="/register" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Register</a>
        </p>
    </form>
</div>
@endsection