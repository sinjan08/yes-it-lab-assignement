@extends('layouts.main')

@section('title', 'Update Users')

@section('content')
<section class="items-center justify-center gap-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-10">
        <h1 class="text-2xl font-bold">Edit User</h1>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-10">
        <form class="max-w-lg mx-auto" action="{{ route('users.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="mb-5">
                @if ($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image"
                    class="w-32 h-32 rounded-full mx-auto">
                @endif
            </div>
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                    Name <span class="text-red-500">*</span></label>
                <input type="text" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="John Doe" value="{{ $user->name }}" />
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email <span
                        class="text-red-500">*</span></label>
                <input type="email" name="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="example@mail.com" value="{{ $user->email }}" />
            </div>
            <div class="mb-5">
                <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile <span
                        class="text-red-500">*</span></label>
                <input type="text" name="mobile"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="0123456789" value="{{ $user->mobile }}" />
            </div>
            <div class="mb-5">
                <label for="profileImage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload
                    Profile image</label>
                <input type="file" name="profileImage" accept="image/*"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
</section>

@endsection