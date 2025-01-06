@extends('components.layout')
@section('title', 'დეტალები')
@section('content')


    <x-header />



    <div class="container mx-auto p-4">
        <a href="{{ route('cars') }}" class="text-blue-500 mt-4 inline-block">გაგრძელება</a>
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ $car->brand->name }} {{ $car->model->name }}</h1>
            <div class="mt-4 flex gap-2">
                <div class="flex items-center text-orange-500">
                    <span class="text-xl font-semibold">{{ $car->price }} $</span>
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Contact Seller</button>
            </div>
        </div>

        <br>
        <!-- Image Gallery Section -->
        <div class="flex gap-10">
            <div class="w-4/5 mt-6 bg-white rounded-lg shadow-md p-4 text-center  border border-black-500">
                <!-- მთავარი სურათი -->
                <div class="main-image relative flex justify-center items-center mb-4">
                    <!-- მარცხნივ გადასართავი ღილაკი -->
                    <button id="prev-btn"
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white p-5 rounded-lg"
                        onclick="navigateImage(-1)">&#8249;</button>

                    <img id="main-image" class="w-2/4 rounded-lg border" src="{{ asset('storage/' . $car->thumbnail) }}"
                        alt="Main Image">

                    <!-- მარჯვნივ გადასართავი ღილაკი -->
                    <button id="next-btn"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white p-5 rounded-lg"
                        onclick="navigateImage(1)">&#8250;</button>
                </div>

                <!-- თუმბნეილები -->
                <div class="thumbnails mt-4 flex justify-center gap-2">
                    <img class="thumbnail w-1/6 rounded-lg border cursor-pointer"
                        src="{{ asset('storage/' . $car->thumbnail) }}" alt="Thumb 1" onclick="updateMainImage(this)">

                    @foreach (explode(',', $car->images) as $gim)
                        <img class="thumbnail w-1/6 rounded-lg border cursor-pointer" src="{{ asset('storage/' . $gim) }}"
                            alt="Thumb" onclick="updateMainImage(this)">
                    @endforeach
                </div>
            </div>

            <div class="bg-white w-1/5 rounded-lg shadow-md p-4 border border-black-500">
                <h2 class="text-3xl font-semibold text-gray-700 mt-5 ml-3">{{ $car->price }} $</h2>
                <div class="space-y-4 mt-20">
                    <a href="{{ route('user.cars',$car->author->id) }}" class="bg-green-500 text-white text-xl px-4 py-2 rounded-lg hover:bg-green-600 w-full">{{ $car->author->name }}</a>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 w-full">VIN Check</button>
                </div>
            </div>
        </div>



        <!-- Specifications Section -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Specifications</h2>
                <ul class="space-y-2">
                    <li><strong>ბრენდი:</strong> {{ $car->brand->name }}</li>
                    <li><strong>მოდელი:</strong> {{ $car->model->name }}</li>
                    <li><strong>წელი:</strong> {{ $car->year }}</li>
                    <li><strong>გარბენი:</strong> {{ $car->mileage }} km</li>
                    <li><strong>საწვავის ტიპი:</strong> {{ $car->FuelType->name }}</li>
                    <li><strong>ავტომატიკა:</strong> {{ $car->Gearbox->name }}</li>
                    <li><strong>კუზაოს ტიპი:</strong> {{ $car->BodyType->name }}</li>
                </ul>
            </div>

            <!-- Contact and Verification Section -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">აღწერა</h2>
                <div class="space-y-4">
                    {{ $car->description }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // ვაგროვებთ ყველა სურათს თუმბნეილებიდან
        const images = [
            "{{ asset('storage/' . $car->thumbnail) }}",
            @foreach (explode(',', $car->images) as $gim)
                "{{ asset('storage/' . $gim) }}",
            @endforeach
        ];

        let currentIndex = 0; // მიმდინარე სურათის ინდექსი

        // ფუნქცია, რომელიც განაახლებს მთავარ სურათს
        function updateMainImage(thumbnail) {
            const mainImage = document.getElementById('main-image');
            mainImage.src = thumbnail.src;
            currentIndex = images.indexOf(thumbnail.src); // განახლება ინდექსით
        }

        // ფუნქცია, რომელიც გადართავს სურათებს ღილაკების გამოყენებით
        function navigateImage(direction) {
            currentIndex += direction;
            if (currentIndex < 0) {
                currentIndex = images.length - 1; // უკანასკნელ სურათზე გადართვა
            } else if (currentIndex >= images.length) {
                currentIndex = 0; // პირველ სურათზე გადართვა
            }

            const mainImage = document.getElementById('main-image');
            mainImage.src = images[currentIndex];
        }
    </script>

@endsection
