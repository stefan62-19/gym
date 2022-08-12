<?php
    //session_start();
    include "pages/header.php";
    include "pages/nav.php";
    include "models/function.php";

?>

<br><br>
<div class="col-md-6 footer2 wow bounceInUp" data-wow-delay=".25s" id="contact" style='margin:auto;'>
        <div class="form-box"id="kontakt">
          <h4 style="tact-align:center;">Logovanje</h4>
          <table class="table table-responsive d-table">
            <tr>
              <td colspan="2"><input type="text" class="form-control pl-0" placeholder="EMAIL" id="e-mail" />
                <span id="primerMejl">Treba ovako-primer@gmail.com</span>
              </td>
            </tr>
            <tr>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td colspan="2"><input type="password" class="form-control pl-0" id="loz" placeholder="SIFRA" />
                <span id="primerAdresa"></span>
              </td>
            </tr>
            <tr>
              <td colspan="2"></td>
            </tr>

            <tr>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td colspan="2" class="text-center pl-0"><input type="button" value="Logovanje" id="logovanje" class="btn btn-primary"/></td>
            </tr>
          </table>
         
          <div id="ispis12">

                
          </div>

        </div>
      </div><br><br>

<?php
    include "pages/footer.php";
?>