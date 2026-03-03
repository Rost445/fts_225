 @extends('layouts.admin')
 @push('styles')
     <style>
         .table thead th,
         .table td {
             margin: auto !important;
             vertical-align: middle;
             text-align: center;
         }

         .list-icon-function {
             justify-content: center;
         }
     </style>
 @endpush

 @section('content')
     <div class="main-content-inner">
         <div class="main-content-wrap">
             <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                 <h3>{{ $header_title }}</h3>
                 <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                     <li>
                         <a href="{{ route('admin.index') }}">
                             <div class="text-tiny"> Адмін-панель</div>
                         </a>
                     </li>
                     <li>
                         <i class="icon-chevron-right"></i>
                     </li>
                     <li>
                         <div class="text-tiny">{{ $header_title }}</div>
                     </li>
                 </ul>
             </div>

             <div class="wg-box">
                 <div class="flex items-center justify-end gap10 flex-wrap">
                     @if(session('success'))
    <div class="alert alert-success"  role="alert">
        {{ session('success') }}
    </div>
@endif
                     <a class="tf-button style-1 w208" href="{{ route('admin.slide.add') }}"><i class="icon-plus"></i>Додати слайд

                     </a>
                 </div>
                 <div class="wg-table table-all-user">
                    <div class="table-responsive"> <table class="table table-striped table-bordered">
                         <thead>
                             <tr>
                                 <th>№</th>
                                 <th> Зображення</th>
                                 <th>Слоган</th>
                                 <th>Заголовок</th>
                                 <th>Підзаголовок</th>
                                 <th>Посилання</th>
                                    <th>Статус</th>
                                 <th>Дії</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($slides as $slide)
                                 <tr>
                                     <td>{{ $slide->id }}</td>
                                     <td class="pname">
                                         <div class="image">
                                             <img src="{{ asset('uploads/slides/' . $slide->image) }}" alt="{{ $slide->title }}" class="image">
                                         </div>
                                     </td>
                                     <td>{{ $slide->tagline }}</td>
                                     <td>{{ $slide->title }}</td>
                                     <td>{{ $slide->subtitle }}</td>
                                     <td>{{ $slide->link }}</td>
                                     <td>{{ $slide->status == 1 ? 'Активний' : 'Неактивний' }}</td>
                                     <td>
                                         <div class="list-icon-function">
                                             <a href="{{ route('admin.slide.edit', $slide->id) }}">
                                                 <div class="item edit">
                                                     <i class="icon-edit-3"></i>
                                                 </div>
                                             </a>
                                             <form action="{{ route('admin.slide.delete', 
                                             $slide->id) }}" method="POST">
                                                 @csrf
                                                  @method('DELETE')
                                                 <input type="hidden" name="_token"
                                                     value="{{ csrf_token() }} " autocomplete="off">
                                                 <input type="hidden" name="_method" value="DELETE">
                                                 <div class="item text-danger delete">
                                                     <i class="icon-trash-2"></i>
                                                 </div>
                                             </form>
                                         </div>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                    </div>
                 </div>
                 <div class="divider"></div>
                 <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
{{ $slides->links('pagination::bootstrap-5') }}
                 </div>
             </div>
         </div>
     </div>
 @endsection

 @push('scripts')
     <script>
          $(function() {
                 $('.delete').on('click', function(e) {
                     e.preventDefault();

                     let form = $(this).closest('form');

                     swal({
                         title: "Ви впевнені?",
                         text: "Цю дію не можна буде скасувати!",
                         icon: "warning",
                         buttons: ["Скасувати", "Видалити"],
                         dangerMode: true,
                     }).then(function(willDelete) {
                         if (willDelete) {
                             form.submit();
                         }
                     });
                 });
             }); 
     </script>
 @endpush
