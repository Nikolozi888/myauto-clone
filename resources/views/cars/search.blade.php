@extends('components.layout')
@section('title', 'ფილტრი')
@section('content')

    <x-header />

    <main class="p-6 mt-10">
        <section class="bg-white shadow-xl p-4 border border-black rounded-lg">
            <form action="{{ route('index') }}" method="GET" id="filterForm">
                <input type="hidden" name="author" id="author">
                <div>
                    <!-- Brand Selection -->
                    <div id="formPage" class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-600">მარკა</label>
                            <select name="brand_id" id="brand" class="w-full p-2 border rounded-md">
                                <option value="">აირჩიეთ მარკა</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-600">მოდელი</label>
                            <select name="model" id="model" class="w-full p-2 border rounded-md">
                                <option value="">აირჩიეთ მოდელი</option>
                            </select>
                        </div>




                        <div>
                            <label class="block text-gray-600">გარბენი</label>
                            <input class="w-full p-2 border rounded-md" type="number" value="{{ request('mileage') }}"
                                name="mileage" id="mileage">
                        </div>

                        <!-- Fuel Type Selection -->
                        <div>
                            <p class="block text-gray-600">გარბენი</p>
                            <!-- Dropdown Trigger -->
                            <button type="button"
                                class="w-full flex justify-between items-center bg-white border border-gray-300 rounded-md px-4 py-2 text-gray-700 cursor-pointer focus:outline-none"
                                onclick="toggleFuelDropdown()" id="fuelDropdownButton">
                                <span id="selectedFuelOptions" class="">აირჩიეთ საწვავი</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Content -->
                            <div id="fuelDropdownContent"
                                class="absolute w-1/4 bg-white border border-gray-300 rounded-md mt-2 shadow-lg z-10 hidden">
                                <div class="p-3 space-y-2">
                                    @foreach (\App\Models\FuelType::all() as $fuel)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="fuel_type[]" value="{{ $fuel->id }}"
                                                id="fuel_{{ $fuel->id }}"
                                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                                onclick="updateFuelSelectedOptions()">
                                            <label for="fuel_{{ $fuel->id }}" class="ml-2 text-gray-700">
                                                {{ ucfirst($fuel->name) }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <button type="button" class="w-full mt-3 bg-blue-600 text-white px-4 py-2 rounded-md"
                                        onclick="closeFuelDropdown()">
                                        არჩევა
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <!-- Dropdown Trigger -->
                            <p class="block text-gray-600">გარბენი</p>
                            <button type="button"
                                class="w-full flex justify-between items-center bg-white border border-gray-300 rounded-md px-4 py-2 text-gray-700 cursor-pointer focus:outline-none"
                                onclick="toggleDropdown()" id="dropdownButton">
                                <span id="selectedOptions" class="">აირჩიეთ გადაცემათა კოლოფი</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Content -->
                            <div id="dropdownContent"
                                class="absolute w-1/4 bg-white border border-gray-300 rounded-md mt-2 shadow-lg z-10 hidden">
                                <div class="p-3 space-y-2">
                                    @foreach (\App\Models\Gearbox::all() as $gearbox)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="gearbox[]" value="{{ $gearbox->id }}"
                                                id="gearbox_{{ $gearbox->id }}"
                                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                                onclick="updateSelectedOptions()">
                                            <label for="gearbox_{{ $gearbox->id }}" class="ml-2 text-gray-700">
                                                {{ ucfirst($gearbox->name) }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <button type="button" class="w-full mt-3 bg-blue-600 text-white px-4 py-2 rounded-md"
                                        onclick="closeDropdown()">
                                        არჩევა
                                    </button>
                                </div>
                            </div>
                        </div>



                        <div>
                            <label class="block text-gray-600">ტიპი</label>
                            <select name="body_type" id="body_type" class="w-full p-2 border rounded-md">
                                <option value="" selected disabled>ყველა</option>
                                @foreach (\App\Models\BodyType::all() as $body_type)
                                    <option value="{{ $body_type->id }}"
                                        {{ request('body_type') == $body_type->id ? 'selected' : '' }}>
                                        {{ ucfirst($body_type->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="block">
                            <!-- Year Input -->
                            <div class="flex">
                                <div class="mr-5">
                                    <label class="block text-gray-600">წელი დან</label>
                                    <input class="w-full p-2 border rounded-md" type="number"
                                        value="{{ request('year_min') }}" name="year_min" id="year">
                                </div>
                                <div>
                                    <label class="block text-gray-600">წელი მდე</label>
                                    <input class="w-full p-2 border rounded-md" type="number"
                                        value="{{ request('year_max') }}" name="year_max" id="year">
                                </div>
                            </div>

                            <!-- Price Inputs -->
                            <div class="flex mt-5">
                                <div class="mr-5">
                                    <label class="block text-gray-600">მინ. ფასი</label>
                                    <input class="w-full p-2 border rounded-md" type="number"
                                        value="{{ request('price_min') }}" name="price_min" id="price_min">
                                </div>
                                <div>
                                    <label class="block text-gray-600">მაქს. ფასი</label>
                                    <input class="w-full p-2 border rounded-md" type="number"
                                        value="{{ request('price_max') }}" name="price_max" id="price_max">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex items-center">
                        <button id="filterButton" class="bg-orange-500 text-white px-4 py-2 rounded-md w-2/4">
                            გაფილტვრა
                        </button>
                    </div>


                    <div id="buttonNormal" class="mt-10">

                    </div>
                </div>
            </form>
        </section>
    </main>

    <!-- Filtered Cars Section -->
    <div class="container mx-auto px-4 mt-10">
        <h1 class="text-3xl font-bold mb-4">გაფილტრული მანქანები <a class="text-lg text-blue-500 underline"
                href="{{ route('cars') }}">ყველა მანქანა</a></h1>
        <div class="grid grid-cols-1 gap-4">
            @foreach (session('cars') as $car)
                <a href="{{ route('cars.show', $car->id) }}"><x-card :car="$car" /></a>
            @endforeach
        </div>
    </div>

@endsection
