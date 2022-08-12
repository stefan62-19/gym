
var url=window.location.href;
//Vise teksta na strani onama.html
if(url.indexOf('admin_panel.php')!=-1)
{
  $( "tr:even" ).css( "background-color", "#ffebbb" );
//  $(".btn").focus(function(){
//   $( ".btn" ).css( "background-color", "#bbf" );
//  })

$("td").css("text-align","center");
$("#upisPro").on("click",function(){
  var ime=$("#nazivProizvoda").val();
  var staraCena=$("#staraCena").val();
  var novaCena=$("#novaCena").val();
  var zvezdice=$("#zvezdice").val();
  var opis=$("#opis").val();
  var slikaSrc=$("#slikaSrc").val();
  var slikaAlt=$("#slikaAlt").val();
  var idKat=$("#idKat").val();
  var niz=[];
  if(ime=="")
  {
    niz.push("greska naziv");
  }
  if(staraCena=="")
  {
    niz.push("greska stara cena");
  }
  if(novaCena=="")
  {
    niz.push("greska nova cena");
  }
  if(zvezdice=="")
  {
    niz.push("greska zvezdice");
  }
  if(opis=="")
  {
    niz.push("greska opis");
  }
  if(slikaSrc=="")
  {
    niz.push("greska src");
  }
  if(slikaAlt=="")
  {
    niz.push("greska alt");
  }
  if(idKat=="")
  {
    niz.push("greska id");
  }
  if(niz.length==0)
  {
    data={
      ime:ime,
      staraCena:staraCena,
      novaCena:novaCena,
      zvezdice:zvezdice,
      opis:opis,
      slikaAlt:slikaAlt,
      slikaSrc:slikaSrc,
      idKat:idKat
    }
    ajaxBack("models/upisProizvoda.php", "post", data,  function(result){
    alert(result.odgovor);
  })
  }
  
  
})
$(".btnPorudzbina").on("click",function(){
  console.log($(this).data("id"));
  var idB=$(this).data("id");
  data={
    id:idB
  }
  ajaxBack("models/brisanjePorudzbine.php", "post", data,  function(result){
    alert(result.odgovor);
  })
})
$(".btnProizvod").on("click",function(){
  console.log($(this).data("id"));
  var idB=$(this).data("id");
  data={
    id:idB
  }
  ajaxBack("models/brisanjeProizvoda.php", "post", data,  function(result){
    alert(result.odgovor);
  })
})
$(".btnA").on("click",function(){
  console.log($(this).data("id"));
  var idB=$(this).data("id");
  data={
    id:idB
  }
  ajaxBack("models/brisanjeKorisnika.php", "post", data,  function(result){
    alert(result.odgovor);
  })
})
$(".btnI").on("click",function(){
  console.log($(this).data("id"));
  var idB=$(this).data("id");
  data={
    id:idB
  }
  ajaxBack("models/brisanjeGlasaAnketa.php", "post", data,  function(result){
    alert(result.odgovor);
  })
})
}
if(url.indexOf('kontaktSaAdminom.php')!=-1)
{

  $("#adminSub").on("click",function(){
    var podat=$("#textarea").val();
    data=
    {
      podaci:podat
    }
    ajaxBack("models/slanjeAdminu.php", "post", data,  function(result){
      alert(result);
      if(result=="Poruka je dostavljena administratoru")
      {
        $("#textarea").val("");
      }
  })
})
}
if(url.indexOf('korpa.php')!=-1)
{
  $("#kupiDugme").on("click",function(){
    var korpa=localStorage.getItem('korpa');
    //console.log(korpa);

    data=
    {
      podaci:korpa
    }
    ajaxBack("models/cart.php", "post", data,  function(result){
      alert(result);
      if(result=="Vaša porudzbina je kreirana")
      {
        $(".korp").html("<div style='height:100px'<h1>Hvala na kupovini</h1></div>");
        $("#kupiDugme").css("display:none;")
      }
      if(result=="Nemate nista u korpi")
      {
        $("#kupiDugme").css("display","none");
      }
  })
})
}
var url=window.location.href;
//Vise teksta na strani onama.html
if(url.indexOf('proizvodi.php')!=-1)
{

  var pro=JSON.parse(localStorage.getItem("proizvodi"));
  console.log(pro);
  var max=0;
  var min=99999;
  for(let i=0;i<pro.length;i++)
  {
    if(pro[i].nova_cena>max)
    {
      max=pro[i].nova_cena;
    }
    if(pro[i].nova_cena<min)
    {
      min=pro[i].nova_cena;
    }
  }
  $("#range1").append(min);
    $("#range2").append(max);


//}
  $('.korpa').on('click',dodavanjeKorpa);
  $('#submitCart').on('click',
  function(){
    $("#kupiDugme").css("display","block")

  });
  $('#deleteCart').on('click',
  function(){
    $("#kupiDugme").css("display","none");
    
  });
  
  // Div za ispisivanje korpe
  const cartContent = document.getElementById('cart-content');	
  // Inicijalno ispisivanje korpe
  proveraKorpe();
  // Dodeljivanje događaja za "Dodaj u korpu"
  function proveraKorpe(){
  let html = "";
  console.log("uso");
  const cookieCart = document.cookie.split("; ").find(row => row.startsWith('cart='));
  if(cookieCart){
    // Ukoliko postoji cookie i ima svojstvo cart ispisuju se sve knjige.
    html="<ul class='list-group'>";   
    // JSON.parse zato što nam je vrednost u cookie u vidu stringa.
    for(const item of JSON.parse(cookieCart.split("=")[1])){
      html+=`<li data-book="${item.book}" class="list-group-item cart-product">${item.book} 
      <span class="badge badge-primary">${item.quantity}</span> 
      </li>`;
    }
    html+="</ul>";   
    html+=`<button id="deleteCart" class="btn btn-danger btn-sm mt-3">Obriši 
    </button>&nbsp &nbsp &nbsp 
    <form method="get" action="korpa.php">  
    <button id="submitCart" class="btn btn-submit btn-sm mt-3">Udji u korpu</button>
    </form>`;
    
    cartContent.innerHTML = html;
    
    // Dodeljuju se događaji za brisanje pojedinačnih knjiga i svih knjiga.
    $('#deleteCart').click(brisanjeKorpe);
    $('#submitCart').click(slanjeKorpe);
  }else {
    html = "Korpa je prazna."
    cartContent.innerHTML = html;
  }
}
$(".korpa").on("click",function(){
  var id=$(this).data('name');
  var proizvodiizkorpe=getItemFromLocalStorage('korpa');
  if(proizvodiizkorpe){
    if(productIsAlreadyInCart()) {
        updateQuantity();
    } 
    else {
        addToLocalStorage();
        //printCartLength();
    }
}
else{
    addFirstItemToCart();
    //printCartLength();
}
// funkcija za skladistenje podataka u local storage
function setItemToLocalStorage(name, data){
  localStorage.setItem(name, JSON.stringify(data));
}
// funkcija za dohvatanje podataka iz local storage
function getItemFromLocalStorage(name){
  return JSON.parse(localStorage.getItem(name));
}
    // funkcija za dodavanje prvog proizvoda u korpu
    function addFirstItemToCart(){
      let products = [];
      products[0] = {
          id : id,
          quantity : 1
      };

      setItemToLocalStorage("korpa", products);
      
  }
      // funkcija koja proverava da li proizvod vec postoji u korpi
      function productIsAlreadyInCart(){
        var proizvod=proizvodiizkorpe.filter(p => p.id == id).length;
        //console.log(proizvod);
        return proizvod;
    }

    // funkcija koja povecava kolicinu
    function updateQuantity(){
        let productsFromLS = getItemFromLocalStorage("korpa");
        for(let i in productsFromLS)
        {
            if(productsFromLS[i].id == id) {
                productsFromLS[i].quantity++;
                break;
            }      
        }

        setItemToLocalStorage("korpa", productsFromLS)
    }
    function addToLocalStorage(){
      let productsFromLS = getItemFromLocalStorage("korpa");
      productsFromLS.push({
          id : id,
          quantity : 1
      });
      
      setItemToLocalStorage("korpa", productsFromLS);
  }
  ajaxCallBack("models/korpa.php", "post",   function(result){
    setItemToLocalStorage("proizvodi", result);
});
  })
  function slanjeKorpe()
  {
    localStorage.getItem
  }
  function setCookie(name, value, exdays){
    let date = new Date();
    // Vreme isteka je za exdays više od današnjeg dana (ako je exdays manji od nule, cookie će isteći).
    date.setTime(date.getTime() + (exdays*24*60*60*1000));
    document.cookie = name + "=" + value + ";" + "expires=" + date.toUTCString(); 
  }
  function dodavanjeKorpa(){
    console.log(this);
    const book = $(this).data("naziv");
    let cart = [];
    const cookieCart = document.cookie.split("; ").find(row => row.startsWith('cart='));
    if(cookieCart){
      // Ukoliko već postoji cart u cookie, dodajemo nov član na već postojeći niz.
      cart = JSON.parse(cookieCart.split("=")[1]);
    }
    if(cart.some(x => x.book == book)){
      // Ako već postoji knjiga sa istim imenom, uvećavamo njenu količinu.
      cart.find(x => x.book == book).quantity++;
    } else {
      // U suprotnom, dodajemo novu knjigu sa količinom 1.
      cart.push({book, quantity: 1});
    }
    setCookie("cart", JSON.stringify(cart), 5);
    // Niz pretvaramo u string.
    
    proveraKorpe();
    // Svaki put pozivamo proveraKorpe da bi se izmenili podaci u korpi.
  }
  function brisanjeKorpe(){
    localStorage.removeItem(korpa);
    proi=[];
    const book = this.dataset.book;
    const cookieCart = document.cookie.split("; ").find(row => row.startsWith('cart='));
    if(cookieCart){
      const cart = JSON.parse(cookieCart.split("=")[1]);
      // Filtriramo tako da ostaju svi koji nemaju naziv kao prosleđeni naziv.
      const filtered = cart.filter(item => item.book != book);
      
      if(filtered.length == 0){
        // Ako je niz prazan, brišemo celu korpu iz cookie-a.
        brisanjeKorpe();
      }
      else {
        setCookie("cart", JSON.stringify(filtered), 5);
      }
      proveraKorpe();
    }
  }
  function brisanjeKorpe(){
    setCookie("cart", null, -1);
    // Postavljamo expires u cookie-u na neki prošli datum tako da cookie automatski ističe i uklanja se.
    proveraKorpe();
  }
  var ddl=document.getElementById("ddl");
  ddl.addEventListener("click",function(){
    var vrednost=$("#ddl option:selected ").val();
    //console.log(vrednost);
    if(vrednost==0)
    {
      console.log(vrednost);
      prikazProizvoda(proizvodi);
      console.log(proizvodi);
    }
  })
  $("#range1").css("color","white");
  $("#range2").css("color","white");
  var myIndex = 0;
  carousel();
  
  function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
  }
  document.getElementById("ddlB").addEventListener("change",function(){
    var podaciZaSlanje=$("select#ddlB option:selected").val();
    console.log(podaciZaSlanje);
    let data = {
      podaci:podaciZaSlanje
  }
  ajaxBack("models/sortiranjeCenaDole.php", "post", data,  function(result){
   console.log(result); 
   var ispis="";
   for(let i=0;i<result.length;i++)
      {
        br=result[i].zvezdice;
        var zvzIspis="";
        for(var n=0;n<br;n++)
        {
            zvzIspis+="<span class='material-icons md-dark'>star</span>";
        }
        console.log(n);
        for(let m=0;m<5-n;m++)
        {
            zvzIspis+="<span class='material-icons md-dark' style='color:orange;'>star_border</span>";
        }
        ispis+=`<div class='col-lg-4 col-md-6 mb-4' id='raspored' >
                    <div class='card h-100'>
                    <a href='#'><img class='card-img-top' src='assets/images/${result[i].slika_src}'alt='${result[i].slika_alt}'></a>
                       <div class='card-body' style='display: grid'> 
                        <h4 class='card-title'>
                           <h2 style='color:orange;'>${result[i].naziv_proizvoda}</h1>
                         </h4>
                         <p class='card-text'></p>
                         <p>${zvzIspis}</p>
                         <h5>${result[i].nova_cena}RSD</h5>
                         <s>${result[i].stara_cena} RSD</s><p>
                         <p class='card-text'>${result[i].opis}</p>
                         <button class='korpa' data-naziv='${result[i].naziv_proizvoda}' data-name='${result[i].id_proizvoda}'>Ubaci u korpu</button>            
                       </div>          
                     </div>
                   </div>`;
      }
      $("#proizvodi").html(ispis);
  })
  })
  $(document).on("change","#ddl",function(){
    console.log($("select#ddl option:selected").val());
    var podaciZaSlanje=$("select#ddl option:selected").val();
    var data={
      idKat:podaciZaSlanje
    }
    console.log(data);
    ajaxBack("models/sortiranje.php", "post", data,  function(result){
      var ispis="";
      for(let i=0;i<result.length;i++)
      {
        br=result[i].zvezdice;
        var zvzIspis="";
        for(var n=0;n<br;n++)
        {
            zvzIspis+="<span class='material-icons md-dark'>star</span>";
        }
        console.log(n);
        for(let m=0;m<5-n;m++)
        {
            zvzIspis+="<span class='material-icons md-dark' style='color:orange;'>star_border</span>";
        }
        ispis+=`<div class='col-lg-4 col-md-6 mb-4' id='raspored' >
                    <div class='card h-100'>
                    <a href='#'><img class='card-img-top' src='assets/images/${result[i].slika_src}'alt='${result[i].slika_alt}'></a>
                       <div class='card-body' style='display: grid'> 
                        <h4 class='card-title'>
                           <h2 style='color:orange;'>${result[i].naziv_proizvoda}</h1>
                         </h4>
                         <p class='card-text'></p>
                         <p>${zvzIspis}</p>
                         <h5>${result[i].nova_cena}RSD</h5>
                         <s>${result[i].stara_cena} RSD</s><p>
                         <p class='card-text'>${result[i].opis}</p>
                         <button class='korpa' data-naziv='${result[i].naziv_proizvoda}' data-name='${result[i].id_proizvoda}'>Ubaci u korpu</button>            
                       </div>          
                     </div>
                   </div>`;
      }
      $("#proizvodi").html(ispis);
    })
  })
  $("#range").on("change",function(){
    console.log($("#range").val());
    var pod=$("#range").val();
    var data=
    {
      podatak:pod
    }
    ajaxBack("models/opsegCene.php", "post", data,  function(result){
      console.log(result);
      var ispis="";
      for(let i=0;i<result.length;i++)
      {
        br=result[i].zvezdice;
        var zvzIspis="";
        for(var n=0;n<br;n++)
        {
            zvzIspis+="<span class='material-icons md-dark'>star</span>";
        }
        console.log(n);
        for(let m=0;m<5-n;m++)
        {
            zvzIspis+="<span class='material-icons md-dark' style='color:orange;'>star_border</span>";
        }
        ispis+=`<div class='col-lg-4 col-md-6 mb-4' id='raspored' >
                    <div class='card h-100'>
                    <a href='#'><img class='card-img-top' src='assets/images/${result[i].slika_src}'alt='${result[i].slika_alt}'></a>
                       <div class='card-body' style='display: grid'> 
                        <h4 class='card-title'>
                           <h2 style='color:orange;'>${result[i].naziv_proizvoda}</h1>
                         </h4>
                         <p class='card-text'></p>
                         <p>${zvzIspis}</p>
                         <h5>${result[i].nova_cena}RSD</h5>
                         <s>${result[i].stara_cena} RSD</s><p>
                         <p class='card-text'>${result[i].opis}</p>
                         <button class='korpa' data-naziv='${result[i].naziv_proizvoda}' data-name='${result[i].id_proizvoda}'>Ubaci u korpu</button>            
                       </div>          
                     </div>
                   </div>`;
      }
      $("#proizvodi").html(ispis);
    })
  })

}

