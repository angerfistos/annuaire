<?php 
session_start();
include('./partials/header.php'); 
require('admin/admin-requestSQL.php'); 

$title = "Page d'Accueil - PhoneBook";

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    echo "<script>
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 5000);
    </script>";
}

if (!isset($_SESSION['utilisateurID'])) {
    header('Location: pconnexion.php');
    exit();
}
?>

<div class="p-8 rounded-md w-full">
    <div class="flex items-center justify-between pb-6 flex-wrap">
        <h2 class="mt-4 text-xl text-blue-800">Bonjour 
            <?php 
            if (!empty($_SESSION['prenom']) && !empty($_SESSION['nom'])) {
                echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
            } elseif (!empty($_SESSION['prenom'])) {
                echo $_SESSION['prenom'];
            } elseif (!empty($_SESSION['username'])) {
                echo $_SESSION['username'];
            } else {
                echo "Invité";
            }
            ?>, voici votre liste de contact.</h2>
        <div class="flex gap-4 block mt-4 flex-wrap">
            <a href="paddContact.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Ajouter un Contact</a>
            <form action="./admin/admin-importContact.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="userId" value="<?php echo $_SESSION['utilisateurID']; ?>" />
                <button type="button" onclick="document.getElementById('fileInput').click()" class="bg-green-500 text-white font-bold py-2 px-4 rounded-full">Importer CSV</button>
                <input type="file" id="fileInput" name="file" class="hidden" accept=".csv" onchange="this.form.submit()" />
            </form>
            <a href="./admin/admin-logout.php" class="bg-red-500 text-white font-bold py-2 px-4 rounded-full w-max">Se déconnecter</a>
        </div>
    </div>
</div>

<div>
    <div class="grid grid-cols-1 gap-4">
        <?php
 if (isset($_SESSION['utilisateurID'])) {
    $contacts = getContacts($_SESSION['utilisateurID']);
    if (!empty($contacts)) {
        foreach ($contacts as $contact) {
            echo "<div class='clic bg-[#D6D6D6] p-4 rounded-lg shadow'>";
            echo "<div class='flex justify-between items-center'>";
            echo "<div class='flex items-center'>";
            echo "<h3 class='text-xl text-gray-800 font-bold'>{$contact['nom']}, {$contact['prenom']}</h3>";
            echo "<button><img src='./img/eye.png' class='inline-block eye-icon closed ml-2 w-5 h-5' alt='voir'></button>";
            echo "<button><img src='./img/eye-ferme.svg'class='inline-block eye-icon open ml-2 w-5 h-5 hidden' alt='masqué'></button>";
            echo "</div>";
            echo "</div>";
            echo "<div class='contact-details space-y-1 hidden mt-3'>";
            echo "<p><span class='font-semibold'>Email:</span> {$contact['email']}</p>";
            echo "<p><span class='font-semibold'>Téléphone:</span> {$contact['telephone']}</p>";
            echo "<p><span class='font-semibold'>Adresse:</span> {$contact['adresse']}</p>";
            echo "<p><span class='font-semibold'>Entreprise:</span> {$contact['entreprise']}</p>";
            echo "<p><span class='font-semibold'>Date de naissance:</span> {$contact['dateDeNaissance']}</p>";
            echo "<p><span class='font-semibold'>Note:</span> {$contact['note']}</p>";

            echo "<div class='flex space-x-4'>";
            echo "<a href='peditcontact.php?contactId={$contact['contactId']}' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full'>Modifier</a>";
            echo "<a href='admin/admin-deleteContact.php?contactId={$contact['contactId']}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce contact ?\");' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full'>Supprimer</a>";
            echo "</div>"; 
            echo "</div>";

            echo "</div>"; 
        }
    } else {
        echo "<p>Vous n'avez aucun contact enregistré.</p>";
    }
} else {
    echo "<p>Veuillez vous connecter pour voir vos contacts.</p>";
}
        ?>
    </div>
</div>

<script>
document.querySelectorAll('.clic').forEach(card => {
    card.addEventListener('click', () => {
        let details = card.querySelector('.contact-details');
        let eyeOpenIcon = card.querySelector('.eye-icon.open');
        let eyeClosedIcon = card.querySelector('.eye-icon.closed');

        details.classList.toggle('hidden');
        eyeOpenIcon.classList.toggle('hidden');
        eyeClosedIcon.classList.toggle('hidden');
    });
});
</script>

<?php include('./partials/footer.php'); ?>