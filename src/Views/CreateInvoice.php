<?php
include 'header.php';
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 id="company_name">Company Name</h1>
                <table class="table table-borderless company-information">
                    <tr>
                        <td><input type="text" placeholder="[Street Address]"></input></td>
                    </tr>
                    <tr>
                        <td><input name="city" type="text" placeholder="[City]"></input></td>
                    </tr>
                    <tr>
                        <td><input name="zipcode" type="text" placeholder="[ZIP]"></input></td>
                    </tr>
                    <tr>
                        <td><input name="state" type="text" placeholder="State"></input></td>
                    </tr>
                    <tr>
                        <td><input name="country" type="text" placeholder="Country"></input></td>
                    </tr>
                    <tr>
                        <td><input name="phone_number" type="text" placeholder="Phone: [000-000-000]"></input></td>
                    </tr>
                    <tr>
                        <td><input name="fax_number" type="text" placeholder="Fax: [000-000-000]"></input></td>
                    </tr>
                    <tr>
                        <td><input name="website" type="text" placeholder="Website: someedomain.com"></input></td>
                    </tr>
                    <tr>
                        <td><input name="email" type="text" placeholder="email: hi@someedomain.com"></input></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h1 style="text-align: right">Invoice</h1>
                <table class="table invoice-details">
                    <tr>
                        <td class="col-md-8" style="text-align: right">DATE</td>
                        <td class="col-md-4 table-outer-border text-center"><input name="invoice_date" type="date"
                                placeholder="[Street Address]"></input></td>
                    </tr>
                    <tr>
                        <td class="col-md-8" style="text-align: right">INVOICE #</td>
                        <td class="col-md-4 table-outer-border text-center"><input name="invoice_id" type="text"
                                placeholder="[123]" disabled></td>
                    </tr>
                    <tr>
                        <td class="col-md-8" style="text-align: right">CUSTOMER ID</td>
                        <td class="col-md-4 table-outer-border text-center"><input name="customer_id" type="text"
                                placeholder="[123]" disabled></td>
                    </tr>
                    <tr>
                        <td class="col-md-8 text-right" style="text-align: right">DUE DATE</td>
                        <td class="col-md-4 table-outer-border text-center"><input name="due_date" type="date"
                                placeholder="[Street Address]"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless company-information">
                    <th class="blue-th">BILL TO</th>
                    <tr>
                        <td><input name="customer_name" type="text" placeholder="[Name]"></input></td>
                    </tr>
                    <tr>
                        <td><input name="company_name" type="text" placeholder="[Company Name]"></input></td>
                    </tr>
                    <tr>
                        <td><input name="street_address" type="text" placeholder="[Street Address]"></input></td>
                    </tr>
                    <tr>
                        <td><input name="city" type="text" placeholder="[City, St Zip]"></input></td>
                    </tr>
                    <tr>
                        <td><input name="phone" type="text" placeholder="[Phone]"></input></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="invoice_table" class="table table-striped table-outer-border invoice-table">
                    <th class="blue-th text-center col-md-8">DESCRIPTION</th>
                    <th class="blue-th text-center col-md-2">TAXED</th>
                    <th class="blue-th text-center col-md-2">AMOUNT</th>
                    <tr>
                        <td><input name='description' type='text'></input></td>
                        <td class="column-border text-center pt-1"><input name='taxed' type="checkbox"></td>
                        <td class="column-border text-right"><input class="text-right" name='amount'
                                type='text'></input></td>
                    </tr>
                </table>
                <a id="add_row" class="btn btn-primary">Add Row</a>
                <a id="remove_row" class="btn btn-danger remove_row">Remove Row</a>
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
        <div class="text-right">
            <a id="submitInvoice" class="btn btn-primary">Save Invoice</a>
        </div>
    </div>
    <?php
    include 'footer.php';