if(url.indexOf('korisnik.php')!=-1)
{
  $("#STANDARD").css("background-image","url('https://nonstopfitness.rs/wp-content/uploads/2021/01/NonStopFitness-Teretana-1.jpg')");
  $("#STUDENT").css("background-image","url('https://nonstopfitness.rs/wp-content/uploads/2021/01/NonStopFitness-Teretana-2.jpg'");
  $("#DNEVNI").css("background-image","url('https://nonstopfitness.rs/wp-content/uploads/2021/01/NonStopFitness-Teretana-3.jpg')");
}
if(url.indexOf('index.php')!=-1)
{
//prikaz vise teksta
$("#pvise").on("click",function(){
  $("#vise").css("display","block");
  $("#skloni").css("display","none");
})
$(document).ready(function(){
  $.ajax({
    url:"models/autor.php",
    method:"get",
    dataType:"json",
    success:function(result)
    {
      console.log(result);
    }
  })
$("#STANDARD").css("background-image","url('https://nonstopfitness.rs/wp-content/uploads/2021/01/NonStopFitness-Teretana-1.jpg')");
$("#STUDENT").css("background-image","url('https://nonstopfitness.rs/wp-content/uploads/2021/01/NonStopFitness-Teretana-2.jpg'");
$("#DNEVNI").css("background-image","url('https://nonstopfitness.rs/wp-content/uploads/2021/01/NonStopFitness-Teretana-3.jpg')");

})
}

