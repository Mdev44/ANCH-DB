@extends('layouts/default')

@section('page-content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <section class="relative min-h-screen flex items-center">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl sm:text-7xl pb-2"> Animal Crossing: <span class="text-forest-green-crayola">  New Horizons </span></h2>
            <h3 class="text-2xl sm:text-4xl italic"> Database </h3>
        </div>

        <div class="absolute bottom-0 left-0 right-0 p-20">
            <p class="text-center">Scroll to learn more</p>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-screen-md mx-auto">
            <h3 class="text-4xl font-bold mb-6">Introduction</h3>
            <h4 class="text-2xl mb-3 font-semi-bold">What is it?</h4>
            <p class=" text-xl mb-6">
            Animal Crossing: New Horizons is a real-time social simulation video game developed by Nintendo. It was released on March 20, 2020, and is the eighth (and so far the newest) main-series game in the Animal Crossing series, after New Leaf. The story starts with the player living on a deserted island as part of Nook Inc. Getaway Package.
            </p>
            <a href="{{ route('about') }}" class="text-xl bg-sky-blue-crayola text-center py-2 px-4 rounded hover:bg-blue-500 transition">Learn more</a>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-screen-md mx-auto">
            <h3 class="text-4xl font-bold mb-6">The database</h3>
            <h3 class="text-xl mb-6">This is a simple database, to get more insights in all animal crossing atributes. It is made for a code review.</h4>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-screen-md mx-auto">
            <h3 class="text-4xl font-bold mb-6"> What can I find?</h3>
            <div class="flex flex-wrap -mx-2">
                <div class="w-full sm:w-1/2 mb-3 px-2">
                    <div class="p-4 bg-fish h-full rounded-lg">
                        <h3 class="text-xl font-bold mb-3">Fish</h3>
                        <p class="mb-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure praesentium velit sequi voluptate molestiae. Tempora unde voluptatem eius ea doloribus aut eligendi repudiandae corporis iusto. Velit facere alias sint cum repellat officiis, consequuntur earum facilis.   
                        </p>
                        <form method="post" action="/overview">
                            @csrf
                            <button class="bg-paradise-pink text-center py-2 px-4 rounded hover:bg-pink-500 transition" type='submit' name='action'><input type='hidden' name='db' value="fish"> See now!</button>
                        </form>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 mb-3 px-2">
                    <div class="p-4 bg-sea h-full rounded-lg">
                        <h3 class="text-xl font-bold mb-3">Sea Creatures</h3>
                        <p class="mb-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt fuga nostrum aliquid totam culpa, minima sunt asperiores accusamus dolore quae amet qui dolorem ducimus quas iure fugiat. Amet magni delectus quia? Ullam sapiente placeat ducimus!
                        </p>
                        <form method="post" action="/overview">
                            @csrf
                            <button class="bg-paradise-pink text-center py-2 px-4 rounded hover:bg-pink-500 transition" type='submit' name='action'><input type='hidden' name='db' value="sea"> See now!</button>
                        </form>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 mb-3 px-2">
                    <div class="p-4 bg-bugs h-full rounded-lg">
                        <h3 class="text-xl font-bold mb-3">Bugs</h3>
                        <p class="mb-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt fuga nostrum aliquid totam culpa, minima sunt asperiores accusamus dolore quae amet qui dolorem ducimus quas iure fugiat. Amet magni delectus quia? Ullam sapiente placeat ducimus!
                        </p>
                        <form method="post" action="/overview">
                            @csrf
                            <button class="bg-paradise-pink text-center py-2 px-4 rounded hover:bg-pink-500 transition" type='submit' name='action'><input type='hidden' name='db' value="bugs"> See now!</button>
                        </form>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 mb-3 px-2">
                    <div class="p-4 h-full rounded-lg">
                        <h3 class="text-xl font-bold mb-3">Villagers</h3>
                        <p class="mb-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt fuga nostrum aliquid totam culpa, minima sunt asperiores accusamus dolore quae amet qui dolorem ducimus quas iure fugiat. Amet magni delectus quia? Ullam sapiente placeat ducimus!
                        </p>
                        <form method="post" action="/overview">
                            @csrf
                            <button class="bg-paradise-pink text-center py-2 px-4 rounded hover:bg-pink-500 transition" type='submit' name='action'><input type='hidden' name='db' value="villagers"> See now!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection