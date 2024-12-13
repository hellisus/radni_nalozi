   <!-- Topbar  -->
   <nav class="navbar">
       <div class="flex">

           <button type="button" id="sidebarCollapse" class="shadow bg-blue-500 hover:bg-stone-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
               <span>Prikaži/sakri meni</span>
           </button>

           <div class="px-5 flex items-center text-justify">
               <p class="nav-link text-black select-none text-justify"><i class="fa-solid fa-user"></i> Ulogovan :
                   <?php echo (isset($_SESSION['Ime']) ? $_SESSION['Ime'] : "Neregistrovani korisnik"); ?> </p>
           </div>

           <div class="px-5 flex items-center text-justify">
               <a id="time" class="nav-link" href="#">
                   <script>
                       (function() {
                           function checkTime(i) {
                               return i < 10 ? '0' + i : i;
                           }

                           function startTime() {
                               var today = new Date(),
                                   h = checkTime(today.getHours()),
                                   m = checkTime(today.getMinutes());
                               document.getElementById('time').innerHTML =
                                   '<i class="far fa-clock"></i> ' + h + ':' + m;
                               t = setTimeout(function() {
                                   startTime();
                               }, 500);
                           }
                           startTime();
                       })();
                   </script>
               </a>
           </div>

       </div>
   </nav>