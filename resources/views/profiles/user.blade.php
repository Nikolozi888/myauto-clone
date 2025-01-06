@extends('components.layout')
@section('title', 'profile')
@section('content')

    <x-header />

    <!-- Main Content -->
    <main class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- User Information Section -->
            <section class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">ინფორმაცია</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block font-medium">სახელი:</label>
                        <p class="text-gray-700">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block font-medium">ელფოსტა:</label>
                        <p class="text-gray-700">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block font-medium">გაწევრიანება:</label>
                        <p class="text-gray-700">{{ $user->created_at->format('j F Y') }}</p>
                    </div>
                    <br>
                    <div>
                        <label class="block text-2xl">ჩემი გასაყიდი ავტომობილები:</label>
                        <div>
                            @foreach ($user->cars as $car)
                                <br>
                                <x-card :car="$car" />
                            @endforeach
                        </div>
                    </div>


                    <br>
                    <br>

                    <div>
                        <label class="flex text-2xl text-blue-500">ჩემი მონიშნულები <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z">
                                </path>
                            </svg>
                            :</label>
                        <div>
                            @foreach ($user->wishlists as $wishlist)
                                <br>
                                <x-card :car="$wishlist->car" />
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>

            <!-- Create Product Section -->
            <section class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">დაამატეთ ავტომობილი გასაყიდად</h2>
                <form action="{{ route('cars.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="author_id" value="{{ auth()->id() }}">

                    <!-- ბრენდის ველი -->
                    <div>
                        <label for="brand_id" class="block font-medium">მარკა</label>
                        <select name="brand_id" id="brand"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">აირჩიეთ მარკა</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- მოდელის ველი -->
                    <div>
                        <label for="model" class="block font-medium">მოდელი</label>
                        <select name="model_id" id="model"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">აირჩიეთ მოდელი</option>
                        </select>
                        @error('model_id')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- სურათის ველი -->
                    <div>
                        <label for="thumbnail" class="block font-medium">სურათი</label>
                        <input type="file" name="thumbnail" id="thumbnail"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        @error('thumbnail')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="uploadfile" for="gFile">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <span class="text-tiny">
                                აირჩიე ყველა ფოტო ერთად
                            </span>
                            <input class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                type="file" id="gFile" name="images[]" accept="image/*" multiple>
                        </label>
                        @error('images.*')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- წელის ველი -->
                    <div>
                        <label for="year" class="block font-medium">წელი</label>
                        <input type="number" id="year" name="year"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="შეიყვანეთ წელი">
                        @error('year')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- აღწერის ველი -->
                    <div>
                        <label for="description" class="block font-medium">აღწერა</label>
                        <input type="text" id="description" name="description"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="შეიყვანეთ აღწერა">
                        @error('description')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ფასის ველები -->
                    <div>
                        <label for="price" class="block font-medium">ფასი</label>
                        <input type="number" id="price" name="price"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="ფასი">
                        @error('price')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- გარბენის ველი -->
                    <div>
                        <label for="mileage" class="block font-medium">გარბენი</label>
                        <input type="number" id="mileage" name="mileage"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="შეიყვანეთ გარბენი">
                        @error('mileage')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- საწვავის ტიპი -->
                    <div>
                        <label for="fuel_type_id" class="block font-medium">საწვავი</label>
                        <select id="fuel_type_id" name="fuel_type_id"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="" selected disabled>აირჩიეთ საწვავი</option>
                            @foreach (\App\Models\FuelType::all() as $fuel)
                                <option value="{{ $fuel->id }}">{{ ucfirst($fuel->name) }}</option>
                            @endforeach
                        </select>
                        @error('fuel_type_id')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- გადაცემათა კოლოფი -->
                    <div>
                        <label for="gearbox_id" class="block font-medium">გადაცემათა კოლოფი</label>
                        <select id="gearbox_id" name="gearbox_id"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="" selected disabled>აირჩიეთ კოლოფი</option>
                            @foreach (\App\Models\Gearbox::all() as $gearbox)
                                <option value="{{ $gearbox->id }}">{{ ucfirst($gearbox->name) }}</option>
                            @endforeach
                        </select>
                        @error('gearbox_id')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ტიპი -->
                    <div>
                        <label for="body_type_id" class="block font-medium">ტიპი</label>
                        <select id="body_type_id" name="body_type_id"
                            class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="" selected disabled>აირჩიეთ ტიპი</option>
                            @foreach (\App\Models\BodyType::all() as $body_type)
                                <option value="{{ $body_type->id }}">{{ ucfirst($body_type->name) }}</option>
                            @endforeach
                        </select>
                        @error('body_type_id')
                            <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- გაგზავნის ღილაკი -->
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        დამატება
                    </button>
                </form>

            </section>

        </div>
    </main>
@endsection
