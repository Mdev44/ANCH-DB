function checkDarkMode() { 
    if (localStorage.getItem('isDarkMode') === 'true') {
        document.getElementById('site').classList.toggle('dark');
    }
}

function darkToggle() {
    document.getElementById('site').classList.toggle('dark');
    if (localStorage.getItem('isDarkMode') === 'true') {
        localStorage.setItem('isDarkMode', false);
    }
    else {
        localStorage.setItem('isDarkMode', true);
    }               
}

async function retrieveDataDetails() {
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


function SearchFuntion() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchbar");
    filter = input.value.toUpperCase();
    table = document.getElementById("placeForData");
        tr = table.getElementsByTagName("form");

    // Loop through all table rows, and hide those which don't match the search query
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

async function retrieveDataOverview() {
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
