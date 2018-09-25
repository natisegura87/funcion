<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Sistema Organigrama</title>

    <link rel="shortcut icon" href="{{ asset('images/logo-sistema.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jquery.jOrgChart.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <!-- jQuery includes -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src="{{ asset('js/jquery.jOrgChart.js') }}"></script>
     <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/taffy.js') }}"></script>

   
    <style type="text/css">
    
    .node p {       
        color: #fff;
    }

    .node2 {
            border: 0px solid #333!important;
            border-radius: 3px!important;
            color: #fff!important;
            background-color: #080808!important;
            width: 1px!important;
            height: 80px!important;
        }
    .circulo {
        height: 32px !important;
        -moz-border-radius: 50%!important;
        -webkit-border-radius: 75%!important;
        border-radius: 30% !important;
        width: 8px;
        background: #5cb85c;
    }
    table {      
        width: max-content;
    }
    canvas {      
        width: max-content !important;
    }
    .exp-col {       
        left: 49%;            
    }
   
    .jOrgChart .node {      
       // width: -webkit-fill-available;
        background-color: #0d4c82; 
        color: #69e069;
        border: 1px solid #080808;
        height: 80px;
        width: 180px;
    }
    .jOrgChart .line {
        width: 1px;
    }
    .node2 span.exp-col {
        display: none;
    }
    .opciones {
        display: none;
    }
    .label_node a {
        color: #eeeeee;
    }
    button#edit_node, button#add_node {
        display: inline-block;
        width: 210px;
        height: 26px;
        margin-top: 10px;
        padding: 5px;
        font-size: 13px;
        line-height: 18px;
        color: #808080;
        border: 1px solid #ccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    #getjson {
        width: 100px;
        height: 50px;
        border-radius: 3px;
        margin-left: 20px;
        margin-top: 20px;
    }
    
    ul#upload-chart {
        float: right;
        padding-right: 10px;
        display: none;
        list-style: none outside none;
    }
    
    ul#upload-chart li {
        background: none repeat scroll 0 0 #2ae2a7;
        border: 1px solid #808080;
        border-radius: 2px;
        height: 44px;
        margin-top: 2px;
        padding-top: 5px;
        width: 200px;
        z-index: 100;
    }
    
    #fancy_edit,
    #fancy_add {
        position: fixed;
        top: 100px;
        width: 500px;
        background: #fff;
        right: 0;
        left: 0;
        margin: auto;
        padding: 20px;
        border: 1px solid #eeeeee;
        border-radius: 5px;
        z-index: 99999;
    }
    
    #fancy_edit i,
    #fancy_add i {
        position: absolute;
        top: 0;
        width: 15px;
        height: 15px;
        right: 0;
        color: #000;
        background: gray;
        opacity: 1;
        font-size: 15px;
        cursor: pointer;
        padding: 5px;
    }
    </style>
    <script>


    var node_to_edit;

    // read json and convert to html formate
    // Here I am laod the json format to html structure. You no need to do this incase you have order list HTML in you body
    //Start Load HTML
    function loadjson() {
        var items = [];
      
        var puestos = '{!!$puestosorg!!}';
       
// me dan el puesto, agarro iddependencia y arranco
       
        var idpue={{$_POST["pue"]}};
        var iddependen={{$_POST["iddependencia"]}};
        //buscar el id- este es id_puesto
        //console.log(puestos);
      
        console.log(idpue);//23
        console.log(iddependen);
        var data = TAFFY(
                puestos
            );

        data({
            "iddependencia": iddependen
        }).each(function(record, recordnumber) {
            loops(record);
        });
        //start loop the json and form the html
        function loops(root) {


            if (root.id_puesto == idpue) {
                 if (root.unidad_id >7) {
                     items.push("<li class='unic" + root.id + " root' id='" + root.nombre + "'><span class='label_node'><a href=''>" + root.nombre + "</a></br><i>" + root.unidad_name + "</i></span><p><strong>Nivel </strong>" + root.nivel_name + "</p><div class='details'><p><strong>Nivel: </strong>" + root.nivel_name + "</p><p><strong>Empleado: </strong>" + root.empleado + "</p></div>");
                   
                 }else{               
                     items.push("<li class='unic" + root.id + " root' id='" + root.nombre + "'><span class='label_node'><a href=''>" + root.nombre + "</a></br><i>" + root.unidad_name + "</i></span><div class='details'></div>");
                    }
            } else {

                 if(root.nombre == "-"){ //root.nombre == "-"
                    //console.log("entro");
                    items.push("<li class='child node2 unic" + root.id + "' id='" + root.nombre + "'><span class='label_node'>" + root.nombre + "</br><i>" + root.unidad_name + "</i></span>");
            }else{
                if (root.unidad_id >7) {
                items.push("<li class='child unic" + root.id + "' id='" + root.nombre + "'><span class='label_node'><a href=''>" + root.nombre + "</a></br><i>" + root.unidad_name + "</i></span><p><strong>Nivel </strong>" + root.nivel_name + "</p><div class='details'><p><strong>Nivel: </strong>" + root.nivel_name + "</p><p><strong>Empleado: </strong>" + root.empleado + "</p></div>");
                }
                else{
                    items.push("<li class='child unic" + root.id + "' id='" + root.nombre + "'><span class='label_node'><a href=''>" + root.nombre + "</a></br><i>" + root.unidad_name + "</i></span><div class='details'></div>");
                    }
                }
      
            }

            var c = data({
                "iddependencia": root.id
            }).count();
            /*console.log(c);            
            console.log(root.id);
            console.log( '  ');*/
            if (c != 0) {
                items.push("<ul>");
                data({
                    "iddependencia": root.id
                }).each(function(record, recordnumber) {
                    loops(record);
                });
                items.push("</ul></li>");
            } else {
                items.push("</li>");
            }
        } // End the generate html code

        //push to html code
        $("<ul/>", {
            "id": "org",
            "style": "float:right;",
            html: items.join("")
        }).appendTo("body");
    }

    function nivel(id){
        $.get("organigrama/"+id, function(response,state){
        //console.log(response);
        return response;
        });
    }
    // End Load HTML
    </script>
