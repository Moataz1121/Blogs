@extends('theme.master')
@section('title' , 'Blogs')


@section('content')

  <!--================ Hero sm banner start =================-->
 @include('theme.partial.hero', ['title' => 'My Blogs'])
  <!--================ Hero sm banner end =================-->

  <!-- ================ contact section start ================= -->
 <!-- ================ contact section start ================= -->
 <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
         My Blogs will be here
         @if (session('blogDeleteStatus'))
         <div class="alert alert-success">
             {{ session('blogDeleteStatus') }}
         </div>
     @endif
         <table class="table">
            <thead>
              <tr>
                <th scope="col" width = "5%">#</th>
                <th scope="col">Title</th>
                <th  scope="col" width = "15%" >Action</th>
              </tr>
            </thead>
            <tbody>

                    @foreach ($blogs as $key => $blog)
                       <tr>
                            <th scope="row">{{$key++}}</th>
                            <td>  <a target="_blank" href="{{route('blogs.show' , ['blog' => $blog])}}" >  {{$blog->name}}  </a>  </td>
                            <td>
                                 <a href="{{route('blogs.edit' , ['blog' => $blog])}}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                    <form class="d-inline" action="{{route('blogs.destroy' , ['blog' => $blog])}}" id="delete_form" method="post">
                                    @csrf
                                    @method('delete')

                                        <a href="javascript:$('form#delete_form').submit();" class="btn btn-sm btn-danger mr-2">Delete</a>

                                    </form>


                            </td>
                       </tr>

                    @endforeach

            </tbody>
          </table>
          @if (count($blogs) > 0)
          {{$blogs->render("pagination::bootstrap-4")}}

          @endif
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->
	<!-- ================ contact section end ================= -->
@endsection
