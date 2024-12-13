<!-- Sidebar  -->
<nav id="sidebar" class="font-sans grid grid-cols-1 grid-rows-1 items-center h-screen justify-items-center">
    <div class="sidebar-header drop-shadow-2xl border-2 border-white rounded-2xl shadow-2xl bg-slate-400 cursor-pointer" onclick="window.location.replace('../php/glavni.php');">
        <img src="../img/img.png" alt="logo" class="max-h-32 cursor-pointer">
        <h4 class="pt-5 font-semibold text-center text-lg">SR NALOZI</h4>
    </div>

    <div>
        <h5 class="<?php if ($_SESSION['tip'] != 1) {
            echo " hidden";
        } ?>">SR NALOG</h5>
        <input type="text" id="pretraga_id" class="text-stone-900 <?php if ($_SESSION['tip'] != 1) {
            echo " hidden";
        } ?>">
    </div>

    <ul class="list-unstyled components <?php if ($_SESSION['tip'] != 1) {
        echo " hidden";
    } ?>">
        <hr>
        <p class=" font-semibold text-lg">Meni</p>


        <hr>


        <li>
            <a href="../php/pretraga_gotovi_input.php">Izveštaj gotovi u periodu
            </a>
        </li>
        <li>
            <a href="../php/pretraga_input.php">Pretraga po adresi
            </a>
        </li>
        <li>
            <a href="../php/ugaseni_pretraga.php">Ugašeni nalozi
            </a>
        </li>


    </ul>
</nav>