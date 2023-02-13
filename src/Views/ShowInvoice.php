<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        input[type="text"] {
            border: none;
        }

        table {
            border-spacing: 0;
        }

        .company-information {
            border-bottom-width: 0;
            padding: 0;
            box-shadow: 0;
        }

        .company-information td {
            padding: 0;
        }

        .blue-th {
            background-color: #3F00FF !important;
            color: white;
        }

        .column-border {
            border-right: 1px solid black;
            border-left: 1px solid black;
        }

        .table-outer-border {
            border: 1px solid black;
            border-bottom: 1px solid black !important
        }

        .invoice-table td {
            padding: 0
        }

        .invoice-details td {
            border-bottom: none;
        }

        .text-right {
            text-align: right !important
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            var subtotal = 0;
                var tax_due = 0;
                var taxable = 0;
                var total = 0;
                var tax_rate = $("input[name='tax_rate']").val();

                $("#invoice_table tbody tr").each(function () {
                    var amount = $(this).find("input[name='amount']").val();
                    var taxed = $(this).find("input[name='taxed']").prop("checked");

                    if (amount !== '' && !isNaN(amount)) {

                        if (taxed !== undefined && taxed) {
                            tax_due += parseFloat(amount * (tax_rate / 100));
                            taxable += parseFloat(amount);
                        }

                        subtotal += parseFloat(amount);
                    }
                });

                total += parseFloat(subtotal + tax_due);

                $("#subtotal").text(subtotal.toFixed(2));
                $("#tax_due").text(tax_due.toFixed(2));
                $("#taxable").text(taxable.toFixed(2));
                $("#total").text(total.toFixed(2));
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 id="company_name">
                    <?php echo $invoice['company_name']; ?>
                </h1>
                <table class="table table-borderless company-information">
                    <tr>
                        <td>
                            <?php echo $invoice['street_address']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['city']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['zipcode']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['state']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['country']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['phone_number']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['fax_number']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['website']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['email']; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h1 style="text-align: right">Invoice</h1>
                <table class="table invoice-details">
                    <tr>
                        <td class="col-md-8" style="text-align: right">DATE</td>
                        <td class="col-md-4 table-outer-border text-center">
                            <?php echo $invoice['date']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-8" style="text-align: right">INVOICE #</td>
                        <td class="col-md-4 table-outer-border text-center">
                            <?php echo $invoice['invoice_id']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-8" style="text-align: right">CUSTOMER ID</td>
                        <td class="col-md-4 table-outer-border text-center">
                            <?php echo $invoice['customer_id']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-8 text-right" style="text-align: right">DUE DATE</td>
                        <td class="col-md-4 table-outer-border text-center">
                            <?php echo $invoice['due_date']; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless company-information">
                    <th class="blue-th">BILL TO</th>
                    <tr>
                        <td>
                            <?php echo $invoice['customer_name']; ?></input>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['company_name']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['street_address']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['city']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $invoice['phone_number']; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="invoice_table" class="table table-outer-border invoice-table">
                    <th class="blue-th text-center col-md-8">DESCRIPTION</th>
                    <th class="blue-th text-center col-md-2">TAXED</th>
                    <th class="blue-th text-center col-md-2">AMOUNT</th>
                    <?php foreach ($invoiceItems as $invoiceItem): ?>
                        <tr>
                            <td>
                                <?php echo $invoiceItem['product_description']; ?>
                            </td>
                            <td class="column-border text-center pt-1">
                                <input name='taxed' type="checkbox" <?php echo ($invoiceItem['taxed']) ? 'checked' : ''; ?>
                                    disabled>
                            </td>
                            <td class="column-border text-right">
                                <input class="text-right" name='amount' type='text'
                                    value="<?php echo $invoiceItem['amount']; ?>" disabled></input>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless table-outer-border company-information mt-5">
                    <th class="blue-th">OTHER COMMENTS</th>
                    <tr>
                        <td>1. Total payment due in 30 days</td>
                    </tr>
                    <tr>
                        <td>2. Please include the invoice number on your check</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <table style="margin-bottom: 100px" class="table ">
                    <tr>
                        <td class="col-md-6">Subtotal</td>
                        <td class="col-md-6 text-right"><span id="subtotal">0</span></td>
                    </tr>
                    <tr>
                        <td class="col-md-6">Taxable</td>
                        <td class="col-md-6 text-right"><span id="taxable">0</span></td>
                    </tr>
                    <tr>
                        <td class="col-md-6">Tax rate</td>
                        <td class="col-md-6 text-right"><input class="text-right" name='tax_rate' type='text'
                                value="6.25" placeholder="6.25"></input></td>
                    </tr>
                    <tr>
                        <td class="col-md-6">Tax due</td>
                        <td class="col-md-6 text-right"><span id="tax_due">0</span></td>
                    </tr>
                    <tr>
                        <td class="col-md-6">Total</td>
                        <td class="col-md-6 text-right"><span id="total">0</span></td>
                    </tr>
                </table>

                <div>
                    <p>Make all checks payable to</p>
                    <span class="companyname"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom bg-light d-flex justify-content-between p-3">
        <div class="text-left">
            <a href="/" class="btn btn-secondary">Back to Invoices</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>