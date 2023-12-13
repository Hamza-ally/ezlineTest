<x-app-layout>

    <x-slot name="headerStyles">

    </x-slot>
    <x-slot name="headerScripts">

    </x-slot>

    <x-slot name="title">
        Products | Ezline
    </x-slot>

    <x-slot name="header_menu">

    </x-slot>

    <div class="page-header">
        <h3 class="page-title">
            Products
        </h3>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card offset-sm-2">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Products</h4>

                    <p class="card-description">
                        You can edit default app products here.
                    </p>

                    <form id="product-edit-form" method="POST" action="{{route('api.admin.products.edit', ['id' => $product['id']])}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$product['name']}}">
                        </div>
                    
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="quantity" value="{{$product['quantity']}}">
                        </div>
                    
                        <br>
                    
                        <button type="submit" class="btn btn-sm btn-block btn-primary btn-icon-text float-center">
                            <i class="far fa-check-square btn-icon-prepend"></i>
                            Submit
                        </button>
                    
                    </form>
                </div>
            </div>

        </div>
    </div>

    <x-slot name="footerScripts">
        <script>
            const _user = @json(Auth::user());
            const product_id = @json($product['id']);
        </script>
        {{-- <script src="{{asset('js/swal.js')}}"></script> --}}
        <script src="{{asset('js/admin/products/edit.js')}}"></script>
    </x-slot>

</x-app-layout>
