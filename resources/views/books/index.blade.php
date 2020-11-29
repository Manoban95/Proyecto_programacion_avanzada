

<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Books') }}
            </h2>
        </div>
        <div class="col-md-4 col-12">
          @php
          $user = auth()->user();
          @endphp
           @if (Auth::user()->hasPermissionTo('add books')) 
                   <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addBookModal">
                    Add Book
                  </button>       


           @endif
          
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
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Category</th>
              <th scope="col">Disponibilidad</th>
              <th scope="col"></th>
              @if(Auth::user()->hasPermissionTo('update books'))
              <th scope="col">Editar/Eliminar</th>
              @endif

            </tr>
          </thead>
          <tbody>


            @if (isset($books) && count($books)>0)
            @foreach($books as $book)
            <tr>
              <th scope="row">
                {{ $book->id }}
              </th>
              <td>
                {{ $book->title }}
              </td>
              <td>
                {{ $book->description }}
              </td>
              <td>
                {{ $book->Category_id }}
              </td>
              <td>
              @if (isset($books) && $book->disponibilidad==1)
                  <span clas="badge badge-success">
                    Disponible
                  </span>
                  @else
                    <span clas="badge badge-success">
                      No disponible
                    </span>
              @endif
              </td>
              <td>
                  <button onclick="requestBook({{  $book->id }},{{  $user->id }})" class="btn btn-success" @if($book->disponibilidad==0) disabled @endif>
                    Solicitar
                  </button> 
              </td>
              @if(Auth::user()->hasPermissionTo('update books'))
              <td>
                <button   onclick="editBook({{  $book->id }}, '{{  $book->tittle }}', '{{  $book->description }}', {{  $book->year }}, {{  $book->pages }}, '{{  $book->isbn }}', '{{  $book->editorial }}', {{  $book->edition }}, '{{  $book->autor }}', {{  $book->Category_id }})" class="btn btn-warning" data-toggle="modal" data-target="#editBookModal">
                  Edit book
                </button>

                  <button onclick="removeBook({{  $book->id }})" class="btn btn-danger">
                    Remove
                  </button>
              </td>
              @endif

                

            </tr>
            
            @endforeach
            @endif
          </tbody>
        </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new Book</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ url('books')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Title</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" name="title" id="input_tittle" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book title.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <textarea class="form-control" id="input_description" name="description" aria-label="With textarea"></textarea>
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book title.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Year</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="input_year" name="year" class="form-control" placeholder="year" aria-label="year" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="bookYear" class="form-text text-muted">Book year.</small>
                        </div>
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Pages</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="input_pages" name="pages" class="form-control" placeholder="Pages" aria-label="Pages" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book pages.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">ISBN</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" name="isbn" id="input_isbn" class="form-control" placeholder="ISBN" aria-label="ISBN" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book ISBN.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Editorial</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="input_editorial" name="editorial" class="form-control" placeholder="Editorial" aria-label="Editorial" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Editorial.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Edition</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="input_edition" name="edition" class="form-control" placeholder="Edition" aria-label="Edition" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Edition.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Autor</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="input_autor" name="autor" class="form-control" placeholder="Autor" aria-label="Autor" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Autor.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Cover</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="file" id="input_cover" id="input_cover" name="cover" class="form-control" name="cover">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Cover Image.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Category</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <select class="form-control" id="input_category" name="input_category_id">
                                @if (isset($categories) && count($categories)>0)
                                @foreach ($categories as $category)

                                <option value="{{ $category->id }}"> {{ $category->name }}</option>

                                @endforeach
                                @endif
                              </select>
                            </div>                          
                        </div>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
          
        </div>
      </div>
    </div>

    <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit book</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ url('books')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Title</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="tittle" name="title" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book title.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <textarea class="form-control" id="description" name="description" aria-label="With textarea"></textarea>
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book title.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Year</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="year" name="year" class="form-control" placeholder="year" aria-label="year" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="bookYear" class="form-text text-muted">Book year.</small>
                        </div>
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Pages</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="pages" name="pages" class="form-control" placeholder="Pages" aria-label="Pages" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book pages.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">ISBN</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" name="isbn" id="isbn" class="form-control" placeholder="ISBN" aria-label="ISBN" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book ISBN.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Editorial</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="editorial" name="editorial" class="form-control" placeholder="Editorial" aria-label="Editorial" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Editorial.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Edition</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="edition" name="edition" class="form-control" placeholder="Edition" aria-label="Edition" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Edition.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Autor</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="autor" name="autor" class="form-control" placeholder="Autor" aria-label="Autor" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Autor.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Cover</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="file" id="cover" name="cover" class="form-control" name="cover">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Cover Image.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Category</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <select class="form-control" id="category" name="category">
                                @if (isset($categories) && count($categories)>0)
                                @foreach ($categories as $category)

                                <option value="{{ $category->id }}"> {{ $category->name }}</option>

                                @endforeach
                                @endif
                              </select>
                            </div>                          
                        </div>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
          
        </div>
      </div>
    </div>

    <script>
      function requestBook(idBook,idUser,target){

            swal({
           title :" ¿Está seguro? ",
           text :" ¿Está seguro que quiere pedir este libro? ",
           icon :"warning",
            buttons : true,
            dangerMode: true,
            })
            .then((willDelete) =>{

              if(willDelete){
                axios.delete('{{  url('book') }}/'+id,{

                  id: id,
                  _token: '{{  csrf_token()  }}'
                })
                .then(function(response){
                  
                  if(response.data.code==200){
                    swal(response.data.message ,{
                       icon: "sucess"
                    });
                    $(target).parent().parent().remove();
                  }
                })
                .catch(function (error){
                   
                   swal('Error ocurred');

                });
              }

            });
        }

      function editBook(id,tittle,description,year,pages,isbn,editorial,edition,autor,category){
            console.log(autor);

            $("#tittle").val(tittle);
            $("#description").val(description);
            $("#year").val(year);
            $("#pages").val(pages);
            $("#isbn").val(isbn);
            $("#editorial").val(editorial);
            $("#edition").val(edition);
            $("#autor").val(autor);
            $("#category").val(category);
        }
         
      function removeBook(id,target){
            swal({
           title :" ¿Esta seguro?",
           text :" Se va a eliminar el libro de la base de datos ",
           icon :"warning",
            buttons : true,
            dangerMode: true,
            })
            .then((willDelete) =>{

              if(willDelete){ 
                axios.delete('{{  url('books') }}/'+id,{

                  id: id,
                  _token: '{{  csrf_token()  }}'
                })
                .then(function(response){
                  
                  if(response.data.code==200){
                    swal(response.data.message ,{
                       icon: "sucess"
                    });
                    $(target).parent().parent().remove();
                  }
                })
                .catch(function (error){
                   
                   swal('Error ocurred');

                });
              }

            });
        }
    </script>
    
</x-app-layout>