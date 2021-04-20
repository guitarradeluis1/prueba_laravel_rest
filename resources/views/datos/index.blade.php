<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container p-2">
        <div class="card p-2">
            <div class="card-body">
                <h5 class="card-title">Libros</h5>
                <p class="card-text">consulta de libros</p>
            </div>
        </div>
        <div id="datos" class="row" ></div>
        <div class="card">
            <div class="card-body">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center" id="urlPaginador">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
<script>
window.onload = function () {
    obj.init();
}
var obj = {
    data: [],
    pagina: 1,
    init:()=>{
        const { consultar, pintarPaginador } = obj;
        pintarPaginador();
        consultar();
    },
    consultar: ()=>{
        const { pintar, envio } = obj;
        let send = {
            tipo: 'GET',
            url: `http://localhost/prueba_laravel_rest/public/books?page=${obj.pagina}`,
            callback: function(entrada){
                obj.data = entrada;
                pintar();
            },
        };
        envio(send);
    },
    envio: send=> {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let datos = JSON.parse(this.responseText);
                //console.log(datos);
                if(send.callback){
                    send.callback(datos);
                }
            }
        };
        //xhttp.open("GET", "connection_mysqli.php", true);
        xhttp.open(send.tipo, send.url, true);
        xhttp.send();
    },
    pintar: ()=>{
        const { data } = obj;
        let contenedor = document.getElementById('datos');
        contenedor.innerHTML = '';
        data.data.map(v=>{
            //console.log(v);
            var div = document.createElement('div');
            div.classList = ['col-sm-6'].join(' ');
            var card = document.createElement('div');
            card.classList = ['card'].join(' ');
            var cardBody = document.createElement('div');
            cardBody.classList = ['card-body'].join(' ');

            var h5 = document.createElement('h5');
            h5.innerHTML = `${v.title} (${v.id})`;
            cardBody.appendChild(h5);
            var p = document.createElement('p');
            p.innerHTML = `<b>ISBN</b>: ${v.ISBN}<br>
            <b>Paginas</b>: ${v.number_of_pages}<br>
            <b>Año de publicación</b>: ${v.publish_date}`;
            cardBody.appendChild(p);

            card.appendChild(cardBody);
            div.appendChild(card);
            contenedor.appendChild(div);
        });
    },
    pintarPaginador: ()=>{
        /*
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>*/
        const { consultar } = obj;
        var contenedor = document.getElementById('urlPaginador');
        contenedor.innerHTML = '';
        var next = document.createElement('li');
        next.classList = ['page-item'].join(' ');
        var a_next = document.createElement('a');
        a_next.classList = ['page-link'].join(' ');
        a_next.innerHTML = 'Next';
        a_next.onclick = function(){
            obj.pagina = obj.pagina + 1;
            consultar();
        };

        var previous = document.createElement('li');
        previous.classList = ['page-item'].join(' ');
        var a_previous = document.createElement('a');
        a_previous.classList = ['page-link'].join(' ');
        a_previous.innerHTML = 'Previous';
        a_previous.onclick = function(){
            if(obj.pagina > 1){
                obj.pagina = obj.pagina - 1;
                consultar();
            }
        };

        previous.appendChild(a_previous);
        contenedor.appendChild(previous);
        next.appendChild(a_next);
        contenedor.appendChild(next);
    }
};
</script>
</body>
</html>