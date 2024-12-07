<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    @php
        $orderid = App\Models\Order::where('customer_id', 1)->value('order_number');
    @endphp

    <div class="m-4">
        <h3>Upload Payment Receipt</h3>
        <form action="{{ route('uploadReceipt') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="order_number" value={{ $orderid }}>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Receipt</label>
                <input type="file" class="form-control" name="receipt">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success btn-sm">Submit</button>
            </div>
        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
