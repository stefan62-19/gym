$(document).ready(function () {
    let productsFromCartLS = getItemFromLocalStorage("korpa");
    // console.log(productsFromCartLS);

    if(productsFromCartLS == null){
        showEmptyCart();
    }
    else{
        displayCartData();
    }
});

// funkcija za dohvatanje podataka iz local storage
function getItemFromLocalStorage(name){
    return JSON.parse(localStorage.getItem(name));
}

// funkcija za prikaz prazne korpe
function showEmptyCart(){
    $("#korpica").html("<h1>Your cart is empty!</h1>");
}
// funkcija za prikaz sadrzaja korpe
function displayCartData(){
    let productsFromCartLS = getItemFromLocalStorage("korpa");

    ajaxCallBack("models/korpa.php", "post", function(data){
        // console.log(data)

        let productsForDisplay = [];

        productsForDisplay = data.filter(p => {
            for(let prod of productsFromCartLS)
            {
                if(p.id_proizvoda == prod.id) {
                    p.quantity = prod.quantity;
                    return true;
                }
                    
            }
            return false;
        });
        // console.log(productsForDisplay)
        generateTable(productsForDisplay)
    })
}

// ajax callback function
function ajaxCallBack(url, method, result){
    $.ajax({
        url: url,
        method: method,
        dataType: "json",
        success: result,
        error: function(xhr){console.log(xhr);}
    });
}
// funkcija koja kreira tabelu sa sadrzajem korpe
function generateTable(products){
    let html = `
    <table class="timetable_sub">
        <thead>
            <tr>
                <th>Redni broj</th>
                <th>Proizvod</th>
                <th>Naziv proizvoda</th>
                <th>Osnovna cena</th>
                <th>Kolicina</th>
                <th>Cena</th>
                <th>Ukloni</th>
            </tr>
        </thead>
        <tbody>`;
        
for(let p of products) {
html += generateTr(p);
}

html +=`    </tbody>
    </table>`;

$("#korpica").html(html);

function generateTr(p) {
    console.log(p);
    var prom=
    `<tr class="rem1">
     <td class="invert">${p.id_proizvoda}.</td>
     <td class="invert-image">
         <a href="single.html">
             <img src="assets/images/${p.slika_src}" style='height:100px' alt="${p.slika_alt}" class="img-responsive">
         </a>
     </td>
     <td class="invert">${p.naziv_proizvoda}</td>
     <td class="invert">${p.nova_cena} &nbsp RSD</td>
     <td class="invert">${p.quantity}</td>
     <td class="invert">${p.nova_cena * p.quantity} &nbsp RSD</td>
     <td class="invert">
         <div class="rem">
             <div class=""><button class='btn' id="remove" onclick='removeFromCart(${p.id_proizvoda})'>Remove</button> </div>
         </div>
     </td>
     
 </tr>
 `
    return prom;
}
}

function removeFromCart(id) {
    let products = getItemFromLocalStorage("korpa");
    let filtered = products.filter(p => p.id != id);

    localStorage.setItem("korpa", JSON.stringify(filtered));

    displayCartData();
}