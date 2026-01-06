@extends('dashboard.layouts.sidebar')
@section('container')
<section class="">
    <div class="flex flex-col gap-2 md:flex-row justify-between">
        <div class="w-full md:w-96">
            <form class="flex items-center" action="/dashboard/categories" method="get">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="search" name="search" id="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500" placeholder="Search categories" value="{{ request('search') }}">
                </div>
            </form>
        </div>
        <a href="/dashboard/categories/create" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-4 py-2" >
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            <p>Add category</p>
        </a>
    </div>
    
    <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100 my-4">
        <table class="table">
            <thead>
            <tr>
                <th>No</th>
                <th>Category Name</th>
                <th>Description</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $loop->iteration + ($categories->currentPage()-1) * $categories->perPage() }}</td>
                <td><a href="/dashboard/categories/{{ $category->id }}">{{ $category->name }}</a></td>
                <td>{{ Str::limit($category->description, 100) }}</td>
                <td x-data="{open:false}" class="relative">
                    <button x-on:click="open = true" x-on:mouseleave="open = false" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                    
                    <div x-show="open" x-on:mouseenter="open = true" x-on:mouseleave="open = false" class="absolute z-50 right-1 top-0" x-cloak>
                        <div class="join">
                            <button class="btn join-item bg-white"><a href="/dashboard/categories/{{ $category->id }}">Show</a></button>
                            <button class="btn join-item bg-white"><a href="/dashboard/categories/{{ $category->id }}/edit">Edit</a></button>
                            <div class="btn join-item bg-white">
                                <form action="/dashboard/categories/{{ $category->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td>No categories found</td>
            </tr>
            @endforelse    
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
</section>
@endsection