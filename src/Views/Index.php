<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">


        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Customer Name</th>
                    <th>Invoice Date</th>
                    <th>Tax rate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoices as $invoice): ?>
                    <tr>
                        <td>
                            <?php echo $invoice['invoice_id']; ?>
                        </td>
                        <td>
                            <?php echo $invoice['customer_name']; ?>
                        </td>
                        <td>
                            <?php echo $invoice['date']; ?>
                        </td>
                        <td>
                            <?php echo $invoice['tax_rate']; ?>
                        </td>
                        <td>
                            <a href="/invoice-view/<?php echo $invoice['invoice_id']; ?>"
                                class="btn btn-info btn-sm">View</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="fixed-bottom bg-light d-flex justify-content-between p-3">
        <div class="text-right">
            <a href="/invoice/create" class="btn btn-primary">Create New Invoice</a>
        </div>
    </div>
</body>

</html>