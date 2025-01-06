@extends('components.layout')
@section('title', 'Home')
@section('content')

    <x-header />

    <h1 class="text-3xl font-bold mb-4 ml-20 mt-20">ყველა მანქანა</h1>
    <div class="container mx-auto px-4 mt-10 flex space-x-4">
        <!-- Sidebar Filters -->
        <div class="w-1/4 bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">ფილტრები</h2>
            <form action="{{ route('index') }}" method="GET" id="filterForm">
                <!-- Hidden Input -->
                <input type="hidden" name="author" id="author">

                <!-- Brand Selection -->
                <div class="mb-4">
                    <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">მარკა</label>
                    <select name="brand" id="brand" class="w-full border-gray-300 rounded p-2">
                        <option value="">აირჩიეთ მარკა</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ session('search_params.brand') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Model Selection -->
                <div class="mb-4">
                    <label for="model" class="block text-sm font-medium text-gray-700 mb-2">მოდელი</label>
                    <select name="model" id="model" class="w-full border-gray-300 rounded p-2">
                        <option value="">აირჩიეთ მოდელი</option>
                        <!-- Dynamic Models Loaded via JavaScript or Server-Side -->
                    </select>
                </div>

                <!-- Mileage Input -->
                <div class="mb-4">
                    <label for="mileage" class="block text-sm font-medium text-gray-700 mb-2">გარბენი</label>
                    <input type="number" name="mileage" id="mileage" value="{{ session('search_params.mileage') }}"
                        class="w-full border-gray-300 rounded p-2" placeholder="გარბენი">
                </div>

                <!-- Fuel Type Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">საწვავი</label>
                    <div class="flex flex-wrap">
                        @foreach (\App\Models\FuelType::all() as $fuel)
                            <label class="mr-4 mb-2 flex items-center">
                                <input type="checkbox" name="fuel_type[]" value="{{ $fuel->id }}"
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-gray-700">{{ ucfirst($fuel->name) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Gearbox Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">გადაცემათა კოლოფი</label>
                    <div class="flex flex-wrap">
                        @foreach (\App\Models\Gearbox::all() as $gearbox)
                            <label class="mr-4 mb-2 flex items-center">
                                <input type="checkbox" name="gearbox[]" value="{{ $gearbox->id }}"
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-gray-700">{{ ucfirst($gearbox->name) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Body Type Selection -->
                <div class="mb-4">
                    <label for="body_type" class="block text-sm font-medium text-gray-700 mb-2">ტიპი</label>
                    <select name="body_type" id="body_type" class="w-full border-gray-300 rounded p-2">
                        <option value="">ყველა</option>
                        @foreach (\App\Models\BodyType::all() as $body_type)
                            <option value="{{ $body_type->id }}"
                                {{ session('search_params.body_type') ? 'selected' : '' }}>
                                {{ ucfirst($body_type->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Year Range Inputs -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">წელი</label>
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <input type="number" name="year_min" id="year_min"
                                value="{{ session('search_params.year_min') }}" class="w-full border-gray-300 rounded p-2"
                                placeholder="დან">
                        </div>
                        <div class="w-1/2">
                            <input type="number" name="year_max" id="year_max"
                                value="{{ session('search_params.year_max') }}" class="w-full border-gray-300 rounded p-2"
                                placeholder="მდე">
                        </div>
                    </div>
                </div>

                <!-- Price Range Inputs -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">ფასი</label>
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <input type="number" name="price_min" id="price_min"
                                value="{{ session('search_params.price_min') }}" class="w-full border-gray-300 rounded p-2"
                                placeholder="მინ. ფასი">
                        </div>
                        <div class="w-1/2">
                            <input type="number" name="price_max" id="price_max"
                                value="{{ session('search_params.price_max') }}" class="w-full border-gray-300 rounded p-2"
                                placeholder="მაქს. ფასი">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded w-full">
                    გაფილტვრა
                </button>
            </form>
        </div>

        <!-- Cars Section -->
        <div class="w-3/4">
            <div class="grid grid-cols-1 gap-4">
                @if (session('cars'))
                    @foreach (session('cars') as $car)
                        <a href="{{ route('cars.show', $car->id) }}"><x-card :car="$car" /></a>
                    @endforeach
                @else
                    @foreach ($cars as $car)
                        <a href="{{ route('cars.show', $car->id) }}"><x-card :car="$car" /></a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
