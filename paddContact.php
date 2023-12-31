<?php 
session_start();
include('./partials/header.php'); 
$title = "Ajouter un Contact - PhoneBook";
require('admin/admin-requestSQL.php');  

if (!empty($_SESSION['message'])) {
    echo '<div class="alert">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Effacer le message après affichage
}
?>

<script>
    setTimeout(function() {
        var alertElement = document.querySelector('.alert');
        if (alertElement) {
            alertElement.style.display = 'none';
        }
    }, 5000);
</script>


<div class="mx-auto md:w-max w-full h-full mt-8">
    <div class="w-full mt-8">
        <h1 class="text-center text-2xl text-[#3B5998] font-bold mb-8">Ajouter un Contact</h1>
        <form class="rounded pb-8" action="admin/admin-addcontact.php" method="post">
            <!-- Nom -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="nom">Nom<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="nom" type="text" placeholder="Nom">
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="prenom">Prénom<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="prenom" type="text" placeholder="Prénom">
            </div>

            <!-- E-mail -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="email">E-mail</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="email" type="email" placeholder="E-mail">
            </div>

            <!-- Date de naissance -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="dateDeNaissance">Date de naissance</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="dateDeNaissance" type="date">
            </div>

            <!-- Adresse -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="adresse">Adresse</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="adresse" type="text" placeholder="Adresse">
            </div>

            <!-- Entreprise -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="entreprise">Entreprise</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="entreprise" type="text" placeholder="Entreprise">
            </div>

            <!-- Téléphone -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="telephone">Téléphone<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="telephone" type="tel" placeholder="Téléphone">
            </div>

            <!-- Note -->
            <div class="mb-6">
                <label class="block text-[#3B5998] text-sm mb-2" for="note">Note</label>
                <textarea class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="note" placeholder="Note"></textarea>
            </div>

            <!-- Boutons 'Annuler' et 'Sauvegarder' -->
            <div class="flex flex-wrap justify-between gap-4 mx-auto mt-4">
                <a class="bg-gray-400 text-white text-sm md:text-base font-bold py-2 px-4 rounded-full block" href="index.php">Annuler</a>
                <button class="bg-[#3B5998] text-white font-bold py-2 px-4 rounded-full" name="btnAjouterContact" type="submit">Sauvegarder</button>
            </div>
        </form>
    </div>
</div>

<?php include('./partials/footer.php');?>