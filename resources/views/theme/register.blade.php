@extends('theme.master')
@section('title' , 'Register')


@section('content')

  <!--================ Hero sm banner start =================-->
 @include('theme.partial.hero', ['title' => 'Register'])
  <!--================ Hero sm banner end =================-->

  <!-- ================ contact section start ================= -->
 <!-- ================ contact section start ================= -->
 <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form action="{{ route('register-post') }}" class="form-contact contact_form" action="contact_process.php" method="post"  novalidate="novalidate">
         @csrf
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <input class="form-control border" name="name" value="{{old('name')}}" type="text" placeholder="Enter your name">
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />

                </div>
                <div class="form-group">
                  <input class="form-control border" name="email" value="{{old('email')}}" type="email" placeholder="Enter email address">
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input class="form-control border" name="password" type="password" placeholder="Enter your password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>
                <div class="form-group">
                  <input class="form-control border" name="password_confirmation" type="password" placeholder="Enter your password confirmation">
                  <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                </div>
              </div>
            </div>
            <div class="form-group text-center text-md-right mt-3">
                <a class="mx-3" href="{{route('login')}}">Aleardy Register ? </a>
              <button type="submit" class="button button--active button-contactForm">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->
	<!-- ================ contact section end ================= -->
@endsection
