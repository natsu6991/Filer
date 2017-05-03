<?php

$linkDir = 'uploads/upload_of_' . $user['pseudo'];

echo '<div class="table">';
if ($dossier = opendir($linkDir)) {
	while(false !== ($fichier = readdir($dossier)))
	{
		if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
		{
      $path = $linkDir . "/" . $fichier;
      echo '<div class="td"><a download href="' . $linkDir . '/' . $fichier . '"><img class="colorImg" width="30px" src="assets/Download.png"></a>';
			echo '<a href="' . $linkDir . '/' . $fichier . '" target="_blank"><img class="colorImg" width="30px" src="assets/View.png"></a>';
      echo '<a href="?action=delete&path=' . $path . '"><img class="colorImg" width="30px" src="assets/Delete.png"></a><br>';
			echo '<img class="imgFloat" width="100px" src="' . $linkDir . '/' . $fichier . '"></a><br>';
			echo '<p class="nameOfFile">' . $fichier . '</p></div>';
		}
	}
}
echo '</div>';
