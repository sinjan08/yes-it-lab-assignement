@extends('layouts.main')

@section('title', 'Distance')

@section('content')
<section class="items-center justify-center gap-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-10">
        <h1 class="text-2xl font-bold">Calculate Distance</h1>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-10">
        <form class="max-w-lg mx-auto flex flex-row flex-wrap" action="{{ route('distance.get-distance') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <div class="m-5">
                <label for="lat1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lattitude
                    1</label>
                <input type="text" name="lat1"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="m-5">
                <label for="lng1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Longitude
                    1</label>
                <input type="text" name="lng1"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="m-5">
                <label for="lat2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lattitude
                    2</label>
                <input type="text" name="lat2"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="m-5">
                <label for="lng2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Longitude
                    2</label>
                <input type="text" name="lng2"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <button type="submit"
                class="m-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Calculate
                Distance</button>
        </form>
        @if (session('distance'))
        <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto my-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Distance: {{ session('distance') }} KM</h2>
        </div>
        @endif
    </div>
</section>

@endsection