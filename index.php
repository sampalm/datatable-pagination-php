<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatable Example</title>
    <!-- Datatable CSS -->
    <link href='datatables/datatables.min.css' rel='stylesheet' type='text/css'>
    <link href='datatables/datatables.bootstrap4.min.css' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <style>
        #empTable_wrapper > div.row > div.col-md-6:nth-child(1){
            display: none;
        }
        #empTable_wrapper > div.row > div.col-md-6:nth-child(3) label {
            padding: 6px;
            margin-left: 10px;
        }
        #empTable_filter label {
            width: 100%;
        }

        #empTable_filter input {
            width: 450px;
            margin: 5px;
            padding-left: 50px;
        }
        
    </style>
</head>

<body>
    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="datatables/datatables.min.js"></script>

    <!-- Table -->
    <div class="content">
        <div class="row align-items-center center">
            <div class="col col-sm-8 mx-auto">
                <table id='empTable' class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Autor</th>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Conteudo</th>
                            <th>Data</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var table = $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                "lengthChange": false,
                'ajax': {
                    'url': 'ajax.php?filter=author'
                },
                "language": {
                    "search": "",
                    "searchPlaceholder": "Pesquisar por.."
                },
                //"bFilter": false, Remove search box
                'columns': [{
                        data: 'id'
                    },
                    {
                        data: 'author_id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'content'
                    },
                    {
                        data: 'date'
                    }
                ]
            });
            $('#empTable').ready(()=>{
                var filterDiv = $('<div class="col-sm-12 col-md-6">');
                filterDiv.html(`
                <form id="myForm">
                    <label>Autor
                        <input type="radio" id="author" name="filtro" value="author" checked>
                    </label>
                    <label>Titulo
                        <input type="radio" id="title" name="filtro" value="title">
                    </label>
                    <label>Data
                        <input type="radio" id="data" name="filtro" value="data">
                    </label>
                </form>
                `)
                .insertAfter('#empTable_wrapper div.col-md-6:nth-child(2)');
            });    

            $('#empTable').ready(()=>{
                $('#myForm input').on('change', function() {
                    table.ajax.url('ajax.php?filter='+$('input[name=filtro]:checked', '#myForm').val());
                    checkURL(); 
                });
            });      
            
            function checkURL(){
                console.log(table.ajax.url());
            }

        });
    </script>
</body>

</html>