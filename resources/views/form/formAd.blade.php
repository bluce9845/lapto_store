<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Ad</title>
</head>

<body>
    <form action="{{ route('store.product') }}" method="POST">
        @csrf
        <ul>
            <li>
                <label for="name">Name Produk</label>
                <input type="text" name="name" id="name">
            </li>
            <li>
                <label for="description">Description</label>
                <input type="text" name="description" id="description">
            </li>
            <li>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" step="0.01">
            </li>
            <li>
                <label for="stock">Stock</label>
                <input type="integer" name="stock" id="stock">
            </li>

            <button type="submit">Submit</button>
        </ul>
    </form>
</body>

</html>
