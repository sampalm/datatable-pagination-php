<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatable Example</title>
    <!-- Datatable CSS -->
    <link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <!-- Table -->
    <table id='empTable' class='display dataTable'>

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

    <script>
        $(document).ready(function() {
            $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': 'ajax.php'
                },
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
        });
    </script>
</body>

</html>