@extends('layouts.app')
@section('content')
<main class="container">
    <form method="post" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <section>
            <div class="titlebar">
                <h1>Edit Product</h1>
                <button>Save</button>
            </div>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>
                            {{ $error}}
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div>
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $product->name }}">
                    <label>Description (optional)</label>
                    <textarea cols="10" rows="5" name="description" value="{{ $product->description }}" >{{ $product->description }}</textarea>
                    <label>Add Image</label>
                    <img src="{{ asset('images/'.$product->image) }}" alt="" class="img-product" id="file-preview" />
                    <input type="hidden" name="hidden_product_image" value="{{ $product->image }}" >
                    <input type="file" name="image" accept="images/*" onchange="showFile(event)">
                </div>
                <div>
                    <label>Category</label>
                    <select  name="category" >
                        @foreach (json_decode('{"Smartphone":"Smartphone","Smart TV":"Smart TV","Computer":"Computer"}',true) as $optienKey=>$optionValue)
                        <option value="{{$optienKey}}" {{ (isset($product->category) && $product->category == $optienKey) ? 'selected' : '' }}>{{$optionValue}}</option>
                        @endforeach
                    </select>
                    <hr>
                    <label>Inventory</label>
                    <input type="text" name="quantity" value="{{ $product->quantity }}" >
                    <hr>
                    <label>Price</label>
                    <input type="text" name="price" value="{{ $product->price }}" >
                </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <input type="hidden" name="hidden_id" value="{{ $product->id }}" >
                <button>Save</button>
            </div>
        </section>
</form>
</main>
<script>
    function showFile(event){
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('file-preview');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endsection