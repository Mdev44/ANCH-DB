@extends('layouts/default')
@section('page-content')
    <section class="py-20 min-h-screen flex items-center">
        <div class="max-w-screen-lg mx-auto">
            <h2 class="text-6xl text-center mb-6">About</h2>
            <h3 class="text-4xl text-center mb-6"> Animal Crossing: New Horizons</h3>
            <p class="mb-3">
                Animal Crossing: New Horizons is a real-time social simulation video game developed by Nintendo. It was released on March 20, 2020, and is the eighth (and so far the newest) main-series game in the Animal Crossing series, after New Leaf. The story starts with the player living on a deserted island as part of Nook Inc. Getaway Package.
            </p>
            <p class="mb-3">
                Compared to previous installments, New Horizons aesthetics are even more detailed, with more realistic flora, detailed characters, intricate furniture, and weather patterns.            </p>
            <div class="mb-6">
                New Horizons also introduces new features and mechanics, such as pole-vaulting over the river, cliff construction, waterscaping, and the introduction of crafting materials into the main series games, which had previously only been seen in Pocket Camp.            </div>
            <div class="text-center">
            <a href="{{ route('home') }}" rel="noopener noreferrer" class="inline-block bg-sky-blue-crayola text-center py-2 px-4 rounded hover:bg-blue-500 transition">Go Home</a>
            </div>
        </div>
    </section>
@endsection