//Get the button
var mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// vracanje na vrh
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
$("#myBtn").on("click",topFunction);


//}
//Ovde pocinje JS za PHP
$(document).ready(function(){
  $("#dugmeSlanje").on("click",function(){
    let imePrezime = $("#imePrezime");
    let mejl = $("#mejl");
    let adresa = $("#adresa");
    //izrazi
    let reImePrezime = /^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,19})+$/;
    let reMejl=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    let reAdresa = /^([A-Z]|[1-9]{1,5})[A-Za-z\d\-\.\s]+$/;
    let brojGresaka = 0;
    console.log($(imePrezime).val());
        if(!reImePrezime.test($(imePrezime).val())){
            brojGresaka++;
            $(imePrezime).addClass('error');
        }
        else{
            $(imePrezime).removeClass('error');
        }

        if(!reAdresa.test($(adresa).val())){
            brojGresaka++;
            $(adresa).addClass('error')
        }
        else{
            $(adresa).removeClass('error')
        }
        if(!reMejl.test($(mejl).val())){
          brojGresaka++;
          $(mejl).addClass('error')
      }
      else{
          $(adresa).removeClass('error')
      }
      console.log(brojGresaka);
      if(brojGresaka==0){
        let podaciZaSlanje={
          "imePrezime":$(imePrezime).val(),
          "adresa":$(adresa).val(),
          "mejl":$(mejl).val()
        }
      }
  })
})
//////////////////////////////
// ajax callback function

