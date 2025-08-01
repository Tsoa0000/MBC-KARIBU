<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style>
     @import url('https://fonts.cdnfonts.com/css/skia');
    @font-face {
      font-family: 'Skia';
      src: local('Skia'), local('Skia-Regular');
    }

    body {
      font-family: 'Skia', sans-serif;
      background-color: #f0f4f4;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
    }

    .form-container {
      background: #ffffffcc;
      backdrop-filter: blur(10px);
      padding: 2rem 2rem 2.5rem;
      border-radius: 20px;
      box-shadow: 10px 10px 25px rgba(0, 0, 0, 0.1);
      width: 350px;
    }

    .form-header {
      font-size: 20px;
      font-weight: bold;
      color: #33897F;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-header span {
      display: inline-block;
      border-bottom: 2px solid #E2A346;
      padding-bottom: 5px;
    }

    .form-group {
      position: relative;
      margin-bottom: 2rem;
    }

    .form-group svg {
      position: absolute;
      top: 50%;
      left: 0.8rem;
      transform: translateY(-50%);
      width: 20px;
      height: 20px;
      fill: #33897F;
    }

    .form-group input {
      width: 82%;
      padding: 0.9rem 0.75rem 0.9rem 2.8rem;
      font-size: 1rem;
      border: 2px solid #33897F;
      border-radius: 12px;
      outline: none;
      background-color: transparent;
      color: #000;
    }

    .form-group label {
      position: absolute;
      left: 2.8rem;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      pointer-events: none;
      transition: 0.3s;
      background: white;
      padding: 0 0.25rem;
    }

    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
      top: -2px;
      left: 2.2rem;
      font-size: 15px;
      color: #E2A346;
    }

    .submit-btn {
      font-family: 'Skia', sans-serif;
      width: 100%;
      padding: 0.8rem;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      border-radius: 12px;
      background-color: #33897F;
      color: #ffffff;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #2a6f67;
    }
  </style>
</head>
<body>

  <form class="form-container" method="POST" action="{{ route('car_types.store') }}">
    @csrf

    <div class="form-header"><span>Ajouter un type de voiture</span></div>

    @if(session('success'))
      <p style="color: green; text-align:center;">{{ session('success') }}</p>
    @endif

    <div class="form-group">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M5 11l1.5-4.5h11L19 11h1a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-1v1a1 1 0 1 1-2 0v-1H7v1a1 1 0 1 1-2 0v-1H4a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1h1zm2.16-3L6.5 11h11l-.66-3H7.16zM6 14a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm12 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
      </svg>
      <input type="text" id="name" name="name" required placeholder=" " />
      <label for="name">Type de voiture</label>
    </div>

    <button type="submit" class="submit-btn">Enregistrer</button>
  </form>

</body>
</html>
