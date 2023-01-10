@extends('layouts/default')
@section('page-content')
    <section class="relative min-h-screen flex items-center pt-20">
        <div class="container mx-auto">
            <h3 id="placeForTitle" class="text-5xl font-bold mb-10 text-center">PlaceForTitle</h3>
            <div id="placeForData" data-value-db=<?php echo $_POST['db']; ?> data-value-id= <?php echo $_POST['id']; ?> class="flex flex-wrap">
                Data loading
            </div>
        </div>
    </section>

    <script>
        async function retrieveData() {
            const database = document.getElementById("placeForData").getAttribute('data-value-db');
            const id = document.getElementById("placeForData").getAttribute('data-value-id');
            
            const response = await fetch("http://acnhapi.com/v1/" + database + "/" + id);
            const data = await response.json();            
            var dataString = JSON.stringify(data);
            var parsedData = JSON.parse(dataString);
            
            const word = parsedData['name']['name-USen'];
            const firstLetter = word.charAt(0);
            const remainingLetters = word.slice(1);
            const name = firstLetter.toUpperCase() + remainingLetters;
            document.getElementById("placeForTitle").innerHTML = name;
            
            if (database === "fish") {
                var bg ="bg-fish";
            } 
            else if (database === "sea") {
                var bg ="bg-sea";
            }
            else if (database === "bugs") {
                var bg ="bg-bugs";
            }
            else if (database === "villagers") {
                var bg ="bg-villagers";
            }

            if (database === "villagers") {
                var detail_1 = "It's birthday is " + parsedData['birthday-string'] + ". And it's hobby is " + parsedData['hobby'];
                var detail_2 = "Gender: " + parsedData['gender'];
                var detail_3 = "Species: " + parsedData['species'];
                var detail_4 = "Personality: " + parsedData['personality'];
            }
            else {
                var detail_1 = parsedData['museum-phrase'];
                var detail_2 = "Rarity: " + parsedData['availability']['rarity'];
                var detail_3 = "Location: " + parsedData['availability']['location'];
                var detail_4 = "Price: " + parsedData['price'];
            }

            fullData =  "<div class='w-full sm:w-1/3 mb-3 px-6 text-center'>" +
                            "<div class='p-4 h-full rounded-lg'>" +
                                "<div class='flex justify-center mb-3'>" +
                                    "<img src=" + parsedData['image_uri'] + ">" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                        "<div class='w-full sm:w-1/3 mb-3 px-6 text-center'>" +
                            "<div class='p-4 h-full rounded-lg'>" +       
                                "<h5>" + detail_1 + "</h5>" +  
                            "</div>" +
                        "</div>" +
                        "<div class='w-full sm:w-1/3 mb-3 px-6 text-center'>" +
                            "<div class='"+ bg + " p-4 h-full rounded-lg font-bold'>" +                            
                                "<h2 class='text-3xl mb-3'> Details </h2>" +
                                "<ul class='list-none mb-3 text-xl'>" +
                                    "<li><h4>"+ detail_2 + " </h4></li>" +    
                                    "<li><h4>"+ detail_3 + " </h4></li>" +
                                    "<li><h4>"+ detail_4 + " </h4></li>" +
                                "</ul>" +
                            "</div>" +
                        "</div>";    
            
            document.getElementById("placeForData").innerHTML = fullData;
        };
    </script>
@endsection