</head>

<body>
    <span id="captu" style="width: 100%;">
    <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="{{ route('organigrama.indexN') }}">Graficar</a></li>
                         <li><a href="{{ route('nomenclador.index') }}">Nomenclador</a></li>
                         <li><a onclick="captura()">Descargar</a></li>

                        <li><a href="{{ route('vincularpuesto.index') }}">Puestos Organigrama</a></li>

                        @guest
                            
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
   

    <div id="in" style="display:none">
    </div>
    <!-- Here below code for Right side box model. Please dont change ID -->
    <ul id="upload-chart">
        <li id="Albert" class="node child"><span class="label_node"><a href="http://github.com/sselvamani22">Info 1</a><br><i>Data Architect</i> </span>
            <div class="details">
                <p><strong>rank:</strong>Vice President</p>
                <p><strong>department:</strong>Research and Development</p>
            </div>
        </li>
        <li id="Moser" class="node child"><span class="label_node"><a href="http://github.com/sselvamani22">Info 2</a><br><i>technical engineer </i></span>
            <div class="details">
                <p><strong>rank:</strong>Manager</p>
                <p><strong>department:</strong>IT</p>
            </div>
        </li>
        <li id="Meinert" class="node child"><span class="label_node"><a href="http://github.com/sselvamani22">Info 3</a><br><i>Maintenance Service Engineer</i></span>
            <div class="details">
                <p><strong>rank:</strong>Vice President</p>
                <p><strong>department:</strong>Research and Development</p>
            </div>
        </li>
        <li id="Mic" class="node child"><span class="label_node"><a href="http://github.com/sselvamani22">Info 4</a><br><i>Chairman of the Board, President</i></span>
            <div class="details">
                <p><strong>rank:</strong>Manager</p>
                <p><strong>department:</strong>IT</p>
            </div>
        </li>
    </ul>
    
    <div id="chart" class="orgChart"></div>
    <!-- Make sure You add this below code to you HTML in case you want edit and add box -->
    <!-- Add Node box -->
    <div id="fancy_add" class="hidden">
        <form>
            <h1 class="title_lb">Nuevo Puesto</h1>
            <div class="span12" id="add_nodo">
                <p class="notice span3">
                    Enter node caption
                </p>
                <input type="text" name="node_name" id="new_node_name" />
                <input type="text" name="title_name" id="new_node_title" />
                <div class="span12">
                    <button id="add_node" class="aqua_btn span3">Aceptar</button>
                </div>
            </div>
        </form>
        <i class="close">X</i>
    </div>
    <!-- Edit node box -->
    <div id="fancy_edit" class="hidden">
        <form>
            <h1 class="title_lb">Editar Puesto</h1>
            <div class="span12" id="edit_nodo">
                <p class="notice span3">
                    Enter node caption
                </p>
                <input type="text" name="node_name" id="edit_node_name" />
                <input type="text" name="node_title" id="edit_node_title" />
                <div class="span12">
                    <button id="edit_node" class="aqua_btn span3">Editar</button>
                </div>
            </div>
        </form>
        <i class="close">X</i>
    </div>

 
    <script type="text/javascript">
    function init_tree() {
        var opts = {
            chartElement: '#chart',
            dragAndDrop: true,
            expand: true,
            control: true,
            rowcolor: false
        };
        $("#chart").html("");
        $("#org").jOrgChart(opts);
    }

    function scroll() {
        $(".node").click(function() {
            $("#chart").scrollTop(0)
            $("#chart").scrollTop($(this).offset().top - 140);
        })
    }



    function makeArrays() {
        var hierarchy = [];

        $("#org li").each(function() {
            var uid = $(this).attr("id");
            var name = $(this).find(">:first-child a").text();
            var hidSTR = "";
            var hid = $(this).parents("li");
            if (hid.length == 0) //If this object is the root user, substitute id with "orgName" so the DB knows it's the name of organization and not a user
            {
                hidSTR = "orgName";
                var user = new Object();
                user.key = name;
                user.hierarchy = hidSTR;
                hierarchy.push(user);
            } else {
                for (var i = hid.length - 1; i >= 0; i--) {
                    if (i != hid.length - 1) {
                        hidSTR = hidSTR + hid[i].id + ",";
                    } else {
                        hidSTR = hidSTR + hid[i].id + '"';
                    }
                }
                var user = new Object();
                user.key = name;
                user.hierarchy = hidSTR;
                hierarchy.push(user);
            }
        });
        console.log(hierarchy)
        alert("Check console")
    }



    $(document).ready(function() {
        loadjson();
        init_tree();

        //forms behavior
        $("#new_node_name, #edit_node_name").on("keyup", function(evt) {
            var id = $(this).attr("id");
            if ($(this).val() != '') {
                if (id == "new_node_name") {
                    $("#add_node").show();
                } else {
                    $("#edit_node").show();
                }
            } else {
                if (id == "new_node_name") {
                    $("#add_node").hide();
                } else {
                    $("#edit_node").hide();
                }
            }
        });


        scroll()

    });
 
    function captura(){
        
         html2canvas(document.querySelector("html")).then(canvas => {
            document.body.appendChild(canvas)
             var canvas = document.getElementById("mycanvas");
            var img    = canvas.toDataURL("image/png");
            document.write('<img src="'+img+'"/>');
        });
    }
     function captura1(){
        
        console.log("captura");
    }
    </script>
   </span>
</body>

</html>
