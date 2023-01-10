@extends('layouts/default')
@section('page-content')
    <section class="relative min-h-screen flex items-center pt-20 ">
        <div class="fixed py-4 top-20 right-12 bg-gray-800 dark:bg-gray-100 font-bold p-8 rounded-lg">
            <form>
                <input id="searchbar" class="bg-gray-800 dark:bg-gray-100 text-white dark:text-black" type="text" onkeyup='SearchFuntion()' placeholder=" Search ... ">
            </form>
        </div>
        <div class="container mx-auto min-h-screen">        
            <h3 id="placeForTitle" class="text-5xl font-bold mb-10 text-center">PlaceForTitle</h3>     
            <div id="placeForData" data-value= <?php echo $_POST['db']; ?> class="flex flex-wrap h-max">
                Data loading
            </div>
        </div>
    </section>

    <script>
        function SearchFuntion() {
		    var input, filter, table, tr, td, i, txtValue;
		    input = document.getElementById("searchbar");
		    filter = input.value.toUpperCase();
		    table = document.getElementById("placeForData");
		     tr = table.getElementsByTagName("form");

		    // Loop through all table rows, and hide those who don't match the search query
		    for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("h3")[0];
			    if (td) {
			        txtValue = td.textContent || td.innerText;
			        if (txtValue.toUpperCase().indexOf(filter) > -1) {
				        tr[i].style.display = "";
			        } else {
				        tr[i].style.display = "none";
			        }
			    }
		    }
		}
        
        async function retrieveData() {
            const database = document.getElementById("placeForData").getAttribute('data-value');
            if (database === "sea") {
                document.getElementById("placeForTitle").innerHTML = "Sea Creatures";
            }
            else {
                const word = database;
                const firstLetter = word.charAt(0);
                const remainingLetters = word.slice(1);
                const name = firstLetter.toUpperCase() + remainingLetters;
                document.getElementById("placeForTitle").innerHTML = name;
            }
            const html_data = document.getElementById("placeForData");
            var snippetData = "";
            
            const response = await fetch("http://acnhapi.com/v1/" + database);
            const json = await response.json();
            const jsonString = JSON.stringify(json);
            const parsedJson = JSON.parse(jsonString);
            const count = Object.keys(parsedJson).length;
                       
            for (let i = 1; i <= count ; i++) {
                const response = await fetch("http://acnhapi.com/v1/" + database + "/" + i);
                const data = await response.json();            
                var dataString = JSON.stringify(data);
                var parsedData = JSON.parse(dataString);

                const word = parsedData['name']['name-USen'];
                const firstLetter = word.charAt(0);
                const remainingLetters = word.slice(1);
                const name = firstLetter.toUpperCase() + remainingLetters;

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
                    var bg ="";
                }

                snippetData = snippetData + '<form id="form" class="w-full sm:w-1/4 py-3 px-6 text-center" method="post" action="/details"> @csrf ' +      
                                                '<button type="submit" name="action">' +
                                                    '<input type="hidden" name="db" value="' + database + '">' +
                                                    '<input type="hidden" name="id" value="' + i + '">' +
                                                        '<div class="'+ bg + ' p-4 h-full rounded-lg">' +
                                                            '<h3 class="text-xl font-bold mb-3">' + name + '</h3>' +
                                                            '<div class="flex justify-center mb-3">' +
                                                                '<img src=' + parsedData["image_uri"] + '>' +
                                                            '</div>' +
                                                        '</div>' +
                                                '</button>' +
                                            '</form>';            
            }
            html_data.innerHTML = snippetData;
        };
    </script>
@endsection