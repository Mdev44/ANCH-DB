<!DOCTYPE html>
<html id="site" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>ACNH DB</title>  
</head>
<body onload="checkDarkMode();retrieveData();" class="bg-gray-100 text-black dark:bg-gray-800 dark:text-white">
        <header class="fixed bg-forest-green-crayola top-0 left-0 right-0 z-50">
            <div class="container mx-auto flex justify-between p-4">
                <h1 class="text-xl font-bold text-white"> ACNH-DB  </h1>              
                <nav class="-mx-2">
                    <a href="{{ route('home') }}" class="text-lg mx-2 text-white hover:text-pink-500 transition">Home</a>
                    <a href="{{ route('about') }}" class="text-lg mx-2 text-white hover:text-pink-500 transition">About</a>
                </nav>
            </div>   
        </header>    
        
        <main>
            @yield('page-content')
        </main>
        
        <footer>
            <div class="container mx-auto p-4">
                <p> &copy; Morris de Vries | ACNH-DB </p>
            </div>
            
            <div class="fixed bottom-5 right-10 z-50">
                <div x-data="{'darkMode': false}" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode')); $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))">
                    <div :class="{'dark': darkMode === true}">
                        <div class="container rounded-xl bg-gray-800 dark:bg-gray-100">
                            <div class="flex items-center justify-center pl-2 pr-2 pb-2 pt-2 space-x-2">
                                <span class="text-sm text-gray-100 dark:text-gray-400">Light</span>
                                <label for="toggle"class="flex items-center h-5 p-1 duration-300 ease-in-out bg-gray-300 rounded-full cursor-pointer w-9 dark:bg-gray-600">
                                    <div
                                        class="w-4 h-4 duration-300 ease-in-out transform bg-white rounded-full shadow-md toggle-dot dark:translate-x-3">
                                    </div>
                                </label>
                                <span class="text-sm text-gray-500 dark:text-black">Dark</span>
                                <input onclick="darkToggle()" id="toggle" type="checkbox" class="hidden" :value="darkMode" @change="darkMode = !darkMode" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </footer>

        <script>
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

        </script>

</body>
</html>