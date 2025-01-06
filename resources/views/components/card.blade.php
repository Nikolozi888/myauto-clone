<div class="bg-white p-4 rounded shadow flex items-center space-x-4">
    <img src="{{ asset('storage/' . $car->thumbnail) }}" alt="Car Image" class="w-1/6 rounded-xl">
    <div class="flex-1">
        <h3 class="text-xl font-semibold mb-7">{{ $car->brand->name }} {{ $car->model->name }}</h3>
        <p class="text-lg text-gray-500">{{ $car->year }} | {{ $car->mileage }} km</p>
        <p class="text-lg text-gray-500">{{ $car->Gearbox->name }} | {{ $car->FuelType->name }}</p>
    </div>
    <div>
        <p class="font-semibold text-3xl">${{ $car->price }}</p>
        <p class="text-xs text-gray-400">{{ $car->created_at->diffForHumans() }}</p>
    </div>
    @if (\App\Models\Wishlist::where('car_id', $car->id)->exists())
        <form action="{{ route('wishlist.destroy', $car->id) }}" method="POST">
            @csrf
            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                    height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z">
                    </path>
                </svg>
            </button>
        </form>
    @else
        <form action="{{ route('wishlist.store') }}" method="POST">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <input type="hidden" name="thumbnail" value="{{ $car->thumbnail }}">
            <input type="hidden" name="brand" value="{{ $car->brand->name }}">
            <input type="hidden" name="model" value="{{ $car->model->name }}">
            <input type="hidden" name="user_id" value="{{ $car->author->id }}">
            <input type="hidden" name="year" value="{{ $car->year }}">
            <input type="hidden" name="price" value="{{ $car->price }}">
            <button class="pc__btn-wl top-0 end-0 bg-transparent border-0 js-add-wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z">
                    </path>
                </svg>


            </button>
        </form>
    @endif
</div>
