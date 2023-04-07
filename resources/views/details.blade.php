@extends('layouts/default')
@section('page-content')
    <section class="relative min-h-screen flex items-center pt-20">
    <form id="form" method="post" action="/overview"> @csrf    
        <input type='hidden' name='db' value=<?php echo $_POST['db']; ?>>    
        <button type="submit" name="action" class="fixed top-20 left-12 bg-gray-800 dark:bg-gray-100 pb-3 p-1 px-6 rounded-3xl text-white dark:text-black font-bold text-4xl">&#8249;</button>
    </form>
        <div class="container mx-auto">            
                <?php 
                    function displayData($database,$id) {
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
                            $bg ="bg-villagers";
                        }

                        // Create connection
                        $conn = new mysqli("localhost", "root", "", "acnh");
                        
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }


                        $sql = "SELECT * FROM $db WHERE id = $id"; 
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<h3 class='text-5xl font-bold mb-10 text-center'>" . $row['name'] . "</h3>" . 
                                "<div class='flex flex-wrap'>";
                                if ($db == "villagers") {
                                    $detail_1 = "It's birthday is " . $row["birthday"] . ". And it's hobby is " . $row["hobby"];
                                    $detail_2 = "Gender: " . $row["gender"];
                                    $detail_3 = "Species: " . $row["species"];
                                    $detail_4 = "Personality: " . $row["personality"];
                                }
                                elseif ($db == "sea") {
                                    $detail_1 = $row["description"];
                                    $detail_2 = "Price: " . $row["price"];
                                    $detail_3 = "";
                                    $detail_4 = "";
                                    
                                }
                                else {
                                    $detail_1 = $row["description"];
                                    $detail_2 = "Rarity: " . $row["rarity"];
                                    $detail_3 = "Location: " . $row["location"];
                                    $detail_4 = "Price: " . $row["price"];
                                } 
                                echo   "<div class='w-full sm:w-1/3 mb-3 px-6 text-center'>" .
                                            "<div class='p-4 h-full rounded-lg'>" .
                                                "<div class='flex justify-center mb-3'>" .
                                                    "<img src=" . $row["image_uri"] . ">" .
                                                "</div>" .
                                            "</div>" .
                                        "</div>" .
                                        "<div class='w-full sm:w-1/3 mb-3 px-6 text-center'>" .
                                            "<div class='p-4 h-full rounded-lg'>" .       
                                                "<h5>" . $detail_1 . "</h5>" .  
                                            "</div>" .
                                        "</div>" .
                                        "<div class='w-full sm:w-1/3 mb-3 px-6 text-center'>" .
                                            "<div class='". $bg . " p-4 h-full rounded-lg font-bold'>" .                            
                                                "<h2 class='text-3xl mb-3'> Details </h2>" .
                                                "<ul class='list-none mb-3 text-xl'>" .
                                                    "<li><h4>". $detail_2 . " </h4></li>" .    
                                                    "<li><h4>". $detail_3 . " </h4></li>" .
                                                    "<li><h4>". $detail_4 . " </h4></li>" .
                                                "</ul>" .
                                            "</div>" .
                                        "</div>";
                            }
                        }else {
                            echo "0 results";
                        }
                        $conn->close();
                    }

                    $database = $_POST['db'];
                    $id = $_POST['id'];
                    displayData($database,$id);
                ?>
            </div>
        </div>
    </section>
@endsection