if(url.indexOf('registracija.php')!=-1)
{
  $(document).on('click', '#registracija', function(){
    console.log("uso");
    let prezimeIme, email, lozinka,pol, brojGresaka;
    prezimeIme = $('#ime_prezime');
    email = $('#mejl');
    lozinka = $('#sifra');
    pol=$('input[name="pol"]:checked');
    //console.log(prezimeIme.val())
     //console.log(email.val())
     console.log(lozinka.val())
     //console.log(pol.val())
     regImePrezime=/^[A-ZŠĐČĆŽ][a-zšđžćč]{2,20}(\s[A-ZŠĐČĆŽ][a-zšđžćč]{3,30})+$/;
     regpass=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
     regemail=/^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/;
    brojGresaka = [];
    if(!regImePrezime.test($(prezimeIme).val()))
    {
      brojGresaka.push("Neispravno ime i prezime(Stefan Stanisavljević)");
    }
    
    if(!regemail.test($(email).val()))
    {
      brojGresaka.push("Neispravan mejl (stefan@gmail.com)");
    }
    
    if(!regpass.test($(lozinka).val()))
    {
      brojGresaka.push("Neispravna lozinka, minimum 8 karaktera, treba da sadrzi minimum jedno veliko slovo, broj,specijalni znak.");
    }
    
    if($(pol).val()=='M'||$(pol).val()=='Z')
    {

    }
    else{
      brojGresaka.push("Morate izabrati pol");
    }
    //console.log(brojGresaka);
    //console.log(brojGresaka.length);
    if(brojGresaka.length==0)
    {
        var podaciZaSlanje = {
            imeprezime: $(prezimeIme).val(),
            pol:$(pol).val(),
            email: $(email).val(),
            lozinka: $(lozinka).val()
        }

  
        // console.log(podaciZaSlanje);
        
  
        }
        else
        {
          var ispis="";
          for(let i=0;i<brojGresaka.length;i++)
          {
            ispis+="<p><b>"+brojGresaka[i]+"</b></p>";
          }
            $("#odgovor").html(ispis);
        }
        ajaxBack("models/registracija.php", "post", podaciZaSlanje,  function(result){
            console.log(result.poruka);
            
            $('#odgovor').html(`<p class="alert alert-success my-3">${result.poruka}</p>`);
        });
       
     }
  
  )
}
if(url.indexOf('logovanje.php')!=-1)
{
  $(document).on('click', '#logovanje', function(){
    let email, lozinka, brojGresaka;
    email = $('#e-mail');
    lozinka = $('#loz');
    brojGresaka = [];
    regpass=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
    regemail=/^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/;
    if(!regemail.test($(email).val()))
    {
      brojGresaka.push("Neispravan mejl (stefan@gmail.com)");
    }
    
    if(!regpass.test($(lozinka).val()))
    {
      brojGresaka.push("Neispravna lozinka, minimum 8 karaktera, treba da sadrzi minimum jedno veliko slovo, broj,specijalni znak.");
    }
    // regularni izrazi
  
    // provera
  
    if(brojGresaka.length==0){
        let data = {
            email: $(email).val(),
            lozinka: $(lozinka).val()
        }
        ajaxBack("models/logovanje.php", "post", data,  function(result){
            console.log(result.nazivUloge);
            if(result.nazivUloge == "admin"){
                $('#ispis12').append("<a href='admin_panel.php'>Stranica za adminnnnna</a>");
            }
            if(result.nazivUloge  == "korisnik"){
                $('#ispis12').append("<a href='korisnik.php'>Stranica za korisnika</a>");
            }
            
        });
    }
    else
        {
          var ispis="";
          for(let i=0;i<brojGresaka.length;i++)
          {
            ispis+="<p><b>"+brojGresaka[i]+"</b></p>";
          }
            $("#ispis12").html(ispis);
        }
  })
}

