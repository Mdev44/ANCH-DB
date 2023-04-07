@extends('layouts/default')
@section('page-content')
    <section class="relative min-h-screen flex items-center pt-20 ">      
        <a href="{{ route('home') }}" class="fixed top-20 left-12 bg-gray-800 dark:bg-gray-100 pb-3 p-1 px-6 rounded-3xl text-white dark:text-black font-bold text-4xl">&#8249;</a> 
        <div class="fixed py-4 top-20 right-12 bg-gray-800 dark:bg-gray-100 font-bold p-8 rounded-lg">
            <form>
                <input id="searchbar" class="bg-gray-800 dark:bg-gray-100 text-white dark:text-black" type="text" onkeyup='SearchFuntion()' placeholder=" Search ... ">
            </form>
        </div>
        <div class="container mx-auto min-h-screen">        
            <h3 id="placeForTitle" class="text-5xl font-bold mb-10 text-center">
                <?php $database = $_POST['db']; if ($database == "sea") {$title = "Sea Creatures";} else {$title = ucfirst($database);} echo $title; ?>
            </h3>     
            <div id="placeForData" class="flex flex-wrap h-max">
                
                <?php 
                    function transportData($database) {
                        $db = $database;
                        if ($db == "fish") {
                            $bg ="bg-fish";
                        } 
                        else if ($db == "sea") {
                            $bg ="bg-sea";
                        }
                        else if ($db == "bugs") {
                            $bg ="bg-bugs";
                        }
                        else if ($db == "villagers") {
                            $bg ="";
                        }

                        // Create connection
                        $conn = new mysqli("localhost", "root", "", "acnh");
                        
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        
                        $api_url = 'https://acnhapi.com/v1/'.$db.'';
        
                        // Read JSON file
                        $json_data = file_get_contents($api_url);
                        
                        // Decode JSON data into PHP array
                        $response_data = json_decode($json_data);
                        $ObjIterator = new ArrayIterator($response_data);
                        $total = count((array)$response_data);
                        
                        for ($i = 1; $i < $total+1; $i++) { 
                            
                        $selected = $ObjIterator->current();
        
                        $id = $selected->id;
                        $name = ucfirst($selected->name->{'name-USen'});
                        $imgUrl = $selected->image_uri;             
                        $query = "SELECT * FROM $db WHERE image_uri = '$imgUrl'";
                        $result = $conn->query($query);
                        
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {                              
                                continue;
                            }
                        }
                        
                        if ($db == 'sea') {
                            $description = $selected->{'museum-phrase'};
                            $price = $selected->price;
                            
                            $selected = $ObjIterator->next();
        
                            $sql = "INSERT INTO $db
                                    VALUES (?,?,?,?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sssii", $name, $imgUrl, $description, $price, $id);
                            $stmt->execute();
                        }
                        elseif ($db == 'villagers') {
                            $birthday = $selected->{'birthday-string'};
                            $hobby = $selected->hobby;
                            $gender = $selected->gender;
                            $species = $selected->species;
                            $personality = $selected->personality;
        
                            $selected = $ObjIterator->next();
        
                            $sql = "INSERT INTO $db
                                    VALUES (?,?,?,?,?,?,?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sssssssi", $name, $imgUrl, $birthday, $hobby, $gender, $species, $personality, $id);
                            $stmt->execute();
                        }
                        else {
                            $description = $selected->{'museum-phrase'};
                            $rarity = $selected->availability->{'rarity'};
                            $location = $selected->availability->{'location'};
                            $price = $selected->price;
                            
                            $selected = $ObjIterator->next();
        
                            $sql = "INSERT INTO $db
                                    VALUES (?,?,?,?,?,?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sssssii", $name, $imgUrl, $description, $rarity, $location, $price, $id);
                            $stmt->execute();
                        }  
                        }
                        
                        $sql = "SELECT * FROM $db"; 
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                 echo '<form id="form" class="w-full sm:w-1/4 py-3 px-6 text-center" method="post" action="/details">' .  csrf_field()  . '' .      
                                        '<button type="submit" name="action">' .
                                        '<input type="hidden" name="db" value="' . $db . '">' .
                                        '<input type="hidden" name="id" value="' . $row["id"] . '">' .
                                            '<div class="'. $bg . ' p-4 h-full rounded-lg">' .
                                                '<h3 class="text-xl font-bold mb-3">' . $row["name"] . '</h3>' .
                                                '<div class="flex justify-center mb-3">' .
                                                    '<img src=' . $row["image_uri"] . '>' .
                                                '</div>' .
                                            '</div>' .
                                    '</button>' .
                                '</form>';
                            }
                        }else {
                            echo "0 results";
                        }
                        $conn->close();
                    }

                    
                    transportData($database);
                ?>             
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
    </script>
@endsection