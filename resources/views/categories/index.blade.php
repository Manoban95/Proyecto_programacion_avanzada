<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-8">       
        </div>
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categorías') }}
            </h2>
        </div>
        <div class="col-md-4 col-12">
          <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addCategoryModal">
            Add Category
          </button>       
        </div>
      </div>     
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
              

              <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
                <th scope="col">Edit Category</th>
            </tr>
          </thead>
          <tbody>
            @if (isset($categories) && count($categories)>0)
            @foreach($categories as $category)
            <tr>
              <th scope="row">
                {{ $category->id }}
              </th>
              <td>
                {{ $category->name }}
              </td>
              <td>
                {{ $category->description }}
              </td>
              <td>

                <button   onclick="editCategory({{  $category->id }},'{{  $category->name }}','{{ $category->description }}', this)" class="btn btn-warning" data-toggle="modal" data-target="#editCategoryModal">
                  Edit Category
                </button>

                  <button onclick="removeCategory({{  $category->id }}, this)" class="btn btn-danger">
                    Remove
                  </button>
              </td>
            </tr>
            
            @endforeach
            @endif
          </tbody>
        </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('categories') }}">
          @csrf
          <div class="modal-body">
            
             <div class="form-group">
            <label for="exampleInputEmail1">Name</label>   
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" placeholder="Category" id="input_name" name="name" aria-label="Category" aria-describedby="basic-addon1"></div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input class="form-control" rows="5" placeholder="description of de category" id="input_description" name="description">
            </div>
            
          </div>



        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save category</button>
        </div>
        </form>
      </div>
    </div>
  </div>


 <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('categories') }}">
          @csrf
          @method('PUT')

          <div class="modal-body">
            
             <div class="form-group">
                <label for="exampleInputEmail1">Name</label>   
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" placeholder="Category" id="name" name="name" aria-label="Category" aria-describedby="basic-addon1"></div>
             </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input class="form-control" rows="5" placeholder="description of de category" id="description" name="description">
            </div>
            
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save category</button>

          <input type="hidden" name="id" id="id">

        </div>
        </form>
      </div>
    </div>
  </div>

   <x-slot name="scripts">
    <script type="text/javascript">
       
        function editCategory(id,name,description){
              $("#name").val(name)
              $("#description").val(description)
              $("#id").val(id)
            
        }

         
        function removeCategory(id,target){
        swal({
          title: "¿Está seguro que quiere eliminar la categoría?",
          text: "Una vez eliminada no se podrá recuperar",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            axios.delete('{{ url('categories') }}/'+id, {
              id: id,
              _token: '{{ url( csrf_token() ) }}'
            })
            .then(function (response) {
              if(response.data.code==200){
                swal(response.data.message, {
                  icon: "success",
                });

                $(target).parent().parent().remove()
              }else{
                swal(response.data.message, {
                  icon: "error",
                });
              }
            })
            .catch(function (error) {
              swal('Error ocurred',{ icon:'error'});
              console.log(error);
            });

            
          }
        });
      }
    </script>     
    </x-slot>




</x-app-layout>