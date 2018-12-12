<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>

<table>
@foreach($products as $product)
    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>
            <form method="POST" action="/admin/products-delete">
                @csrf

                @method('DELETE')

                <input type="hidden" name="id" value="{{$product->id}}" />
                <input type="submit" value="delete" />
            </form>
        </td>
    </tr>
@endforeach
</table>
</body>
</html>