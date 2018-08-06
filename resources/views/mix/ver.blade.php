<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Sistema Organigrama</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/jquery.jOrgChart.css" />
    <link rel="stylesheet" href="css/custom.css" />
    <!-- jQuery includes -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src="js/jquery.jOrgChart.js"></script>
    <script type="text/javascript" src="js/taffy.js"></script>
   
    <style type="text/css">
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
        var puestos = '{!!$puestos!!}';
        console.log(puestos);
        var data = TAFFY(
                puestos
            );

        data({
            "parent": 0
        }).each(function(record, recordnumber) {
            loops(record);
        });
        //start loop the json and form the html
        function loops(root) {
            //console.log(root.parent);

            if (root.parent == 0) {
                items.push("<li class='unic" + root.id + " root' id='" + root.nombre + "'><span class='label_node'><a href=''>" + root.nombre + "</a></br><i>" + root.level + "</i></span><div class='details'><p><strong>Unidad: </strong>" + root.rank + "</p><p><strong>Departmento: </strong>" + root.department + "</p></div>");
            } else {
                items.push("<li class='child unic" + root.id + "' id='" + root.nombre + "'><span class='label_node'><a href=''>" + root.nombre + "</a></br><i>" + root.level + "</i></span><div class='details'><p><strong>Unidad: </strong>" + root.rank + "</p><p><strong>Departmento: </strong>" + root.department + "</p></div>");
            }
            var c = data({
                "parent": root.id
            }).count();
            if (c != 0) {
                items.push("<ul>");
                data({
                    "parent": root.id
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
    // End Load HTML
    </script>
</head>

<body>
    <div class="topbar">
        <div class="topbar-inner">
            <div class="container">
                <a class="brand" href="#">Sistema Organigrama</a>
                <ul class="nav">
                    <li><a href="http://github.com/sselvamani22">Puestos</a></li>
                    <li><a href="http://twitter.com/sselvamani22">Organigrama</a></li>
                    <li><a href="http://www.linkedin.com/pub/selva-mani/69/235/711">Preguntas</a></li>
                </ul>
                <div class="pull-right">
                    <div class="alert-message info" id="show-list">Show Lista</div>
                    <pre class="prettyprint lang-html" id="list-html" style="display:none"></pre>
                </div>
            </div>
        </div>
    </div>
    <button id="getjson" onclick="makeArrays()">Generate json</button>
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
    </script>
</body>

</html>
