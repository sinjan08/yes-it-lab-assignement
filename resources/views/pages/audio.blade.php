@extends('layouts.main')

@section('title', 'Audio')

@section('content')
<section class="items-center justify-center gap-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-10">
        <h1 class="text-2xl font-bold">Calculate Aduio Duration</h1>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-10">
        <form class="max-w-lg mx-auto" action="{{ route('audio.get-duration') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="audio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload
                    Audio</label>
                <input type="file" name="audio" accept="audio/*"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get
                Duration</button>
        </form>
        @if (session('audioInfo'))
        <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto my-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Audio Info</h2>
            <ul class="space-y-2 text-gray-700">
                <li><span class="font-medium">Duration:</span> {{ session('audioInfo')['duration'] }}</li>
                <li><span class="font-medium">Format:</span> {{ session('audioInfo')['format'] }}</li>
                <li><span class="font-medium">File Size:</span> {{ session('audioInfo')['filesize'] }}</li>
            </ul>
        </div>
        @endif
    </div>
</section>

@endsection