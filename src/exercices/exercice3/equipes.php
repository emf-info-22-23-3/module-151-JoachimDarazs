<!doctype html>
<html>
  <header>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css" />
</header>
  <body>
    <div id="conteneur">
      <h1>Les équipes de National League</h1>    
      <table border= "1">
      <tr>
        <td>ID</td>
        <td>Club</td>
      </tr>
      <?php
        require('ctrl.php');
       
        function ajouteCelluleHtml($id, $equipe){
          echo '<tr><td>'.$id.'</td><td>'.$equipe.'</td></tr>';

        }
        $equipes = getEquipes();
        $compteur = 1;
        foreach($equipes as $item) {
          ajouteCelluleHtml($compteur, $item);
          $compteur++;
        }
      ?>
      </table>
    </div>
  </body>
</html>