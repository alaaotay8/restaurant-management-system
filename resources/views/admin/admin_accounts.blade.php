{{-- filepath: resources/views/admin/admin_accounts.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admins Accounts</title>
   <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
   <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>

@include('components.admin_header')

<!-- Admins accounts section starts -->
<section class="accounts">
   <h1 class="heading">Admins Account</h1>

   <div class="box-container">
      @foreach ($admins as $admin)
         <div class="box">
            <p>Username: <span>{{ $admin->name }}</span></p>
            {{-- Uncomment below to show email --}}
            {{-- <p>Email: <span>{{ $admin->email }}</span></p> --}}
            <div class="flex-btn">
               @if ($admin->id == $currentAdminId)
                  <!-- Only allow update for the current admin -->
                  <a href="{{ route('profile.edit') }}" class="option-btn">Update</a>
               @else
                  <div class="bg-light mt-5 h-10" style="height: 5.5em;"></div>
               @endif
               <!-- Delete admin account -->
               <form action="{{ route('profile.delete', $admin->id) }}" method="POST" onsubmit="return confirm('Delete this account?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete-btn">Delete</button>
               </form>
            </div>
         </div>
      @endforeach

      @if ($admins->isEmpty())
         <p class="empty">No accounts available</p>
      @endif
   </div>

   <!-- Register new admin button -->
   <div class="register-btn-container" style="display: flex; justify-content: center; margin: 20px 0;">
      <a href="{{ route('admin.register') }}" class="option-btn register-btn" style="width: 300px; margin: 0 10px;">Register new admin</a>
   </div>
</section>
<!-- Admins accounts section ends -->

<!-- Custom JS file -->
<script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>
