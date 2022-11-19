<html>
    <body>
        Halo {{ $user_otp->user->nama }}

        Klik link berikut untuk aktivasi 
        <a href="{{ route('aktivasi', [
            'user_id' => $user_otp->user_id,
            'token' => $user_otp->token
        ]) }}">Klik disini</a> 
    </body>
</html>