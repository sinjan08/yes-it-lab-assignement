@extends('layouts.main')

@section('title', 'Users')

@section('content')
<section class="items-center justify-center gap-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-10">
        <h1 class="text-2xl font-bold">Users</h1>
        <div class="items-end justify-end text-right">
            <a href="{{ route('users.create') }}"
                class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded mx-4">
                Add User
            </a>
            <a href="{{ route('users.export') }}"
                class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded mx-4">
                Export to CSV
            </a>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-10">
        <table id="userTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Image</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Mobile</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>


        <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("users.data") }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'profile_image',
                        name: 'profile_image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'mobile',
                        name: 'mobile',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
        </script>
    </div>
</section>

@endsection