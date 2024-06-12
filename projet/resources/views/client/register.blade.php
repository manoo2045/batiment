<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!---Custom CSS File--->
    <link rel="stylesheet" href="assets/css/client_register.css" />
</head>
<body>
<section class="container">
    <header>Registration Form</header>
    <form action="{{ url('/client/register') }}" method="post" class="form">
        @csrf
        <div class="input-box">
            <label> Nom</label>
            <input name="nom" type="text" placeholder="Enter full name" value="{{ old('nom') }}"  />
            @error('nom')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-box">
            <label>Prenom</label>
            <input type="text" name="prenom" placeholder="Enter full name" value="{{ old('prenom') }}"  />
            @error('prenom')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-box">
            <label>Addresse Email</label>
            <input name="email" type="text" placeholder="Enter email address" value="{{ old('email') }}"  />
            @error('email')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="column">
            <div class="input-box">
                <label>Contact</label>
                <input name="contact" type="number" placeholder="Enter phone number" value="{{ old('contact') }}"  />
                @error('contact')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="column">
            <div class="gender-box">
                <h3>Genre</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input value="male" type="radio" id="check-male" name="genre" {{ old('genre') === 'male' ? 'checked' : '' }}>
                        <label for="check-male">male</label>
                    </div>
                    <div class="gender">
                        <input value="female" type="radio" id="check-female" name="genre" {{ old('genre') === 'female' ? 'checked' : '' }}>
                        <label for="check-female">Female</label>
                    </div>
                </div>
                @error('genre')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-box">
                <label>Date de naissance</label>
                <input type="date" placeholder="Enter birth date" name="date_naissance" value="{{ old('date_naissance') }}"  />
                @error('date_naissance')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="input-box address">
            <label>Addresse</label>
            <input name="adresse" type="text" placeholder="Enter street address" value="{{ old('adresse') }}"  />
            @error('adresse')
            <span class="error">{{ $message }}</span>
            @enderror

            <div class="input-box">
                <label>Mot de passe</label>
                <input name="password" value="{{ old('password') }}" type="text" placeholder="Mot de passe"  />
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-box">
                <label>Confirmer</label>
                <input name="password_confirmation" value="{{ old('password_confirmation') }}" type="text" placeholder="confirmer mot de passe"  />
                @error('password_confirmation')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button>Submit</button>
    </form>
</section>
</body>
</html>


