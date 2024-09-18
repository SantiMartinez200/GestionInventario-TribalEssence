<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
    integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>

    <div class="container d-flex align-items-center justify-content-center" style="margin-top: 10%">
    <div class="card w-50">
        <div class="card-header">
          <div class="d-flex justify-content-center font-size-m">
            Ingresar
          </div>
        </div>
        <form action="{{route('login.autenticacion')}}" method="post">
        <div class="card-body">
            @csrf
            <div class="mb-3 row">
              <label for="usuario" class="col-md-4 col-form-label text-md-end text-start">Usuario</label>
              <div class="col-md-6">
                <input type="text" class="form-control" id="usuario" name="usuario">
              </div>
            </div>
            <div class="mb-3 row">
                <label for="contraseña" class="col-md-4 col-form-label text-md-end text-start">Contraseña</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" id="contraseña" name="contraseña">
                </div>
              </div>
            <div class="mb-3 row">
              <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Ingresar">
            </div>
            <a href="" class="d-flex justify-content-end text-secondary">Olvidaste la contraseña?</a>
        </div>

    </form>
      </div>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"></script>
</body>
</html>