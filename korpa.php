<?php
    include "pages/header.php";
    include "pages/nav.php";
?>
<div class="container korp">
<div id="korpica">
</div>
<?php
                    if(isset($_SESSION['korisnik'])):
                ?>
<div  style='display:flex;align-item:center;flex-direction:center;'><p><input type="button" class='btn' value="Kupi" id="kupiDugme"/></p></div>
<?php endif ?>
<?php
if(!isset($_SESSION['korisnik'])):
                ?>
<div  style='display:flex;align-item:center;flex-direction:center;'><p><b>Morate se prijaviti da bi izvrsili kupovinu</b></p></div>
<?php endif ?>

</div>
<?php 
  include "pages/footer.php"
?>