//

if(url.indexOf('anketa.php')!=-1)
{
  $("#anketa").on("click",function(){
    var rb=$("form :radio:checked").val();
    console.log(rb);
    data=
    {
      vrednost:rb
    }
    ajaxBack("models/obradaAnkete.php", "post", data,  function(result){
      alert(result.uspeh);
      $("#prosek").html(("Prosecan rezultat glasanja-"+result.prosek[0]["avg(vrednost_glasanja)"]));
    })
  })
  $("#forma p").click(function(){
    $("#forma p").css("background-color","	#dddbdb");
    $(this).css("background-color","	#9ACD32");
    var dete=$(this).children();
    console.log(dete[0].checked=true);
  })
}

function ajaxBack(url, method, data, result){
  $.ajax({
      url: url,
      method: method,
      data: data,
      dataType: "json",
      success: result,
     // error: function(xhr){
          //console.error(xhr);
          // if 500...
          // if 404...
      //}
  });
}

//regex
var grRegNiz=[];
  //provera imePrezime
  const imePrezime=document.getElementById("imePrezime");
  imePrezime.addEventListener("focus",fokus);
  function fokus(){
    $("#imePrezime").css("border-bottom","2px solid orange");
    $("#primerIme").css("display","none");
  }
  imePrezime.addEventListener("blur",proveraIme);
  function proveraIme(){
    var unetoImePrezime=$("#imePrezime").val();
    var kakoTreba=/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20})+$/;
    if (kakoTreba.test(unetoImePrezime)) 
    {
      console.log("dobro je");
      $("#imePrezime").css("border-bottom","2px solid green");
      $("#primerIme").css("display","none");
    }
    else{
      grRegNiz.push("Greska ime prezime");
      $("#imePrezime").css("border-bottom","2px solid red");
      $("#primerIme").css("display","block");
    }

  }
  //mejl provera
  const mejl=document.getElementById("mejl");
  mejl.addEventListener("focus",fokusMejl);
  function fokusMejl(){
    $("#mejl").css("border-bottom","2px solid orange");
    $("#primerMejl").css("display","none");
  }
  mejl.addEventListener("blur",proveraMejl);
  function proveraMejl(){
    var unetiMejl=$("#mejl").val();
    var kakoTreba=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if (kakoTreba.test(unetiMejl)) 
    {
      console.log("dobro je");
      $("#mejl").css("border-bottom","2px solid green");
      $("#primerMejl").css("display","none");
    }
    else{
      grRegNiz.push("Greska mejl");
      $("#mejl").css("border-bottom","2px solid red");
      $("#primerMejl").css("display","block");
    }
  //adresa provera
  const adresa=document.getElementById("adresa");
  adresa.addEventListener("focus",fokusAdresa);
  function fokusAdresa(){
    $("#adresa").css("border-bottom","2px solid orange");
    $("#primerAdresa").css("display","none");
    $("#primerAdresaIsti").css("display","none");
  }
  adresa.addEventListener("blur",proveraAdresa);
  function proveraAdresa(){
    
    var unetaAdresa=$("#adresa").val();
    var unetiMejl=$("#mejl").val();
    var kakoTreba=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if (kakoTreba.test(unetaAdresa)) 
    {
      if(unetiMejl==unetaAdresa)
      {
        console.log("dobro je");
        $("#adresa").css("border-bottom","2px solid green");
        $("#primerAdresa").css("display","none");
        $("#primerAdresaIsti").css("display","none");
      }
      else{
        grRegNiz.push("Greska u ponovljenom unosu mejla");
        $("#adresa").css("border-bottom","2px solid red");
        $("#primerAdresaIsti").css("display","block");
      }
      
    }
    else{
      grRegNiz.push("Greska mejl");
      $("#adresa").css("border-bottom","2px solid red");
      $("#primerAdresa").css("display","block");
    }
  }
}
//console.log(grRegNiz);
$("#dugmeSlanje").on("click",function(){
  var imePrezime=$("#imePrezime").val();
  var email=$("#mejl").val();
  var emailPonovo=$("#adresa").val();
  var poruka=$("#por").val();
    regImePrezime=/^[A-ZŠĐČĆŽ][a-zšđžćč]{2,20}(\s[A-ZŠĐČĆŽ][a-zšđžćč]{3,30})+$/;
    regemail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
     brojGresaka = [];
    if(!regImePrezime.test(imePrezime))
    {
      brojGresaka.push("Neispravno ime i prezime(Stefan Stanisavljević)");
      console.log("ime");
    }
    
    if(regemail.test(email))
    {
      if(emailPonovo!=email)
    {
      brojGresaka.push("Ne poklapaju se mejlovi");
      console.log("mejlisti");
    }
      
    }
    else
    {
      brojGresaka.push("Neispravan mejl (stefan@gmail.com)");
      console.log("neispravan");
    }
    console.log(brojGresaka);

    if(brojGresaka.length==0)
    {
        var podaciZaSlanje = 
        {
            imePrezime:imePrezime,
            email:email,
            podaci:poruka
        }
        ajaxBack("models/slanjeAdminu.php", "post", podaciZaSlanje,  function(result){
          alert(result);
          if(result)
          {
            $("#imePrezime").val("");
            $("#mejl").val("");
            $("#adresa").val("");
            $("#por").val("");
          }
          
          //$('#odgovor').html(`<p class="alert alert-success my-3">${result.poruka}</p>`);
      });
      }
      else{
        // for(let i=0;i<brojGresaka.length;i++)
        // {
        //   $('#contact').append(brojGresaka[i]+"<br>");
        // }
      }
    
})



