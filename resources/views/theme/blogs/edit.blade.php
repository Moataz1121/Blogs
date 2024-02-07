@extends('theme.master')
@section('title' , 'Edit')


@section('content')

  <!--================ Hero sm banner start =================-->
 @include('theme.partial.hero', ['title' => $blog->name])
  <!--================ Hero sm banner end =================-->

  <!-- ================ contact section start ================= -->
 <!-- ================ contact section start ================= -->
 <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
            @if (session('blogUpdateStatus'))
            <div class="alert alert-success">
                {{ session('blogUpdateStatus') }}
            </div>
        @endif
          <form action="{{ route('blogs.update' , ['blog' => $blog]) }}" class="form-contact contact_form"  method="post"  novalidate="novalidate" enctype="multipart/form-data">
         @csrf
         @method('PUT')

         <div class="form-group">
            <input class="form-control border" name="name" value="{{$blog->name}}" type="text" placeholder="Enter your Blogs">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

          </div>
             <div class="form-group">
            <input class="form-control border" name="image"  type="file" placeholder="Upload your image">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />

          </div>
              <div class="form-group">
            <select class="form-control border" name="category_id"  >

                <option value="">Select Category</option>
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" @if ($category->id == $blog->category_id)
                        selected
                    @endif>{{$category->name}}</option>
                    @endforeach
                @endif
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />

          </div>
          <div class="form-group">
            <textarea class="w-100 border" row(5) name="description" placeholder="Enter your Message">{{$blog->description}}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />

          </div>

            <div class="form-group text-center text-md-right mt-3">
              <button type="submit" class="button button--active button-contactForm">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->
	<!-- ================ contact section end ================= -->
@endsection