<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        input[type="text"] {
            border: none;
            background-color: transparent;
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
            color: white !important;
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
            var count = 1;
            var createdInvoice = {};

            $("#add_row").click(function () {
                count++;
                $("#invoice_table").append(
                    "<tr>" +
                    "<td><input name='description' type='text'></input></td>" +
                    "<td class='column-border text-center pt-1'><input name='taxed' type='checkbox'></td>" +
                    "<td class='column-border text-right'><input class='text-right' name='amount' type='text'></input></td>" +
                    "</tr>"
                );
            });

            $("#remove_row").click(function () {
                if (count > 0) {
                    $("#invoice_table tr:last").remove();
                    count--;
                }

            });

            $("#invoice_table").on('change', 'input[name="amount"], input[name="taxed"]', function () {
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

            $("#submitInvoice").click(function (e) {
                e.preventDefault();

                var products = [];
                $("#invoice_table tbody tr").each(function () {
                    var product = {};
                    product['description'] = $(this).find("input[name='description']").val();
                    product['taxed'] = $(this).find("input[name='taxed']").prop("checked");
                    product['amount'] = $(this).find("input[name='amount']").val();
                    if (product.description !== '' && product.description !== undefined) {
                        products.push(product);
                    }

                });

                var request = {};
                var invoice = {};
                var customer = {};

                customer['name'] = $("input[name='customer_name']").val();
                customer['company'] = $("input[name='company_name']").val();
                customer['address'] = $("input[name='street_address']").val();
                customer['city'] = $("input[name='city']").val();
                customer['phone'] = $("input[name='phone_number']").val();
                customer['fax'] = $("input[name='fax_number']").val();
                customer['website'] = $("input[name='website']").val();
                customer['zipcode'] = $("input[name='zipcode']").val();
                customer['email'] = $("input[name='email']").val();
                customer['state'] = $("input[name='state']").val();
                customer['country'] = $("input[name='country']").val();

                request['customer'] = customer;

                invoice['date'] = $("input[name='invoice_date']").val();
                invoice['due_date'] = $("input[name='due_date']").val();
                invoice['tax_rate'] = $("input[name='tax_rate']").val();

                request['invoice'] = invoice;

                request['products'] = products;

                $.ajax({
                    type: "POST",
                    url: "/create",
                    data: JSON.stringify(request),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function (data) {
                        alert("Invoice created successfully!");
                        window.location = "/";
                    },
                    error: function (err) {
                        console.log("Error creating invoice");
                    }
                });
            });
        });
    </script>
</head>