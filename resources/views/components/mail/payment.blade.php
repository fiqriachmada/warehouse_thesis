<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>Transaction Information</title> --}}
    <style>
        /* Style CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h3 {
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Transaction Information</h2>
        
        <!-- Customer Detail -->
        <div class="section">
            <h3>Customer Detail</h3>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>{{ $customer_detail['first_name'] }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $customer_detail['email'] }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $customer_detail['phone'] }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $customer_detail['billing_address'] }}</td>
                </tr>
            </table>
        </div>

        <!-- Product Detail -->
        <div class="section">
            <h3>Rental Detail</h3>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subscription</th>
                </tr>
                @foreach ($item_details as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>@rupiah($item['price'])</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['subscription'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>

        <!-- Transaction Detail -->
        <div class="section">
            <h3>Transaction Detail</h3>
            <table class="table">
                <tr>
                    <th>Order ID</th>
                    <td>{{ $transaction_detail['order_id'] }}</td>
                </tr>
                <tr>
                    <th>Gross Amount</th>
                    <td>@rupiah($transaction_detail['gross_amount']) (Incl. Tax {{ $transaction_detail['tax_amount'] }}%)</td>
                </tr>
            </table>
        </div>

        <!-- Payment Detail -->
        <div class="section">
            <h3>Payment Detail</h3>
            <table class="table">
                <tr>
                    <th>Payment Status</th>
                    <td>{{ $status }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
