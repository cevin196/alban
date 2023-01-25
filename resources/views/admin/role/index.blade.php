@extends('layouts.admin.app')

@section('content')
    <h1 class="text-xl lg:text-2xl font-bold">Roles</h1>
    <span class="capitalize text-lg text-[#444444]">Here what's doing in your business right now</span>

    <div class="w-full bg-white rounded p-5 mt-3">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center">
                            <thead class="border-b bg-gray-50">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 w-1/12">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        Name
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 w-1/6">
                                        Action
                                    </th>
                                </tr>
                            </thead class="border-b">
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $loop->index + 1 }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $role->name }}
                                        </td>
                                        <td
                                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap flex justify-between items-stretch">
                                            <a href="{{ route('role.edit', $role) }}"
                                                class="px-2 py-1 rounded text-white bg-amber-500 w-auto">edit</a>
                                            <button class="px-2 py-1 rounded text-white bg-red-500 w-auto">delete</button>
                                        </td>
                                    </tr class="bg-white border-b">
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
