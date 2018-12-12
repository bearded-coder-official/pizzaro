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

<form action="" method="POST" enctype="multipart/form-data">
    @csrf

    @if ($errors->any('name'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('name') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <input type="text" name="name" placeholder="Product Name" value="{{ old('name', $product->name) }}" />

    <br>

    @foreach($menu as $m)
        <input type="radio" name="menu" value="{{ $m->id }}" @if($m->id == old('menu', $product->menu_id)) checked="checked" @endif> {{ $m->name }} <br>
    @endforeach

    <br>

    @if ($errors->any('description'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('description') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <textarea name="description" id="" cols="30" rows="10" placeholder="Product Description">{{ old('description', $product->description) }}</textarea>
    <br>
    @if ($errors->any('image'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('image') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <input type="file" name="image" />
    <input type="hidden" name="id" value="{{ old('id', $product->id) }}" />
    <br>
    <input type="submit" value="Save" />
</form>

</body>
</html>