 @component('mail::message')
     {{-- Header --}}
     @slot('header')
         @component('mail::header', ['url' => 'http://localhost/bilqolam/'])
             Registrasi Akun Bilqolam Berhasil!
         @endcomponent
     @endslot

     {{-- Body --}}
     # Akun Bilqolam Anda

     Email = {{ $email }}
     Password = {{ $password }}


     {{-- Footer --}}
     @slot('footer')
         @component('mail::footer')
             © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
         @endcomponent
     @endslot
 @endcomponent
