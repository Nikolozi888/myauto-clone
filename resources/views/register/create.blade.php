@extends('components.layout')
@section('title', 'Register')
@section('content')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">რეგისტრაცია</h1>
        <form action="{{ route('register.handler') }}" method="POST" class="bg-white p-6 shadow rounded">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">სახელი</label>
                <input type="text" name="name" id="name"
                    class="mt-1 p-3 block w-full border-gray-300 rounded-md shadow-lg">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">ელფოსტა</label>
                <input type="email" name="email" id="email"
                    class="mt-1 p-3 block w-full border-gray-300 rounded-md shadow-lg">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">პაროლი</label>
                <input type="password" name="password" id="password"
                    class="mt-1 p-3 block w-full border-gray-300 rounded-md shadow-lg">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">დაადასტურეთ
                    პაროლი</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 p-3 block w-full border-gray-300 rounded-md shadow-lg">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">რეგისტრაცია</button>
            <br>
            <br>
            <a href="{{ route('login') }}" class="text-blue-500 text-sm">ავტორიზაცია</a>
        </form>
    </div>

@endsection
