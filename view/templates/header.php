<!-- CABECERA -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top border-bottom border-dark border-2 h-10">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?c=inicio">
      <img src="assets/img/logo.png" alt="logo" width="100px" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-lg-between" id="menu">
      <ul class="navbar-nav mb-2 mb-lg-0 col-lg-9 justify-content-around">
        <li class="nav-item mx-2 text-center fs-5">
          <a class="nav-link active" aria-current="page" href="index.php?c=inicio">
            <i class="bi bi-house-fill"></i> Inicio
          </a>
        </li>
        <li class="nav-item mx-2 text-center fs-5">
          <a class="nav-link" href="#">
            <i class="bi bi-compass-fill"></i> Explorar
          </a>
        </li>
        <li class="nav-item mx-2 text-center fs-5">
          <a class="nav-link" href="#">
            <i class="bi bi-chat-dots-fill"></i> Chat
          </a>
        </li>
        <li class="nav-item mx-2 text-center fs-5">
          <a class="nav-link" href="#">
            <i class="bi bi-person-fill"></i> Perfil
          </a>
        </li>
      </ul>
      <div class="d-flex gap-2 justify-content-center justify-content-lg-end">
        <form>
          <div class="input-group">
            <span class="input-group-text text-warning bg-secondary">
              <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Buscar" />
          </div>
        </form>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <img src="img/logo.png" class="rounded-circle" alt="user" width="30px" height="30px" />
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="editar_perfil.html">
                Editar perfil
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="administrador.html">
                Administración
              </a>
            </li>
            <li><a class="dropdown-item" href="index.html">Salir</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- Fin CABECERA -->