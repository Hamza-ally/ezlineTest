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
                        You can create default app products here.
                    </p>

                    <form id="product-create-form" method="POST" action="{{route('api.admin.products.create')}}">
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" min="1" max="100" placeholder="Quantity">
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
        </script>
        {{-- <script src="{{asset('js/swal.js')}}"></script> --}}
        <script src="{{asset('js/admin/products/create.js')}}"></script>
    </x-slot>

</x-app-layout>
