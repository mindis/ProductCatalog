@extends('ProductCatalog::layouts.interface-single')

@section('title')
    Create New Product
@stop

@section('content')

    <ul class="breadcrumb">
      <li><a href="{{ url('manage/products') }}">Products</a> <span class="divider">/</span></li>
      <li class="active">New Product</li>
    </ul>

    <h1>Create New Product</h1>
    @include('ProductCatalog::partials.messaging')
    {{ Form::open( [ 'url' => 'manage/products/new' , 'class' => 'form-horizontal' ] ) }}
        <fieldset>
            <legend>Basic Information</legend>

            <div class="control-group">
                <label class="control-label" for="inputTitle">Title</label>
                <div class="controls">
                    <input type="text" id="inputTitle" name="title" placeholder="Product Title" value="{{ Input::old('title') }}" >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPrice">Price</label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on">&pound;</span>
                        <input type="text" id="inputPrice" name="price" placeholder="Price" value="{{ Input::old('price') }}" >
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputURL">URL</label>
                <div class="controls">
                    <input type="text" id="inputURL" name="url" placeholder="Product URL" value="{{ Input::old('url') }}" >
                    <span class="help-block"><strong>Note:</strong> This must be unique.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputSKU">SKU</label>
                <div class="controls">
                    <input type="text" id="inputSKU" name="sku" placeholder="Product SKU" value="{{ Input::old('sku') }}" >
                    <span class="help-block"><strong>Note:</strong> This must be unique.</span>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary"><span class="icon-plus icon-white"></span> Add New Product</button>
                </div>
            </div>
        </fieldset>
    {{ Form::close() }}

@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function(){

            // When the title of the new product is changed, also slugify it and change the URL / SKU to match
            $('#inputTitle').bind('keyup',function(){
                var str = $(this).val();
                str = str.replace(/[^a-zA-Z0-9\s]/g,"");
                str = str.toLowerCase();
                str = str.replace(/\s/g,'-');
                console.log(str);
                $('#inputSKU,#inputURL').val(str);
            });

        });
    </script>
@stop

@section('sidebar')

<!--     <div class="well well-small">
        <h4>More Information</h4>
        <p><strong>SKU: </strong>SKU's must be unique to the product catalog.</p>
        <p><strong>Price: </strong>Prices should be specified without VAT or delivery costs (this will be added where required).</p>
    </div> -->

@stop