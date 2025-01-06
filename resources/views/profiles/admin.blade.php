@extends('components.layout')
@section('content')
    <x-header />

    <div class="max-w-7xl mx-auto p-6 mt-6 bg-white shadow-md rounded-lg">
        <h3 class="text-xl font-semibold text-gray-800">ინფორმაცია</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <p class="font-medium text-gray-700">სახელი:</p>
                <p class="text-gray-600">{{ $admin->name }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-700">ელფოსტა:</p>
                <p class="text-gray-600">{{ $admin->email }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-700">სტატუსი:</p>
                <p class="text-gray-600">{{ $admin->role }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-700">გაწევრიანება:</p>
                <p class="text-gray-600">{{ $admin->created_at->format('j F Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Admin Actions -->
    <div class="max-w-7xl mx-auto p-6 mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Create Brand -->
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-xl font-semibold text-gray-800">დაამატე ბრენდი</h3>
            <form action="{{ route('admin.brand.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="text" id="brand-name" name="name" class="w-full p-2 border border-gray-300 rounded-md"
                    required>
                <button type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">შექმენი</button>
            </form>

            <div class="mt-6">
                <p class="font-medium text-gray-700">ბრენდები:</p>
                <ul class="mt-2">
                    @foreach (\App\Models\Brand::all() as $brand)
                    <form action="{{ route('admin.brand.delete',$brand->id) }}" method="POST">
                        @csrf
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $brand->name }}</span>
                            <button class="text-red-600 hover:text-red-800">Delete</button>
                        </li>
                    </form>
                    @endforeach
                </ul>
            </div>

        </div>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-xl font-semibold text-gray-800">დაამატე მოდელი</h3>
            <form action="{{ route('admin.model.store') }}" method="POST" class="mt-4">
                @csrf
                <select name="brand_id" id="brand_id" class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="" selected disabled>აირჩიე ბრენდი</option>
                    @foreach (\App\Models\Brand::all() as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <input type="text" id="model-name" name="name" class="w-full p-2 border border-gray-300 rounded-md mt-3"
                    required>
                <button type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">შექმენი</button>
            </form>

            <div class="mt-6">
                <p class="font-medium text-gray-700">მოდელები:</p>
                <ul class="mt-2">
                    @foreach (\App\Models\Models::all() as $model)
                    <form action="{{ route('admin.model.delete',$model->id) }}" method="POST">
                        @csrf
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $model->name }}</span>
                            <button class="text-red-600 hover:text-red-800">Delete</button>
                        </li>
                    </form>
                    @endforeach
                </ul>
            </div>

        </div>

        <!-- Create Fuel Type -->
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-xl font-semibold text-gray-800">დაამატე საწვავის ტიპი</h3>
            <form action="{{ route('admin.fuelType.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="text" id="fuel-type" name="name" class="w-full p-2 border border-gray-300 rounded-md"
                    required>
                <button type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">შექმენი</button>
            </form>
            <div class="mt-6">
                <p class="font-medium text-gray-700">საწვავის ტიპები:</p>
                <ul class="mt-2">
                    @foreach (\App\Models\FuelType::all() as $fuel)
                    <form action="{{ route('admin.fuelType.delete',$fuel->id) }}" method="POST">
                        @csrf
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $fuel->name }}</span>
                            <button class="text-red-600 hover:text-red-800">წაშლა</button>
                        </li>
                    </form>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Create Gearbox Type -->
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-xl font-semibold text-gray-800">დაამატე გადაცემათა კოლოფის ტიპი</h3>
            <form action="{{ route('admin.gearbox.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="text" id="gearbox-type" name="name" class="w-full p-2 border border-gray-300 rounded-md"
                    required>
                <button type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">შექმენი</button>
            </form>
            <div class="mt-6">
                <p class="font-medium text-gray-700">გადაცემათა კოლოფის ტიპები:</p>
                <ul class="mt-2">
                    @foreach (\App\Models\Gearbox::all() as $gearbox)
                    <form action="{{ route('admin.gearbox.delete',$gearbox->id) }}" method="POST">
                        @csrf
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $gearbox->name }}</span>
                            <button class="text-red-600 hover:text-red-800">წაშლა</button>
                        </li>
                    </form>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Create Body Type -->
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-xl font-semibold text-gray-800">დაამატე მანქანის ტიპი</h3>
            <form action="{{ route('admin.bodyType.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="text" id="body-type" name="name" class="w-full p-2 border border-gray-300 rounded-md"
                    required>
                <button type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">შექმენი</button>
            </form>
            <div class="mt-6">
                <p class="font-medium text-gray-700">მანქანის ტიპები:</p>
                <ul class="mt-2">
                    @foreach (\App\Models\BodyType::all() as $type)
                        <form action="{{ route('admin.bodyType.delete',$type->id) }}" method="POST">
                            @csrf
                            <li class="flex justify-between items-center">
                                <span class="text-gray-600">{{ $type->name }}</span>
                                <button class="text-red-600 hover:text-red-800">წაშლა</button>
                            </li>
                        </form>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

@endsection
